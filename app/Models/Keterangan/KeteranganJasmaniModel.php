<?php

namespace App\Models\Keterangan;

use CodeIgniter\Model;

class KeteranganJasmaniModel extends Model
{
    protected $table            = 'keterangan_jasmani';
    protected $primaryKey       = 'id_jasmani';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_jasmani','nomor_induk','berat_badan','tinggi_badan','golongan_darah','riwayat_penyakit','created_at','updated_at'];

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
        $builder = $this->db->table('keterangan_jasmani');
        $builder->join('users', 'users.nomor_induk = keterangan_jasmani.nomor_induk');
        $query = $builder->get();
        return $query->getResult();
    }
}
