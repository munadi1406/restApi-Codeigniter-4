<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function index()
    {
        $title = "Login";
        session()->remove('uid');
        session()->remove('uuid');
        session()->remove('login');

        
        return view('login/login',['title'=>$title]);
    }
}
