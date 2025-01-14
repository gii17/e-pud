<?php

namespace App\Models\Surat;

use CodeIgniter\Model;

class SuratKeteranganPindahSekolahModel extends Model
{

    protected $table = 'surat_keterangan_pindah_sekolah';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['nama_kb','status_sekolah','alamat_sekolah','kelurahan','kecamatan','kota','provinsi','tanggal_diterima','kelompok_id','surat_id'];

}