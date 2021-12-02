<?php 
    require '../../includes/funciones.php';
        
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }
    
    incluirTemplate('header');    
?>
    
    <main class="contenedor seccion">
        <h1>Eliminar</h1>
    </main>

<?php 
    incluirTemplate('footer');
?>