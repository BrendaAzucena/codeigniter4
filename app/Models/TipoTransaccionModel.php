<?php namespace App\Models;

use CodeIgniter\Model;

class TipoTransaccionModel extends Model {
    protected $table = 'tipo_transaccion';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields = ['descripcion'];

    protected $useTimestamps = true;
    protected $createdFields = 'created_at';
    protected $updatedFields = 'updated_at';

    protected $validationRules = [
        'descripcion' => 'requiered|alpha_space|max_length[65]|'
    ];

    protected $skipValidation = false;
}
