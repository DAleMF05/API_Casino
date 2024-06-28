<?php
    require_once('libs/Router.php');
    require_once('app/controller/agenteApiController.php');
    require_once('app/controller/clienteApiController.php');
    

    $router = new Router();

    // GET http://localhost/api/clientes 
    
    $router->addRoute('clientes', 'GET', 'clienteApiController', 'showAllClients');
    $router->addRoute('clientes/:ID', 'GET', 'clienteApiController', 'getClient');
    $router->addRoute('clientes', 'POST', 'clienteApiController', 'newClient');
    $router->addRoute('clientes/:ID', 'DELETE', 'clienteApiController', 'deleteClient');
    $router->addRoute('clientes/:ID', 'PUT', 'clienteApiController', 'editClient');
    
    // $router->addRoute('tareas/:ID', 'PUT', 'TaskApiController', 'finalizaTarea');

    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
