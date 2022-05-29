<?php
    include_once 'funciones/funciones.php';
    $titulo = $_POST['titulo_evento'];
    $categoria_id = $_POST['categoria_evento'];    
    $invitado_id = $_POST['invitado'];    
    $hora_evento = $_POST['hora_evento'];

    $fecha = $_POST['fecha_evento'];
    $fecha_formateada = date('Y-m-d' , strtotime($fecha));

    $hora = $_POST['hora_evento'];

    if($_POST['registro'] == 'nuevo') {
        try {            
            $stmt = $conn->prepare("INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv) VALUES (?, ?, ?, ?, ?) ");
            $stmt->bind_param("sssii", $titulo, $fecha_formateada, $hora_evento, $categoria_id, $invitado_id);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if($stmt->affected_rows) {
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
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        
        die(json_encode($respuesta));
    }

    if($_POST['registro'] == 'actualizar') {
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];    
        $password = $_POST['password'];    
        $id_registro = $_POST['id_registro'];

        try {
            if(empty($_POST['password'])) {
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, editado = NOW() WHERE id_admin = ? ");
                $stmt->bind_param("ssi", $usuario, $nombre, $id_registro);

            } else {
                $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, password = ?, editado = NOW() WHERE id_admin = ? ");
                $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $id_registro);
            }

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
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }

    if($_POST['registro'] == 'eliminar') {
        $id_borrar = $_POST['id'];

        try {
            $stmt = $conn->prepare("DELETE FROM admins WHERE id_admin = ? ");
            $stmt->bind_param("i", $id_borrar);
            $stmt->execute();
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_eliminado' => $id_borrar
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
         
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
?>