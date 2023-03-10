<?php

namespace App\Models;

use CodeIgniter\Model;

class GenreModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'genre';
    protected $primaryKey       = 'id_genre';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_films','name'];

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

    public function genreFilter($genre,$startFrom,$records){
        return $this->select(['genre.name','f.film_id','f.title','f.image','f.date'])
        ->join('films f','f.film_id = genre.id_films')
        ->where('name like','%'.$genre.'%')
        ->where('f.status','show')
        ->orderBy('f.film_id','DESC')
        ->limit($records,$startFrom)
        ->find();
    }

    public function countGenre($genre){
        return $this->where('name like','%'.$genre.'%')->countAllResults();
    }

    public function genreInsert($genreData){
        $this->insert($genreData);
    }

    
    public function genreUpdate($filmId, $genreData){
        $idGenre = $this->select(['id_genre'])->where('id_films',$filmId)->first();

        $id = $idGenre['id_genre'];
        $this->update($id,$genreData);
    }    
}
