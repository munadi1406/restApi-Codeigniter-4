<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'link';
    protected $primaryKey       = 'id_link';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_link', 'film_id', 'GD', 'UTB', 'MG', 'quality', 'episode_id'];

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


    public function link($id)
    {
        $data = $this->select(['f.tipe'])
            ->join('films f ', 'link.film_id = f.film_id')
            ->where('f.film_id', $id)
            ->first();
        if ($data === null || $data['tipe'] === null) {
            return $data; // jika tipe null, kembalikan false
        } else if ($data['tipe'] === 'Series') {
            $dataLink =  $this->select(['link.quality','link.GD', 'link.UTB', 'link.MG', 'e.episode'])
                ->join('films f', 'f.film_id = link.film_id')
                ->join('episode e', 'link.episode_id = e.id_episode')
                ->where('f.status', 'show')
                ->where('link.film_id', $id)
                ->orderBy('e.episode','desc')
                ->find();
            $episodeKelompok = array();
            foreach ($dataLink as $link) {
                $episode = $link['episode'];
                if (!isset($episodeKelompok[$episode])) {
                    $episodeKelompok[$episode] = array();
                }
                $episodeKelompok[$episode][] = $link;
            }
            return $episodeKelompok;
        } else if ($data['tipe'] === 'Movie') {
            return $this->select(['f.film_id', 'link.*'])
                ->join('films f', 'f.film_id = link.film_id')
                ->where('f.status', 'show')
                ->where('link.film_id', $id)
                ->find();
        }
    }
    public function linkInsert($dataLink)
    {
        return $this->insertBatch($dataLink);
    }


    // bukan untuk api
    public function linkEdit($id)
    {
        $data = $this->select(['f.tipe'])
            ->join('films f ', 'link.film_id = f.film_id')
            ->where('f.film_id', $id)
            ->first();
        if ($data === null || $data['tipe'] === null) {
            return $data; // jika tipe null, kembalikan false
        } else if ($data['tipe'] === 'Series') {
            return $this->select(['f.film_id', 'f.title', 'f.tipe', 'link.*', 'e.episode','e.id_episode'])
                ->join('films f', 'f.film_id = link.film_id')
                ->join('episode e', 'link.episode_id = e.id_episode')
                ->where('f.status', 'show')
                ->where('link.film_id', $id)
                ->groupBy('link.id_link')
                ->find();
        } else if ($data['tipe'] === 'Movie') {
            return $this->select(['f.film_id', 'f.tipe', 'f.title', 'link.*'])
                ->join('films f', 'f.film_id = link.film_id')
                ->where('f.status', 'show')
                ->where('link.film_id', $id)
                ->find();
        }
    }


    // eksekusi edit link
    public function editLink($linkId, $dataLink)
    {
        return $this->update($linkId, $dataLink);
    }
}
