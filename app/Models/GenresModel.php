<?php

namespace App\Models;

use CodeIgniter\Model;

class GenresModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'genres';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','genre','cols'];

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

    public function addGenre($data){
        return $this->insert($data);
    }

    public function getGenre(){
        return $this->findAll();
    }

    public function deleteGenre($id){
        return $this->delete($id);
    }

    public function editGenre($id){
        return $this->where('id',$id)->first();
    }

    public function updateGenre($id,$data){
        return $this->update($id,$data);
    }
}
