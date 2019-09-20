<?php

    include_once '../DB/Conexion.php';
    
    class Tareas {
        private $base;
        
        public function __construct() {
            $this->base = Conexion::conectar();
            
        }
        
        public function all() {
           $resultado = $this->base->query("SELECT * From Tareas");
            
            $json = array();
            while($registros = $resultado->fetch(PDO::FETCH_ASSOC)){
                $json[] = $registros;
            }
            
            $jsonString = json_encode($json);
            return $jsonString;
        }
        
    }
