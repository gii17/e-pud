<?php

namespace App\Models\Alamat;

use CodeIgniter\Model;

class AlamatPegawaiModel extends Model
{
    protected $table            = 'alamat_pegawai';
    protected $primaryKey       = 'id_alamat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_alamat','nomor_induk','alamat_rumah','status_rumah','nomor_telephone','jarak_kantor','created_at','updated_at'];

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

    public function getAll()
    {
        $builder = $this->db->table('alamat_pegawai');
        $builder->join('users', 'users.nomor_induk = alamat_pegawai.nomor_induk');
        $query = $builder->get();
        return $query->getResult();
    }
}
