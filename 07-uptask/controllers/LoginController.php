<?php

namespace Controllers;

class LoginController {
    public static function login() {
        echo "Desde login";    
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
    }    

    public static function logout() {
        echo "Desde logout";
    }    

    public static function olvide() {
        echo "Desde olvide";    
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
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