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
    protected $allowedFields    = ['film_id', 'id_users', 'title', 'desc', 'date', 'image', 'created_at', 'status', 'tipe', 'subtitle', 'trailer'];

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

    public function films($startFrom, $records)
    {
        return $this->select(['films.film_id', 'films.title', 'films.date', 'films.image'])
            ->where('status', 'show')
            ->orderBy('updated_at', 'DESC')
            ->limit($records, $startFrom)
            ->find();
    }



    public function getImageCache()
    {
        return $this->select(['films.image'])->findAll();
    }

    public function filmsById($id)
    {
        return $this->select(['films.film_id', 'films.title', 'films.desc', 'films.date', 'films.image', 'films.tipe', 'films.subtitle', 'films.trailer', 'g.name'])
            ->join('genre g', 'g.id_films = films.film_id')
            ->where('status', 'show')
            ->where('films.film_id', $id)
            ->first();
    }


    public function randomFilms()
    {
        return $this->select(['film_id', 'title', 'image'])->where('status', 'show')->orderBy('RAND()')->limit(12)->find();
    }


    public function insertFilms($filmsData)
    {
        $film = $this->insert($filmsData);
        return $film;
    }


    public function filmsByType($type, $startFrom, $records)
    {
        return $this->select(['film_id', 'title', 'date', 'image'])
            ->where('status', 'Show')
            ->where('tipe', $type)
            ->orderBy('updated_at', 'DESC')
            ->limit($records, $startFrom)
            ->find();
    }

    public function countType($type)
    {
        return $this->where('tipe', $type)->countAllResults();
    }


    public function deleteFilms($filmsId)
    {
        $result = $this->delete($filmsId);
        return $result;
    }

    public function countFilms()
    {
        return $this->countAll();
    }


    public function countFilmsShow()
    {
        return $this->where('status', 'show')->countAllResults();
    }

    public function countFilmsMovie()
    {
        return $this->where('tipe', 'Movie')->countAllResults();
    }


    public function countFilmsSeries()
    {
        return $this->where('tipe', 'Series')->countAllResults();
    }




    // bukan untuk api
    public function filmsAll()
    {
        return $this->select(['films.*', 'g.name', 'u.*'])
            ->join('genre g', 'g.id_films = films.film_id')
            ->join('users u', 'films.id_users = u.id_users')
            ->orderBy('films.created_at', 'DESC')
            ->find();
    }
    
    // search film data for edit
    public function filmsEdit($filmId)
    {
        return $this->select(['films.*', 'g.name'])
            ->join('genre g', 'g.id_films = films.film_id')
            ->where('films.film_id',$filmId)
            ->first();
    }

    public function filmsLink()
    {
        return $this->select(['films.film_id', 'link.*'])
            ->join('link', 'films.film_id = link.film_id')
            ->findAll();
    }
    public function filmsLinkSeries()
    {
        return $this->select(['films.film_id', 'link.*', 'e.episode'])
            ->join('link', 'films.film_id = link.film_id')
            ->join('episode e', 'link.episode_id = e.id_episode')
            ->find();
    }

    public function deleteFilmsPost($filmsId)
    {
        // Get the filename from the database
        $filename = $this->select(['image'])->where('film_id', $filmsId)->first();

        // Delete the file from the uploads folder
        if ($filename) {
            $path = ROOTPATH . 'writable/uploads/' . basename($filename['image']);
            if (file_exists($path)) {
                unlink($path);
            }
        }else{
            return false;
        }
        $result = $this->delete($filmsId);
        return $result;
    }
}
