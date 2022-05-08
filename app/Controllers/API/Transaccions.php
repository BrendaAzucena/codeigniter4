<?php namespace App\Controllers\API;

use App\Models\ClienteModel;
use App\Models\TransaccionModel;
use App\Models\CuentaModel;
use CodeIgniter\RESTful\ResourceController;

class Transaccions extends ResourceController {
    public function __construct(){
        $this->model = $this->setModel(new TransaccionModel());
    }

   public function index() {
       $transaccions  = $this->model->findAll();
       return $this->respond($transaccions);
   }
   
   public function create()
   {
       try {
           $transaccion = $this->request->getJSON();
           if($this->model->insert($transaccion)):
              return $this->respondCreated($transaccion);
           else:
               return $this->failValidationError($this->model->validation->listErrors());
           endif;
       } catch (\Exception $e) {
           return $this->failServerError('Ha ocurrido un erro en el servidor');
       }
   }

public function edit($id = null)
    {
        try {
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');

            $transaccion = $this->model->find($id);
            if($transaccion == null)
            return $this->failNotFound('Np se ha encontrado con el id: '.$id);

            return $this->respond($transaccion);

     } catch (\Exception $e) {
         return $this->failServerError('Ha ocurrido un error en el servidor');
         
    }

}

public function update($id = null)
    {
        try {
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');

            $transaccionVerificado = $this->model->find($id);
            if($transaccionVerificado == null)
            return $this->failNotFound('No se ha encontrado con el id: '.$id);

        $transaccion = $this->request->getJSON();
        
        if($this->model->update($id, $transaccion)):
            $transaccion->id = $id;
         return $this->respondUpdated($transaccion);
        else:
            return $this->failValidationError($this->model->validation->listErrors());
       endif;
     } catch (\Exception $e) {
         return $this->failServerError('Ha ocurrido un error en el servidor');
         
    }

}

public function delete($id = null)
    {
        try {
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');

            $transaccionVerificado = $this->model->find($id);
            if($transaccionVerificado == null)
            return $this->failNotFound('No se ha encontrado con el id: '.$id);
        
        if($this->model->delete($id)):
         return $this->respondDeleted($transaccionVerificado);
        else:
            return $this->failServerError('No se ha podido eliminar el registro');
       endif;
     } catch (\Exception $e) {
         return $this->failServerError('Ha ocurrido un error en el servidor');
         
    }
}
public function getTransaccionesByCliente($id = null)
    {
        try {
            $modelCliente = new ClienteModel();
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');

            $cliente = $this->modelCliente->find($id);
            if($cliente == null)
            return $this->failNotFound('No se ha encontrado con el id: '.$id);

             $transaccion = $this->model->TransaccionPorCliente($id);

            return $this->respond($transaccion);

     } catch (\Exception $e) {
         return $this->failServerError('Ha ocurrido un error en el servidor');
         
    }
    }
public function actualizarFondoCuenta($tipoTransaccionId, $monto, $cuentaId)
    {
       $modelCuenta = new CuentaModel();
       $cuenta = $modelCuenta->find($cuentaId);
       switch ($tipoTransaccionId) {
           case 1:
            $cuenta["fondo"] += $monto;
            break;

            case 2:
                $cuenta["fondo"] -= $monto;
                break;

       }
       if ($modelCuenta->update($cuentaId, $cuenta)):
        return array('TransaccionExitosa' => true, 'NuevoFondo' => $cuenta["fondo"]);
        else :
            return array('TransaccionExitosa' => false, 'NuevoFondo' => $cuenta["fondo"]);
        endif;
    }
}
