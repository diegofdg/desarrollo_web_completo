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
                Listado de Invitados
                <small></small>
            </h1>      
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">            
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Administra la lista de invitados y su información aquí</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="registros" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Biografía</th>
                                        <th>Imágen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    try {
                                        $sql = "SELECT * FROM invitados ";
                                        $resultado = $conn->query($sql);
                                    } catch (Exception $e) {
                                        $error = $e->getMessage();
                                    }
                                ?>
                                
                                <?php while($invitado = $resultado->fetch_assoc() ) { ?>
                                    <tr>
                                        <td><?php echo $invitado['nombre_invitado'] . "" . $invitado['apellido_invitado']; ?></td>
                                        <td><?php echo $invitado['descripcion']; ?></td>
                                        <td><img src="../img/invitados/<?php echo $invitado['url_imagen']; ?>" alt="imagen invitado" width="150"></td>
                                        <td>
                                            <a href="editar-invitado.php?id=<?php echo $invitado['invitado_id']; ?>" type="button" class="btn bg-orange btn-flat margin">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a href="#" data-id="<?php echo $invitado['invitado_id']; ?>" data-tipo="invitado" type="button" class="btn bg-maroon btn-flat margin borrar_registro">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Biografía</th>
                                        <th>Imágen</th>
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