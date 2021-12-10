<?php
    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use PHPMailer\PHPMailer\PHPMailer;

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

        public static function propiedad(Router $router) {        
            $id = validarORedireccionar('/propiedades');
    
            $propiedad = Propiedad::find($id);
    
            $router->render('paginas/propiedad', [
                'propiedad' => $propiedad
            ]);
        }

        public static function blog(Router $router) {
            $router->render('paginas/blog', []);
        }

        public static function entrada(Router $router) {
            $router->render('paginas/entrada', []);
        }

        public static function contacto(Router $router) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $mail = new PHPMailer();

                $mail->isSMTP();            
                $mail->Host = 'smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = '139fe9789cd770';
                $mail->Password = '9687595e2e6148';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 2525;

                $mail->setFrom('admin@bienesraices.com');
                $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
                $mail->Subject = 'Tienes un nuevo mensaje';
                
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';

                $contenido = '<html> <p> Tienes un nuevo mensaje </p> </html>';

                $mail->Body = $contenido;
                $mail->AltBody = 'Esto es texto alternativo sin HTML';

                if($mail->send()) {
                    echo "Mensaje enviado correctamente";
                } else {
                    echo "El mensaje no se pudo enviar";
                }
            }   
    
            $router->render('paginas/contacto', []);
        }
}