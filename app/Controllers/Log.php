<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogModel;

class Log extends BaseController
{
    private $logModel;
    public function __construct()
    {
        $this->logModel = new LogModel();
    }
    public function logInsert()
    {

    }
}
