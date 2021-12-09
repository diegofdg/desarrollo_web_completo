<?php 
    namespace Controllers;
    use MVC\Router;
    use Model\Vendedor;

    class VendedorController {
        public static function crear(Router $router) {
            $errores = Vendedor::getErrores();

            $vendedor = new Vendedor();

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $vendedor = new Vendedor($_POST['vendedor']);
        
                $errores = $vendedor->validar();
                
                if(empty($errores)){
                    $vendedor->guardar();
                }        
            }

            $router->render('vendedores/crear', [
                'errores' => $errores,
                'vendedor' => $vendedor
            ]);
        }

        public static function actualizar(Router $router) {
            $id = validarORedireccionar('/admin');
            
            $vendedor = Vendedor::find($id);

            $errores = Vendedor::getErrores();   

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
                $args = $_POST['vendedor'];
                        
                $vendedor->sincronizar($args);                
        
                $errores = $vendedor->validar();        
        
                if(empty($errores)) {
                    $vendedor->guardar();
                }   
            }         

            $router->render('vendedores/actualizar', [
                'vendedor' => $vendedor,
                'errores' => $errores
            ]);
        }

        public static function eliminar() {
            echo "Eliminar vendedor";
        }
    }