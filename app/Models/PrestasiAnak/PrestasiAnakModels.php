<?php

namespace App\Models\PrestasiAnak;

use CodeIgniter\Model;

class PrestasiAnakModels extends Model
{
    protected $table            = 'prestasi_anak';
    protected $primaryKey       = 'id_prestasi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_prestasi','nomor_induk','nama_kegiatan','tanggal_kegiatan','lokasi_kegiatan','prestasi','reward','created_at','updated_at'];

    // Dates
    protected $useTimestamps = true;
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
        $builder = $this->db->table('prestasi_anak');
        $builder->join('users', 'users.nomor_induk = prestasi_anak.nomor_induk');
        $query = $builder->get();
        return $query->getResult();
    }
}
