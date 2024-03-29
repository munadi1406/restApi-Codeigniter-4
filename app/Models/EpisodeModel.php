<?php

namespace App\Models;

use CodeIgniter\Model;

class EpisodeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'episode';
    protected $primaryKey       = 'id_episode';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['film_id','episode'];

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


    public function episodeInsert($episodeData){
        $data  = $this->insert($episodeData);
        return $data;
    }

    public function getEpisode($filmId){
        return $this->select('episode')->where($filmId)->find();

    }

    public function episodeByFilmid($filmId){
        $data  = $this->select(['f.film_id','f.title','episode'])->join('films f','f.film_id = episode.film_id')->where('f.film_id',$filmId)->orderBy('id_episode','desc')->first();
        return $data;
    }
    
    public function deleteEpisode($id){
        return $this->delete($id);
    }

}
