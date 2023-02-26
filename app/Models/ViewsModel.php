<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'viewers';
    protected $primaryKey       = 'id_viewers';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['film_id', 'views'];

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


    public function viewsInsert($dataViews)
    {
        $this->insert($dataViews);
    }

    public function getViews($filmId)
    {
        return $this->where('film_id', $filmId)->findAll();
    }

    public function getAllViews()
    {
        return $this->select(['f.title','viewers.views'])
            ->join("films f", "f.film_id = viewers.film_id")
            ->findAll();
    }

    public function updateViews($filmId)
    {
        $film = $this->where('film_id', $filmId)->first();
        $currentViews = $film['views'];
        $newViews = $currentViews + 1;
        return $this->where('film_id', $filmId)->set('views', $newViews)->update();
    }
}
