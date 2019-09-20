<?php

    class Conexion {
        
        public static function conectar() {
            
            try {
                 $base = new PDO('mysql:host=localhost;dbname=appTareas', 'root', '');
                 $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 
                 return $base;
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
         
        }
    }

