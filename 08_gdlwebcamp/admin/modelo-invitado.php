<?php
    include_once 'funciones/funciones.php';    

    if($_POST['registro'] == 'nuevo') {
        /*
        $respuesta = array(
            'post' => $_POST,
            'file' => $_FILES
        );
        die(json_encode($respuesta));
        */

        $directorio = "../img/invitados/";
        if(!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        if(move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $_FILES['archivo_imagen']['name'])) {
            $imagen_url = $_FILES['archivo_imagen']['name'];
            $imagen_resultado = "Se subió correctamente" ;
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }

        try {
            $nombre = $_POST['nombre_invitado'];
            $apellido = $_POST['apellido_invitado'];
            $biografia = $_POST['biografia_invitado'];
            
            $stmt = $conn->prepare("INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?, ?, ?, ?) ");
            $stmt->bind_param("ssss", $nombre, $apellido, $biografia, $imagen_url);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $id_registro,
                    'resultado_imagen' => $imagen_resultado
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
        $nombre_categoria = $_POST['nombre'];
        $icono = $_POST['icono'];
        $id_registro = $_POST['id_registro'];
        
        try {
            $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ?, editado = NOW() WHERE id_categoria = ? ");
            $stmt->bind_param("ssi", $nombre_categoria, $icono, $id_registro);
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
            $stmt = $conn->prepare("DELETE FROM categoria_evento WHERE id_categoria = ? ");
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