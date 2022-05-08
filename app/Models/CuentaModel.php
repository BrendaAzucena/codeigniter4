<?php namespace App\Models;

use CodeIgniter\Model;

class CuentaModel extends Model {
    protected $table = 'cuenta';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields = ['moneda', 'fondo','cliente_id'];

    protected $useTimestamps = true;
    protected $createdFields = 'created_at';
    protected $updatedFields = 'updated_at';

    protected $validationRules = [
        'moneda' => 'requiered|alpha_space|min_length[3]|max_length[3]|',
        'fondo' => 'requiered|numeric',
        'cliente_id' => 'requiered|integer|is_valid_cliente',
    ];
    protected $validationMessages = [
        'cliente_id' => [ 'is_valid_cliente' => 'Estimado usuario, debe ingresar un cliente valido',
                          'is_allow_cliente' => 'Estimado usuario, debe ingresar un cliente de la lista permitido'
            ]
    ];

    protected $skipValidation = false;
}
