<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'films';
    protected $primaryKey       = 'film_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['film_id', 'id_users', 'title', 'desc', 'date', 'image', 'created_at', 'status', 'tipe'];

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

    public function films($startFrom,$records)
    {
        return $this->select(['films.film_id', 'films.title','films.date', 'films.image'])
            ->where('status', 'show')
            ->orderBy('updated_at', 'DESC')
            ->limit($records,$startFrom)
            ->find();
    }

    public function filmsById($id)
    {
        return $this->select(['films.film_id', 'films.title', 'films.desc', 'films.date', 'films.image','films.tipe', 'g.name'])
            ->join('genre g', 'g.id_films = films.film_id')
            ->where('status', 'show')
            ->where('films.film_id', $id)
            ->findAll();
    }


    public function randomFilms()
    {
        return $this->select(['film_id', 'image'])->where('status', 'show')->orderBy('RAND()')->limit(12)->find();
    }


    public function insertFilms($filmsData)
    {
        $film = $this->insert($filmsData);
        return $film;
    }


    public function filmsByType($type)
    {
        return $this->select(['film_id', 'title', 'date','image'])
            ->where('status', 'Show')
            ->where('tipe', $type)
            ->orderBy('updated_at', 'DESC')
            ->findAll();
    }


    public function deleteFilms($filmsId){
        $result = $this->delete($filmsId);
        return $result;
    }

    public function countFilms(){
        return $this->countAll();
    }

   

}
