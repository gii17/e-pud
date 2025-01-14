<?php

namespace App\Models\TataTertib;

use CodeIgniter\Model;

class TataTertibItemModel extends Model
{


    protected $table = 'tata_tertib_item';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['deskripsi','tata_tertib_id'];

}