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
        
        public static function nosotros(Router $router) {
            $router->render('paginas/nosotros', []);                
        }
        
        public static function propiedades(Router $router) {
            $propiedades = Propiedad::all();
            $router->render('paginas/propiedades', [
                'propiedades' => $propiedades
            ]); 
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