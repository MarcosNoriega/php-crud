<?php
    include_once '../models/Tareas.php';
    class TareasController {
        
        private $tarea;
        
        public function __construct() {
            $this->tarea = new Tareas();
        }
        
        public function index() {
            echo $this->tarea->all();
        }
        
        public function create($tarea) {
            $this->tarea->add($tarea);
            
            echo json_encode(array('mensaje' => 'ok'));
        }

        public function delete($id) {
            $this->tarea->delete($id);

            echo json_encode(array('mensaje' => 'ok'));
        }

        public function update($tarea) {
            $this->tarea->update($tarea);

            echo json_encode(array('mensaje' => 'ok'));
        }

        public function show($id) {
            echo $this->tarea->findbyid($id);
        }
    }

