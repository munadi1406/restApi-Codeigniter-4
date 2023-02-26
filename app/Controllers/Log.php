<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogModel;
use CodeIgniter\API\ResponseTrait;

class Log extends BaseController
{
    private $logModel;
    use ResponseTrait;
    public function __construct()
    {
        $this->logModel = new LogModel();
    }
    public function logInsert()
    {

        $validation =  \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            'ip_address' => 'required|valid_ip', // Required and must be a valid IP address
            'browser' => 'required', // Required
            'operating_system' => 'required', // Required
            'visited_page' => 'required', // Required
            'arrival_time' => 'required|valid_date', // Required and must be a valid date format
            'referrer' => 'valid_url', // Optional but must be a valid URL if provided
            'screen_resolution' => 'required', // Required
            'device' => 'required' // Required
        ]);

        $logData = [
            'ip_address' => $this->request->getVar('ip_address'),
            'browser' => $this->request->getVar('browser'),
            'operating_system' => $this->request->getVar('operating_system'),
            'visited_page' => $this->request->getVar('visited_page'),
            'arrival_time' => $this->request->getVar('arrival_time'),
            'referrer' => $this->request->getVar('referrer'),
            'screen_resolution' => $this->request->getVar('screen_resolution'),
            'device' => $this->request->getVar('device')
        ];


        // Run validation
        if (!$validation->run($logData)) {
            return $errors = $validation->getErrors();
        } else {
            $datas = $this->logModel->logInsert($logData);
            return $this->respondCreated([
                'status' => 201,
                'message' => 'Log Success',
                'data' => $datas
            ]);
        }
    }


    public function getLog(){
        $datas = $this->logModel->getLog();
        if ($datas) {
            return $this->respond([
                'status' => 200,
                'message' => 'success',
                'data' => $datas
            ])->setStatusCode(200);

        } else {
            // return $this->respondUpdated($datas);
            return $this->respond([
                'status' => 404,
                'message' => 'Failed'
            ])->setStatusCode(404);
        }

    }
}
