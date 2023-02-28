<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Login extends BaseController
{
    private $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }
    public function index()
    {
        return view('login/login');
    }


    public function auth()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getVar('password'),
        ];

       
        $auth = $this->usersModel->auth($data['username']);
    
        if ($auth) {
            if (password_verify($data['password'], $auth['password'])) {
                $salt = getenv('SALT');
                $cookie = $salt.$auth['token'].$salt;
                setcookie('auth', $cookie, time()+259200);
                return redirect()->route('admin');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}
