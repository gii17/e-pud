<?php

namespace App\Models\Buku;

use CodeIgniter\Model;

class BukuIndukPegawaiModels extends Model
{
    protected $table            = 'data_induk_pegawai';
    protected $primaryKey       = 'id_identitas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_identitas',
                                    'nomor_induk',
                                    'jenis_kelamin',
                                    'tempat_lahir',
                                    'tanggal_lahir',
                                    'status_kepegawaian',
                                    'nip',
                                    'agama',
                                    'status_perkawinan',
                                    'nama_pasangan',
                                    'tanggal_lahir_pasangan',
                                    'tanggal_perkawinan',
                                    'keterangan_perkawinan',
                                    'anak',
                                    'status_anak',
                                    'tempat_lahir_anak',
                                    'tanggal_lahir_anak',
                                    'nama_ortu_anak',
                                    'alamat_rumah',
                                    'status_rumah',
                                    'nomor_telp',
                                    'jarak_kantor',
                                    'berat_badan',
                                    'golongan_darah',
                                    'riwayat_penyakit',
                                    'jenjang_pendidikan',
                                    'jurusan_pendidikan',
                                    'tamat_tahun_pendidikan',
                                    'jenis_training_pendidikan',
                                    'tempat_training',
                                    'tahun_training',
                                    'bulan_training',
                                    'hari_training',
                                    'tingkat_training',
                                    'keterangan_training',
                                    'jenis_pekerjaan',
                                    'tahun_pekerjaan',
                                    'keterangan_pekerjaan',
                                    'mapel',
                                    'jenis_sekolah',
                                    'kelas',
                                    'tahun_mapel',
                                    'nama_organisasi',
                                    'jabatan_organisasi',
                                    'tahun_organisasi',
                                    'terhitung_mulai_tanggal',
                                    'meninggalkan_sekolah',
                                    'alasan_meninggalkan',
                                    'created_at',
                                    'updated_at',
                                    ];

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
        $builder = $this->db->table('data_induk_pegawai');
        $builder->join('users', 'users.nomor_induk = prestasi_anak.nomor_induk');
        $query = $builder->get();
        return $query->getResult();
    }

}
