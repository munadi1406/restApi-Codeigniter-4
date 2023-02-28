<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Register extends BaseController
{
    private $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }
    public function register()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');

        $tes = '1234';

        $passwordHash = password_hash($tes, PASSWORD_BCRYPT);

        $token = sha1($passwordHash);
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $passwordHash,
            'token'=>$token
        ];

        $register = $this->usersModel->register($data);

        if ($register) {
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }
}
