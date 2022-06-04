<?php
    include_once 'funciones/sesiones.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php'; 
    include_once 'templates/barra.php'; 
    include_once 'templates/navegacion.php'; 
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Información sobre el evento</small>
            </h1>      
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <?php
                        $sql = "SELECT COUNT(ID_Registrado) AS registros FROM registrados";
                        $resultado = $conn->query($sql);
                        $registrados = $resultado->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $registrados ['registros']; ?></h3>
                            <p>Total Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="lista_registrado.php" class="small-box-footer">
                            Más Información <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <?php
                        $sql = "SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE payment_status = 'approved'";
                        $resultado = $conn->query($sql);
                        $registrados = $resultado->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $registrados ['registros']; ?></h3>
                            <p>Total Pagados</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="lista_registrado.php" class="small-box-footer">
                            Más Información <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <?php
                        $sql = "SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE payment_status = 'no pagado'";
                        $resultado = $conn->query($sql);
                        $registrados = $resultado->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $registrados ['registros']; ?></h3>
                            <p>Total No Pagados</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-times"></i>
                        </div>
                        <a href="lista_registrado.php" class="small-box-footer">
                            Más Información <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <?php
                        $sql = "SELECT SUM(total_pagado) AS ganancias FROM registrados WHERE payment_status = 'approved'";
                        $resultado = $conn->query($sql);
                        $registrados = $resultado->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>$<?php echo $registrados ['ganancias']; ?></h3>
                            <p>Ganancias Totales</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <a href="lista_registrado.php" class="small-box-footer">
                            Más Información <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<?php   
    include_once 'templates/footer.php';
?>