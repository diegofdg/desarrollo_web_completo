<?php
    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;

    class PaginasController {
        public static function index(Router $router) {
            $propiedades = Propiedad::get(3);
            $inicio = true;
    
            $router->render('paginas/index', [
                'propiedades' => $propiedades,
                'inicio' => $inicio
            ] );
        }
        
        public static function nosotros() {
            echo "Desde nosotros";
        }
        
        public static function propiedades() {
            echo "Desde propiedades";
        }

        public static function propiedad() {
            echo "Desde propiedad";
        }

        public static function blog() {
            echo "Desde blog";
        }

        public static function entradas() {
            echo "Desde entradas";
        }

        public static function contacto() {
            echo "Desde contacto";
        }
}