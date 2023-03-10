<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'visitor_log';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['visit_time', 'ip_address', 'browser', 'operating_system', 'visited_page', 'arrival_time', 'referrer', 'screen_resolution', 'device'];

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

    public function logInsert($logData)
    {
        return $this->insert($logData);
    }

    public function getLog()
    {
        return $this->orderBy("id", "DESC")->findAll();
    }


    public function allLogViews()
    {
        return $this->countAllResults();
    }


    public function operatingSystem()
    {
        return $this->select(['operating_system', 'count(operating_system)'])
            ->groupBy('operating_system')
            ->findAll();
    }


    public function browser()
    {
        return $this->select(['browser', 'count(browser)'])->groupBy('browser')
            ->findAll();
    }

    public function viewsPerYears()
    {
        return $this->selectCount('*')
            ->where('year(visit_time)', date('Y'))
            ->countAllResults();
    }

    public function viewsPerMonth()
    {
        return $this->where('YEAR(visit_time)',date('Y'))
        ->where('MONTH(visit_time)',date('m'))
        ->countAllResults();
    
    }


    public function viewsPerWeek()
    {
        return $this->where('YEAR(visit_time)', date('Y'))
            ->where('MONTH(visit_time)', date('m'))
            ->where('WEEK(visit_time)', date('W'))
            ->countAllResults();
    }
    
    
    
    public function viewsPerDay()
    {
        return $this->where('day(visit_time)', date('j'))
            ->where('YEAR(visit_time)', date('Y'))
            ->where('MONTH(visit_time)', date('m'))
            ->countAllResults();
    }
    
}
