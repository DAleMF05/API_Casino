<?php
require_once('app/model/ClienteModel.php');
require_once('app/model/AgenteModel.php');
require_once('app/view/JSONView.php');

class clienteApiController {

    private $model;
    private $model_agent;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new ClienteModel();
        $this->model_agent = new AgenteModel();
        $this->view = new JSONView();

        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function showAllClients() {
        try {
            // Obtener todos los clientes del modelo
            $clientes = $this->model->getAll();
            if($clientes){
                 // Si hay clientes, devolverlos con un código 200 (éxito)
                $response = [
                "status" => 200,
                "clientes" => $clientes
               ];
                $this->view->response($response, 200);
            }       
            else
                // Si no hay clientes, devolver un mensaje con un código 404 (no encontrado)
                 $this->view->response("No hay clientes en la base de datos", 404);
        } catch (Exception $e) {
            // En caso de error del servidor, devolver un mensaje con un código 500 (error del servidor)
            $this->view->response("Error de servidor", 500);
        }
    }

    public function getClient($params = null) {
        $id = $params[':ID'];
        try {
            // Obtiene un cliente del modelo
            $cliente = $this->model->getClient($id);
            // Si existe el cliente, lo retorna con un código 200 (éxito)
            if($cliente){
                $response = [
                "status" => 200,
                "message" => $cliente
               ];
                $this->view->response($response, 200);
            }
            else{
                $response = [
                    "status" => 404,
                    "message" => "No existe el cliente en la base de datos."
                ];
                $this->view->response($response, 404);
            }
        } catch (Exception $e) {
            // En caso de error del servidor, devolver un mensaje con un código 500 (error del servidor)
            $this->view->response("Error de servidor", 500);
        }

    }  

    public function newClient() {
        $clienteNuevo = $this->getData();
        $agente = $this->model_agent->getAgent($clienteNuevo->id_agente);
        if ($agente) {
            $lastId = $this->model->insertClient( 
                $clienteNuevo->nombre_usuario, 
                $clienteNuevo->saldo_cliente,
                $clienteNuevo->activado_cliente,
                $clienteNuevo->id_agente);
            if($lastId){
                $this->view->response("Se insertó correctamente con id: $lastId", 201);

            }else{
                $this->view->response("Error al insertar", 404);
            }
        }else{
            $this->view->response("no existe agente con ese ID", 404);
        }
       

    }

    public function deleteClient($params = null) {
        $id = $params[':ID'];
        $cliente = $this->model->getClient($id);
        if ($cliente) {
            $this->model->delete($id);
            $this->view->response("Cliente $id, eliminado", 200);
        } else {
            $this->view->response("Cliente $id, no encontrado", 404);
        }
    }
    
    function editClient($params = null){
        $id = $params[':ID'];
        $clienteNuevo = $this->getData();
        $cliente= $this->model->getClient($id);
        try {
        
            if($cliente){
                $this->model->editClient( 
                        $clienteNuevo->nombre_usuario, 
                        $clienteNuevo->saldo_cliente,
                        $clienteNuevo->activado_cliente,
                        $id);
                        
                $this->view->response("Cliente $id, editado", 200);
            }else{
                $this->view->response("Cliente $id, no encontrado", 404);
            }    
        } catch (Exception $e) {
            $this->view->response("Error de conexion", 500);
        }
    }
}