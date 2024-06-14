<?php
require_once('app/model/ClienteModel.php');
require_once('app/view/JSONView.php');

class clienteApiController {

    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new ClienteModel();
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

        $lastId = $this->model->insertClient( 
                $clienteNuevo->nombre_usuario, 
                $clienteNuevo->saldo,
                $clienteNuevo->activado_cliente,
                $clienteNuevo->id);

        $this->view->response("Se insertó correctamente con id: $lastId", 200);

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
}