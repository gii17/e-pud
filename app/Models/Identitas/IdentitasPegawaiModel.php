<?php

namespace App\Models\Identitas;

use CodeIgniter\Model;

class IdentitasPegawaiModel extends Model
{
    protected $table            = 'identitas_pegawai';
    protected $primaryKey       = 'id_identitas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_identitas','nomor_induk','jenis_kelamin','tempat_lahir','tanggal_lahir','status_kepegawaian','nip','agama','created_at','updated_at'];

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
        $builder = $this->db->table('identitas_pegawai');
        $builder->join('users', 'users.nomor_induk = identitas_pegawai.nomor_induk');
        $query = $builder->get();
        return $query->getResult();
    }
}
