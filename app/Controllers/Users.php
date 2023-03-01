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


}
