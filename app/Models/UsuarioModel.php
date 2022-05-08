<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model {
    protected $table = 'usuario';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'username','password','rol_id'];

    protected $useTimestamps = true;
    protected $createdFields = 'created_at';
    protected $updatedFields = 'updated_at';

    protected $validationRules = [
        'nombre' => 'requiered|alpha_space|min_length[3]|max_length[65]|',
        'username' => 'requiered|alpha_space|min_length[3]|max_length[10]|',
        'password' => 'requiered|alpha_numeric_space|min_length[8]|max_length[8]|',
        'rol_id' => 'permit_empty|valid_password|max_length[85]|'
    ];

    protected $validationMessages = [
        'password' => [
            'valid_password' => 'Estimado usuario, debe ingresar un password valido'
            ]
    ];

    protected $skipValidation = false;
}
