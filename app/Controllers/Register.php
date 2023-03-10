<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

use function PHPUnit\Framework\returnSelf;

class Register extends BaseController
{
    private $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $title = 'Register';
        return view('login/register', ['title' => $title]);
    }

    public function register()
    {
        $rules = [
            'username' => 'required|min_length[6]|alpha_numeric|max_length[50]',
            'email' => 'required|valid_email|max_length[100]',
            'password' => 'required|min_length[6]'
        ];
        $msg = [
            'username' => [
                'required' => 'Username Anda Kosong',
                'min_length' => 'Username Minimal 6 Karakter',
                'alpha_numeric' => 'Username Harus Berupa Angka Dan Huruf Saja',
                'max_length' => ''
            ],
            'email' => [
                'required' => 'Email Anda Kosong',
                'valid_email' => 'Email Anda Tidak Valid'
            ],
            'password' => [
                'required' => 'Password Anda Kosong',
                'min_length' => 'Password Minimal 6 Karakter',
            ]
        ];
        if (!$this->validate($rules, $msg)) {
            $errors = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('error', $errors);
        }

        
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');
        
        $checkUsername = $this->usersModel->auth($username);
        $checkEmail = $this->usersModel->emailCheck($email);
        
        if ($checkUsername) {
            return redirect()->route('register')->with('error', 'Username Tidak Tersedia');
        }
        if ($checkEmail) {
            return redirect()->route('login')->with('error', 'Email Sudah Digunakan Silahan Login Kembali');
        }
    
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $token = sha1($passwordHash);
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $passwordHash,
            'token' => $token
        ];

        $register = $this->usersModel->register($data);

        if ($register) {
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }
}
