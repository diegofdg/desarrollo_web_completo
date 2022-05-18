<?php

namespace MVC;

class Router {
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn) {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas() {        
        $currentUrl = ($_SERVER['REQUEST_URI'] === '') ? '/' :  $_SERVER['REQUEST_URI'] ;
        $method = $_SERVER['REQUEST_METHOD'];
                    
        $splitURL = explode('?', $currentUrl);
                 
        if ($method === 'GET') {
            $fn = $this->getRoutes[$splitURL[0]] ?? null;
        } else {
          $fn = $this->postRoutes[$splitURL[0]] ?? null;
        }

        if ( $fn ) {         
            call_user_func($fn, $this);
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = []) {        
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();
        include_once __DIR__ . '/views/layout.php';
    }
}