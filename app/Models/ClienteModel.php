<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model {
    protected $table = 'cliente';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'apellido','telefono','correo'];

    protected $useTimestamps = true;
    protected $createdFields = 'created_at';
    protected $updatedFields = 'updated_at';

    protected $validationRules = [
        'nombre' => 'requiered|alpha_space|min_length[3]|max_length[75]|',
        'apellido' => 'requiered|alpha_space|min_length[3]|max_length[75]|',
        'telefono' => 'requiered|alpha_numeric_space|min_length[8]|max_length[8]|',
        'correo' => 'permit_empty|valid_email|max_length[85]|'
    ];

    protected $validationMessages = [
        'correo' => [
            'valid_email' => 'Estimado usuario, debe ingresar un email valido'
            ]
    ];

    protected $skipValidation = false;
}
