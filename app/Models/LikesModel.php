<?php

namespace App\Models;

use CodeIgniter\Model;

class LikesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'likes';
    protected $primaryKey       = 'id_like';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_likes','film_id','user_id','created_at'];

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


    public function getDataLike(){
        return $this->select(['f.title','count(likes.film_id) as likes'])
        ->join('films f','likes.film_id = f.film_id')
        ->groupBy('likes.film_id')
        ->orderBy('likes','desc')
        ->findAll();
    }

    // untuk api
    public function like($data){
        return $this->insert($data);
    }

    public function checkLike($film_id,$user_id){
        return $this->where('film_id',$film_id)->where('user_id',$user_id)->first();
    }

    public function deleteLike($film_id){
        return $this->delete($film_id);
    }

    public function getLikeByFilmId($film_id){
        return $this->selectCount('film_id')->where('film_id',$film_id)->first();
    }

}
