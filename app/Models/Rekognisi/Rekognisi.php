<?php

namespace App\Models\Rekognisi;

use CodeIgniter\Model;

class Rekognisi extends Model
{
    CONST FLAG_PKM           = 1;
    CONST FLAG_PENELITIAN    = 0;

    protected $table            = 'rekognisis';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        "name", "bidang", "rekognisi", "wilayah","nasional", "internasional","year",
    ];
}
