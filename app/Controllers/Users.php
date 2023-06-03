<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{

    private $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }


    public function getUsers()
    {
        $title = 'Users Data';
        $data = $this->usersModel->getAllUsers();

        return view('users/users', ['data' => $data, 'title' => $title]);
    }

    public function editUsers()
    {
        $usersId = $this->request->getVar('user_id');

        $data = $this->usersModel->getUsersById($usersId);
        $title = "Users-Edit-" . $data['username'];

        return view('users/edit-users', ['data' => $data, 'title' => $title]);
    }


    public function updateUsers()
    {
        $rules = [
            'id_users' => 'required',
            'username' => 'required',
            'email' => 'required',
            'role' => 'required'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return redirect()->back()->with('error', $errors);
        }

        $usersId = $this->request->getVar('id_users');


        $dataUsers = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role')
        ];
        $data = $this->usersModel->updateUsers($usersId, $dataUsers);

        if ($data) {
            return redirect()->to('users')->with('success', 'Data Users Berhasil Di Update');
        } else {
            return redirect()->to('users')->with('error', 'Data Users Gagal Di Update');
        }
    }

    public function addUsersView()
    {
        $title = 'Users add';

        return view('users/add-users', ['title' => $title]);
    }


    public function addUsers(){
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
        $role = $this->request->getVar('role');
        
        $checkUsername = $this->usersModel->auth($username);
        $checkEmail = $this->usersModel->emailCheck($email);
        
        if ($checkUsername) {
            return redirect()->route('add-users')->with('error', 'Username Tidak Tersedia');
        }
        if ($checkEmail) {
            return redirect()->route('add-users')->with('error', 'Email Sudah Digunakan Silahan Login Kembali');
        }
    
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'username' => $username,
            'email' => $email,
            'role'=>$role,
            'password' => $passwordHash
        ];

        $register = $this->usersModel->register($data);

        if ($register) {
            return redirect()->to('users')->with('success', 'Data Users Berhasil Di Tambahkan');
        } else {
            return redirect()->to('users')->with('error', 'Data Users Gagal Di Tambahkan');
        }
    }
}
