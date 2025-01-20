<?php

namespace App\Models\DTPS;

use CodeIgniter\Model;

class Dtps extends Model
{
    CONST FLAG_PKM           = 1;
    CONST FLAG_PENELITIAN    = 0;

    protected $table            = 'dtps';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        "name", "ts", "ts1", "ts2","flag", "jumlah",
    ];
}
