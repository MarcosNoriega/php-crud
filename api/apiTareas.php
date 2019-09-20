<?php

    include_once '../controllers/TareasController.php';
    
    $tareasController = new TareasController();
    
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tareasController->index();
    }

