<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use Config\Services;

class Login extends BaseController
{
    private $usersModel;
    private $session;
    private $encrypter;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->session = session();
        $this->encrypter = Services::encrypter();
    }
    public function index()
    {
        $title = 'Login';
        return view('login/login', ['title' => $title]);
    }

    public function auth()
    {

        $rules = [
            'username' => 'required|alpha_numeric|min_length[6]|max_length[50]',
            'password' => 'required|min_length[6]|'
        ];

        if (!$this->validate($rules)) {
            return  redirect()->back()->with('error', 'Akun Anda Tidak Di Temukan');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getVar('password'),
        ];
        $auth = $this->usersModel->auth($data['username']);

        if ($auth) {
            if (password_verify($data['password'], $auth['password'])) {
                $salt = $_ENV['SALT'];
                $key = $_ENV['KEY'];
                $saltId = $salt . $auth['id_users'] . $salt;
                $hashId =  $this->encrypter->encrypt($saltId, $key);
                // $usernameHash = $this->encrypter->encrypt($auth['username'],$key);
                session()->set('login', true);
                session()->set('uid', $hashId);
                session()->set('uuid', $auth['username']);
                return redirect()->route('admin');
            } else {
                return  redirect()->back()->with('error', 'Password Yang Anda Masukkan Salah');
            }
        } else {
            return  redirect()->back()->with('error', 'Akun Anda Tidak Di Temukan');
        }
    }
}
