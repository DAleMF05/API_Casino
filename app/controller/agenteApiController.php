<?php
require_once('app/model/AgenteModel.php');
require_once('app/view/JSONView.php');

class agenteApiController {

    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new AgenteModel();
        $this->view = new JSONView();

        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function showAllAgents() {
        try {
            // Obtener todos los agentes del modelo
            $agentes = $this->model->getAll();
            if($agentes){
                 // Si hay agentes, devolverlos con un código 200 (éxito)
                $response = [
                "status" => 200,
                "agentes" => $agentes
               ];
                $this->view->response($response, 200);
            }       
            else
                // Si no hay agentes, devolver un mensaje con un código 404 (no encontrado)
                 $this->view->response("No hay agentes en la base de datos", 404);
        } catch (Exception $e) {
            // En caso de error del servidor, devolver un mensaje con un código 500 (error del servidor)
            $this->view->response("Error de servidor", 500);
        }
    }

    public function getAgent($params = null) {
        $id = $params[':ID'];
        try {
            // Obtiene un agente del modelo
            $agente = $this->model->getAgent($id);
            // Si existe el agente, lo retorna con un código 200 (éxito)
            if($agente){
                $response = [
                "status" => 200,
                "message" => $agente
               ];
                $this->view->response($response, 200);
            }
            else{
                $response = [
                    "status" => 404,
                    "message" => "No existe el agente en la base de datos."
                ];
                $this->view->response($response, 404);
            }
        } catch (Exception $e) {
            // En caso de error del servidor, devolver un mensaje con un código 500 (error del servidor)
            $this->view->response("Error de servidor", 500);
        }

    }  

    public function newAgent() {
        $agenteNuevo = $this->getData();

        $lastId = $this->model->insertAgent( 
                $agenteNuevo->nombre, 
                $agenteNuevo->saldo,
                $agenteNuevo->email,
                $agenteNuevo->activado,
                $agenteNuevo->id);

        $this->view->response("Se insertó correctamente con id: $lastId", 200);

    }

    public function deleteAgent($params = null) {
        $id = $params[':ID'];
        $agente = $this->model->getAgent($id);
        if ($agente) {
            $this->model->delete($id);
            $this->view->response("agente $id, eliminado", 200);
        } else {
            $this->view->response("agente $id, no encontrado", 404);
        }
    }
    
}