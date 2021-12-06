<?php 
    use App\Propiedad;

    require '../../includes/app.php';    
    
    estaAutenticado();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if(!$id) {
        header('Location: /admin');
    }

    $db = conectarDB();

    $propiedad = Propiedad::find($id);

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
        $precio = mysqli_real_escape_string( $db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string( $db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        $imagen = $_FILES['imagen'];

        if(!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }
        if(!$precio) {
            $errores[] = 'El Precio es Obligatorio';
        }

        if( strlen( $descripcion ) < 50 ) {
            $errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if(!$habitaciones) {
            $errores[] = 'El Número de habitaciones es obligatorio';
        }
        
        if(!$wc) {
            $errores[] = 'El Número de Baños es obligatorio';
        }

        if(!$estacionamiento) {
            $errores[] = 'El Número de lugares de Estacionamiento es obligatorio';
        }
        
        if(!$vendedorId) {
            $errores[] = 'Elige un vendedor';
        }

        $medida = 1000 * 1000;

        if($imagen['size'] > $medida ) {
            $errores[] = 'La Imagen es muy pesada';
        }
        
        if(empty($errores)) {
            $carpetaImagenes = '../../imagenes/';

            if($imagen['name']) {
                unlink($carpetaImagenes . $propiedad['imagen']);                

                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
                
            } else {
                $nombreImagen = $propiedad['imagen'];
            }
            
            $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id} ";

            $resultado = mysqli_query($db, $query);                

            if($resultado) {
                header('Location: /admin?resultado=2');
            }
        }        
    }
    
    incluirTemplate('header');    
?>
    
    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>