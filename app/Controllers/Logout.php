<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function index()
    {
        session()->remove('uid');
        session()->remove('uuid');
        session()->remove('login');
   
        return redirect()->to(base_url());
    }
}
