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
        
        public function add($tarea) {
            $this->base->query("INSERT INTO tareas(nombre, description) value ('" . $tarea['nombre'] . "', '" . $tarea['description'] . "')");
        }

        public function delete($id) {
            $this->base->query("DELETE FROM tareas WHERE Id = " . $id);
        }

        public function update($tarea) {
            $this->base->query('UPDATE tareas SET nombre = "'. $tarea['nombre'] . '", description = "' . $tarea['description'] . '" WHERE Id = '. $tarea['id']);
        }

        public function findbyid($id) {
            $resultados = $this->base->query('SELECT * FROM Tareas WHERE Id = ' . $id);

            $json = array();

            While($registro = $resultados->fetch(PDO::FETCH_ASSOC)) {
                $json[] = $registro;
            }

            return json_encode($json);
            
        }
        
    }
