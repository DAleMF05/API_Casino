<?php
require_once "config.php";

class Model{
    
    protected $conexion;

    public function __construct()
    {
         $this->conexion = $this->createConexion();
         $this->deploy();
       
    }
    function createConexion(){
      try {
          $db = new PDO("mysql:host=".MYSQL_HOST.";charset=utf8", MYSQL_USER, MYSQL_PASS);
         
          $this->createOrUseDatabase($db);

      
      } catch(Exception $e){
          die("Error al conectar a la base de datos: " . $e->getMessage());
      }

      return $db;

  }

  /*FUNCION QUE VERIFICA SI EXISTE LA BASE DE DATOS, SI EXISTE HACE USO DE LA MISMA CASO CONTRARIO LA CREA.*/
  private function createOrUseDatabase($db){
    $query = $db->query("SHOW DATABASES LIKE '".MYSQL_DB."'");
    $databaseExists = $query->rowCount() > 0;

    if(!$databaseExists) {
        $db->query("CREATE DATABASE ".MYSQL_DB."");
    }
    
    $db->query("USE ".MYSQL_DB."");
}



  private function deploy() {
    $this->createTables();           
}
// CREATE TABLE IF NOT EXISTS


private function createTables() {
         
         $sql = "CREATE TABLE IF NOT EXISTS `agentes` (
          `id_agente` int(11) NOT NULL AUTO_INCREMENT,
          `nombre` varchar(250) NOT NULL,
          `saldo` double(10,2) NOT NULL,
          `email` varchar(250) NOT NULL,
          `activado` tinyint(1) NOT NULL,
          PRIMARY KEY (id_agente)
        );        
        
        -- --------------------------------------------------------

        
        CREATE TABLE IF NOT EXISTS `clientes` (
          `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
          `nombre_usuario` varchar(100) NOT NULL,
          `saldo_cliente` double(10,2) NOT NULL,
          `activado_cliente` tinyint(1) NOT NULL,
          `id_agente` int(11) NOT NULL,
          PRIMARY KEY (id_cliente)
        );
        
        -- --------------------------------------------------------
        

        
        CREATE TABLE IF NOT EXISTS `usuario` (
          `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
          `email` varchar(250) NOT NULL,
          `password` varchar(250) NOT NULL,
          `rol` varchar(20) NOT NULL,
          PRIMARY KEY (id_usuario)
        );
       
        ALTER TABLE `clientes`
          ADD CONSTRAINT `fk_clientes_agentes` FOREIGN KEY (`id_agente`) REFERENCES `agentes` (`id_agente`);
        
        " ;

        $this->conexion->query($sql);
        }
    

      }