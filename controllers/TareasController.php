<?php
    include_once '../models/Tareas.php';
    class TareasController {
        
        public static function index() {
            $tarea = new Tareas();
            
            echo $tarea->all();
        }
    }

