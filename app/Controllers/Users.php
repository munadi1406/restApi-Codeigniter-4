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

        return view('users/users',['data'=>$data,'title'=>$title]);
    }

    public function editUsers(){
        $usersId = $this->request->getVar('user_id');
        
        $data = $this->usersModel->getUsersById($usersId);
        $title = "Users-Edit-".$data['username']; 

        return view('users/edit-users',['data'=>$data,'title'=>$title]);
    }


    public function updateUsers(){
        $rules = [
            'id_users'=>'required',
            'username'=>'required',
            'email'=>'required',
            'role'=>'required'
        ];

        if(!$this->validate($rules)){
            $errors = $this->validator->getErrors();
            return redirect()->back()->with('error',$errors);
        }

        $usersId = $this->request->getVar('id_users');


        $dataUsers= [
            'username'=>$this->request->getVar('username'),
            'email'=>$this->request->getVar('email'),
            'role'=>$this->request->getVar('role')
        ];
        $data = $this->usersModel->updateUsers($usersId,$dataUsers);

        if($data){
            return redirect()->to('users')->with('success_message','Data Users Berhasil Di Update');
        }else{
            return redirect()->to('users')->with('error','Data Users Gagal Di Update');
        }
    }
}
