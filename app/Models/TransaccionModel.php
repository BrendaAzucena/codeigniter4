<?php namespace App\Models;

use CodeIgniter\Model;

class TransaccionModel extends Model {
    protected $table = 'transaccion';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields = ['cuenta_id','tipo_transaccion_id','monto'];

    protected $useTimestamps = true;
    protected $createdFields = 'created_at';
    protected $updatedFields = 'updated_at';

    protected $validationRules = [
        'cuenta_id' => 'requiered|integer|is_valid_cuenta',
        'tipo_transaccion_id' => 'requiered|integer|is_valid_tipo_transaccion',
        'monto' => 'requiered|numeric',
    ];
    protected $validationMessages = [
        'cuenta_id' => [ 'is_valid_cuenta' => 'Estimado usuario, debe ingresar una cuenta valido',
    ],
            'tipo_transaccion_id' => [ 'is_valid_tipo_transaccion' => 'Estimado usuario, debe ingresar una transaccion valido'
            ]
    ];

    protected $skipValidation = false;

    public function TransaccionPorCliente ($clienteId = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('cliente.id As NumeroCuenta, cliente.nombre, cliente.apellido');
        $builder->select('tipo_transaccion.descripcion AS Tipo, transaccion.monto');                                                                                                                        
        $builder->join('cuenta', 'transaccion.cuenta_id = cuenta.id');
        $builder->join('tipo_transaccion','transaccion.tipo_transaccion_id = tipo_transaccion.id');   
        $builder->join('cliente', 'transaccion.cliente_id = cliente.id');
        $builder->where('cliente.id', $clienteId);

        $query = $builder->get();
        return $query->getResult();
    }
}

