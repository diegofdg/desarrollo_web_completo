<?php
    include_once 'funciones/funciones.php';
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    
    $opciones = array(
        'cost' => 12
    );
    /* echo "<pre>";
        var_dump($_POST);
    echo "</pre>"; */

    if($_POST['registro'] == 'nuevo') {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
        
        try {            
            $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $usuario, $nombre, $password_hashed);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if($id_registro > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_admin' => $id_registro
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        
        die(json_encode($respuesta));
    }

    if($_POST['registro'] == 'actualizar') {
        $id_registro = $_POST['id_registro'];
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

        try {            
            $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, password = ? WHERE id_admin = ? ");
            $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $id_registro);
            $stmt->execute();
            
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_actualizado' => $id_registro
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        
        die(json_encode($respuesta));
    }
    
    if(isset($_POST['login-admin'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        try {
            include_once 'funciones/funciones.php';
            $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?;");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin);
            if($stmt->affected_rows) {
                $existe = $stmt->fetch();
                if($existe) {
                    if(password_verify($password, $password_admin)) {
                        session_start();
                        $_SESSION['usuario'] = $usuario_admin;
                        $_SESSION['nombre'] = $nombre_admin;
                        $respuesta = array(
                            'respuesta' => 'exitoso',
                            'usuario' => $nombre_admin
                        );
                    } else {
                        $respuesta = array(
                            'respuesta' => 'error'
                        );
                    }
                } else {
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        die(json_encode($respuesta));
    }
?>