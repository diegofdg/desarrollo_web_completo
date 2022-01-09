<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor">
        <h2>Calendario de Eventos</h2>

        <?php
            try {
                require_once('includes/funciones/bd_conexion.php');
                $sql = 'SELECT * FROM eventos';
                $resultado = $conn->query($sql);

            } catch(\Exception $e) {
                echo $e->getMessage();
            }
        ?>
        <div class="calendario">
            <?php
                $eventos = $resultado->fetch_assoc();
            ?>
            <pre>
                <?php var_dump($eventos); ?>
            </pre>
        </div>

        <?php
            $conn->close();
        ?>

    </section>

<?php include_once 'includes/templates/footer.php'; ?>