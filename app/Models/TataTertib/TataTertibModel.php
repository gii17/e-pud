<?php

namespace App\Models\TataTertib;

use CodeIgniter\Model;

class TataTertibModel extends Model
{
    protected $table = 'tata_tertib';
    protected $primaryKey = 'id';
    protected $returnType = 'object';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul'];
}