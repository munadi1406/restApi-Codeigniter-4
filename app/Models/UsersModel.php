<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id_users';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_users','username','email','password','role','refresh_token','expire'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function register($data){
        return $this->insert($data);
    }

    public function auth($username){
        return $this->where('username',$username)->first();
    }

    public function emailCheck($email){
        return $this->where('email',$email)->first();
    }

    public function getRefrestoken($idUsers,$data){
        return $this->update($idUsers,$data);
    }

    public function requestAccessTokenNew($refreshToken){
        return $this->where('refresh_token',$refreshToken)->first();
    }

    public function getAllUsers(){
        return $this->findAll();
    }


    public function getUsersById($idusers){
        return $this->where('id_users',$idusers)->first();
    }

    public function updateUsers($idUsers,$dataUsers){
        return $this->update($idUsers,$dataUsers);
    }

}
