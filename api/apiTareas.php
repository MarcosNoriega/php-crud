<?php

    include_once '../controllers/TareasController.php';
    
    $tareasController = new TareasController();
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data)) {
            $tareasController->show($data['id']);
        }else {
            $tareasController->index();
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tarea = json_decode(file_get_contents('php://input'), true);
         
        $tareasController->create($tarea);
        
    }

    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);

        $tareasController->delete($data['id']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $tarea = json_decode(file_get_contents('php://input'), true);

        $tareasController->update($tarea);
    }

