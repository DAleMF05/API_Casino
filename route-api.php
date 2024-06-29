<?php
    require_once('libs/Router.php');
    require_once('app/controller/agenteApiController.php');
    require_once('app/controller/clienteApiController.php');
    require_once('app/controller/AuthApiController.php');
    

    $router = new Router();

    // GET http://localhost/api/clientes 
    
    $router->addRoute('clientes', 'GET', 'clienteApiController', 'showAllClients');
    $router->addRoute('clientes/:ID', 'GET', 'clienteApiController', 'getClient');
    $router->addRoute('clientes', 'POST', 'clienteApiController', 'newClient');
    $router->addRoute('clientes/:ID', 'DELETE', 'clienteApiController', 'deleteClient');
    $router->addRoute('clientes/:ID', 'PUT', 'clienteApiController', 'editClient');

    $router->addRoute('agentes', 'GET', 'agenteApiController', 'showAllAgents');
    $router->addRoute('agentes/:ID', 'GET', 'agenteApiController', 'getAgent');
    $router->addRoute('agentes', 'POST', 'agenteApiController', 'newAgent');
    $router->addRoute('agentes/:ID', 'DELETE', 'agenteApiController', 'deleteAgent');
    $router->addRoute('agentes/:ID', 'PUT', 'agenteApiController', 'editAgent');

    $router->addRoute('usuario', 'POST', 'AuthApiController', 'login');


    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
