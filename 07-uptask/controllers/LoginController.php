<?php

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }

        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión'
        ]);
    }    

    public static function logout() {
        echo "Desde logout";
    }    

    public static function crear(Router $router) {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }

        $router->render('auth/crear', [
            'titulo' => 'Crea tu cuenta en UpTask'
        ]);
    }    

    public static function olvide(Router $router) {
        
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
        
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password'
        ]);
    }    

    public static function restablecer() {
        echo "Desde restablecer";    
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
    }    

    public static function mensaje() {
        echo "Desde mensaje";            
        
    }    

    public static function confirmar() {
        echo "Desde confirmar";           
    
    }    
}