<?php
    require_once( 'funciones/funciones.php' );
    
    if($conn->ping()) {
        echo "Conectado";
    } else {
        echo "No conectado";
    }
    
    if(isset($_POST['agregar-admin'])) {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];

        $opciones = array(
            'cost' => 12
        );
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
        var_dump($password_hashed);
    }
    
?>
