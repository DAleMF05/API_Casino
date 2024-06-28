<?php

require_once "app/model/Model.php";

class ClienteModel extends Model{

    
function getAll(){
    //abrimos la conexion;
    $db = $this->createConexion();
   
    //Enviar la consulta
    $sentencia = $db->prepare("SELECT * FROM clientes");
    $sentencia->execute();
    $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $clientes;
}

function getAllCliete_y_Agente(){
    //abrimos la conexion;
    $db = $this->createConexion();
   
    //Enviar la consulta
    $sentencia = $db->prepare("SELECT * FROM clientes c, agentes a WHERE c.id_agente = a.id_agente");
    $sentencia->execute();
    $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $clientes;
}

function insertClient($nombre, $saldo, $activado_cliente, $id){
    //abrimos la conexion;
    $db = $this->createConexion();
   
    //Enviar la consulta
    $resultado= $db->prepare("INSERT INTO clientes (nombre_usuario, saldo_cliente, activado_cliente, id_agente) VALUES (?,?,?,?)");
    $resultado->execute([$nombre, $saldo, $activado_cliente, $id]); // ejecuta
    return $db->lastInsertId();
}


function delete($id){
    $db = $this->createConexion();
    $resultado= $db->prepare("DELETE FROM clientes WHERE id_cliente = ?");
    $resultado->execute([$id]); // ejecuta
}


function getClients($id){
    //abrimos la conexion;
    $db = $this->createConexion();
   
    //Enviar la consulta
    $sentencia = $db->prepare("SELECT * FROM clientes WHERE id_agente = ?");
    $sentencia->execute([$id]);
    $cliente = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $cliente;
}

function getClient($id){
    //abrimos la conexion;
    $db = $this->createConexion();
   
    //Enviar la consulta
    $sentencia = $db->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
    $sentencia->execute([$id]);
    $cliente = $sentencia->fetch(PDO::FETCH_OBJ);
    return $cliente;
}

function editClient($nombre_usuario, $saldo_cliente, $activado_cliente, $id_cliente){
    $db = $this->createConexion();

    $resultado= $db->prepare("UPDATE clientes SET nombre_usuario=?, saldo_cliente=?, activado_cliente=? WHERE id_cliente = ?");
    $resultado->execute([$nombre_usuario, $saldo_cliente, $activado_cliente, $id_cliente]);
    
    if ($resultado->rowCount() > 0) {
        return true; // Actualización exitosa
    } else {
        return false; // No se actualizó ninguna fila (o hubo un error)
    }
}

}
