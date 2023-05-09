<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Firebase\JWT\JWT;
use CodeIgniter\API\ResponseTrait;
use App\Models\TokenModel;
use App\Models\UsersModel;
use Firebase\JWT\Key;






class JwtAuth extends BaseController
{

    use ResponseTrait;
    private $secretKey;
    private $jwt;

    private $tokenModel;
    private $cookie;
    private $usersModel;


    public function __construct()
    {
        $this->jwt = new JWT();
        $this->secretKey = env("SECRET_KEY");
        $this->tokenModel = new TokenModel();
        $this->usersModel = new UsersModel();
    }

    function generateAccessToken($data)
    {
        $issueAt = time();

        // Access token berlaku selama 15 menit
        $accessTokenExpire = date('Y-m-d H:i:s', strtotime('+60 seconds'));

        $payload = [
            'username' => $data['username'],
            'password' => $data['password'],
            'iat' => $issueAt,
            'exp' => $accessTokenExpire
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function index()
    {
        // jwt generate
        $key = $this->secretKey;
        $rules = [
            'username' => 'required|alpha_numeric|min_length[6]|max_length[50]',
            'password' => 'required|min_length[6]|'
        ];

        if (!$this->validate($rules)) {

            return  $this->respond([
                'unauthorize'
            ])->setStatusCode(401);
        };

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getVar('password'),
        ];

        $auth = $this->usersModel->auth($data['username']);

        if (!$auth) return $this->respond(401);

        if (!password_verify($data['password'], $auth['password']))  return $this->respond(404);


        $refreshTokenCheck = $auth['refresh_token'];
        $decodedRefreshTokenCheck = JWT::decode($refreshTokenCheck, new Key($key, 'HS256'));
        var_dump($decodedRefreshTokenCheck->exp);

        if (strtotime($decodedRefreshTokenCheck->exp)  <= time()) {

            $issueAt = time();
            // Refresh token berlaku selama 7 hari
            $refreshTokenExpire = date('Y-m-d H:i:s', strtotime('+7 days'));

            $accessToken = $this->generateAccessToken($data);

            $payloadRefreshToken = [
                'password' => $data['password'],
                'iat' => $issueAt,
                'exp' => $refreshTokenExpire
            ];
            $refreshToken = JWT::encode($payloadRefreshToken, $key, 'HS256');

            $updateToken = [
                'refresh_token' => $refreshToken,
                'expire' => $refreshTokenExpire
            ];
            $this->usersModel->getRefrestoken($auth['id_users'], $updateToken);

            return $this->respond([
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'token_type' => 'Bearer',
            ])->setStatusCode(200);
        } else {
            $accessToken = $this->generateAccessToken($data);
            return $this->respond([
                'access_token' => $accessToken,
                'refresh_token' => $auth['refresh_token'],
                'token_type' => 'Bearer',
            ])->setStatusCode(200);
        };
    }

    public function getNewAccessToken()
    {
        $refresh_token = $this->request->getPost('refresh_token');
        if (!$refresh_token) return $this->respond(['refresh token required'])->setStatusCode(401);

        $data = $this->usersModel->requestAccessTokenNew($refresh_token);
        if (!$data) return $this->respond(['Access Denied'])->setStatusCode(404);

        // var_dump($data);
        if (time() >= strtotime($data['expire'])) return $this->respond('Session Has Expired')->setStatusCode(401);

        $payload = [
            'username' => $data['username'],
            'password' => $data['password']
        ];
        $accessToken = $this->generateAccessToken($payload);
        return $this->respond([
            'access-token' => $accessToken,
        ])->setStatusCode(200);
    }
}
