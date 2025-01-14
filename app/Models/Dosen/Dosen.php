<?php

namespace App\Models\Dosen;

use CodeIgniter\Model;

class Dosen extends Model
{
    CONST DOSEN_TIDAK_TETAP     = 0;
    CONST DOSEN_TETAP           = 1;
    CONST ACTIVE                = 1;
    CONST DELETED               = 0;

    protected $table            = 'dosens';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        "name",                    // nama dosen
        "card_identity",           // NIDN/NIDK
        "postgraduate_degree",     // Pendidikan pasca sarjana
        "expertise_area",          // bidang keahlian
        "academic_position",       // jabatan akademy
        "teaching_certificate",    // sertifikat pendidikan professionl
        "competency_certificate",  // sertifikat kompetensi
        "courses_taught",          // mata kuliah di ampu
        "expertise_fit"            // Kesesuaian bidang keahlian dengan mata kuliah
    ];
}
