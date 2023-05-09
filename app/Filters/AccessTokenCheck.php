<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Config\Services;

class AccessTokenCheck implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */

    private $secretKey;
    private $usersModel;

    protected $response;
    protected $request;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->response = service('Response');
        $this->request = service('request');
        $this->secretKey = env("SECRET_KEY");
    }



    use ResponseTrait;
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = $this->secretKey;
        $authHeader = $request->getServer('HTTP_AUTHORIZATION');

        if (!$authHeader) {
            return $this->respond([
                'msg' => 'Access token is required.'
            ])->setStatusCode(401);
        };

        // Ambil token dari header
        $token = explode('Bearer ', $authHeader)[1];

        try {
            // Lakukan decoding pada access token
            $decodedToken = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return $this->respond([
                'msg' => 'Invalid Access token '
            ])->setStatusCode(401);
        }

        // Ambil data waktu kadaluarsa dari access token
        $expire = $decodedToken->exp;
        var_dump($expire);

        // Lakukan pengecekan apakah token telah kadaluarsa
        if (time() >= strtotime($expire)) return $this->respond(['access token has expired'])->setStatusCode(401);
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
