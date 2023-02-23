<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'films as f';
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

    public function films()
    {
        return $this->select(['f.film_id', 'f.title', 'f.desc', 'f.date', 'f.image', 'g.name'])
            ->join('genre g', 'g.id_films = f.film_id')
            ->where('status', 'show')
            ->orderBy('updated_at', 'DESC')
            ->findAll();
    }

    public function filmsById($id)
    {
        // return $this->select(['f.film_id', 'f.title', 'f.desc', 'f.date', 'f.image', 'g.name'])
        //     ->join('genre g', 'g.id_films = f.film_id')
        //     ->where('status', 'show')
        //     ->where('f.film_id', $id)
        //     ->findAll();
        return $this->where('film_id',$id)->find();
    }


    public function randomFilms()
    {
        return $this->select(['film_id', 'image'])->where('status', 'show')->orderBy('RAND()')->limit(2)->find();
    }


    public function insertFilms($filmsData)
    {

        $film = $this->insert($filmsData);

        return $film;
    }
}
