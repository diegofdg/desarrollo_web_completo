<?php

namespace Controllers;

use MVC\Router;

class ServicioController {
    public static function index(Router $router) {        

        $router->render('servicios/index', [
            
        ]);
    }

    public static function crear(Router $router) {
        echo "desde crear";        

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }        
    }

    public static function actualizar(Router $router) {
        echo "desde actualizar";        
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        }
    }

    public static function eliminar() {
        echo "desde eliminar";

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        }
    }
}