<?php namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model {
    protected $table = 'rol';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields = ['nombre'];

    protected $useTimestamps = true;
    protected $createdFields = 'created_at';
    protected $updatedFields = 'updated_at';

    protected $validationRules = [
        'nombre' => 'requiered|alpha_space|min_length[3]|max_length[45]|'
    ];

    protected $skipValidation = false;
}