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
                Listado de Personas Registradas
                <small></small>
            </h1>      
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">            
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Maneja los visitantes registrados</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="registros" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Fecha Registro</th>
                                        <th>Artículos</th>
                                        <th>Talleres</th>
                                        <th>Regalo</th>
                                        <th>Compra</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    try {
                                        $sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados ";
                                        $sql .= "JOIN regalos ";
                                        $sql .= "ON registrados.regalo = regalos.ID_regalo ";
                                        $resultado = $conn->query($sql);
                                    } catch (Exception $e) {
                                        $error = $e->getMessage();
                                    }
                                ?>
                                    
                                <?php while($registrado = $resultado->fetch_assoc() ) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                                echo $registrado['nombre_registrado'] . " " . $registrado['apellido_registrado'];
                                                $pagado = $registrado['payment_status'];
                                                if($pagado == 'approved') {
                                                    echo '<span class="badge bg-green">Pagado</span>';
                                                } else {
                                                    echo '<span class="badge bg-red">No Pagado</span>';
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $registrado['email_registrado']; ?></td>
                                        <td><?php echo $registrado['fecha_registro']; ?></td>
                                        <td>
                                            <?php 
                                                $articulos = json_decode($registrado['pases_articulos'], true);
                                                $arreglo_articulos = array(
                                                    'un_dia' => 'Pase 1 día',
                                                    'pase_2dias' => 'Pase 2 días',
                                                    'pase_completo' => 'Pase Completo',
                                                    'camisas' => 'Camisas',
                                                    'etiquetas' => 'Etiquetas'
                                                );

                                                foreach($articulos as $llave => $articulo) {
                                                    echo $articulo . " " . $arreglo_articulos[$llave] . "<br>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $registrado['talleres_registrados']; ?></td>
                                        <td><?php echo $registrado['nombre_regalo']; ?></td>
                                        <td>$ <?php echo $registrado['total_pagado']; ?></td>
                                        <td>
                                            <a href="editar-registrado.php?id=<?php echo $registrado['ID_registrado']; ?>" type="button" class="btn bg-orange btn-flat margin">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a href="#" data-id="<?php echo $registrado['ID_registrado']; ?>" data-tipo="registrado" type="button" class="btn bg-maroon btn-flat margin borrar_registro">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Fecha Registro</th>
                                        <th>Artículos</th>
                                        <th>Talleres</th>
                                        <th>Regalo</th>
                                        <th>Compra</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
    <!-- /.content-wrapper -->

<?php
    include_once 'templates/footer.php';
?>