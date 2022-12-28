<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor">
        <h2>La mejor conferencia de diseño web en español</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis vitae odit impedit accusamus exercitationem nesciunt praesentium velit veniam nisi veritatis dolor at, voluptas magni. Velit, delectus qui! Explicabo, at eligendi. Quod aut eum, explicabo, saepe enim aperiam sed vitae eaque quae, veniam doloremque cupiditate blanditiis quam?.</p>
    </section>

    <section class="programa">
        <div class="contenedor-video">
            <video autoplay loop poster="img/bg-talleres.jpg">
                <source src="video/video.mp4" type="video/mp4">
                <source src="video/video.webm" type="video/webm">
                <source src="video/video.ogv" type="video/ogv">
            </video>
        </div>
        <div class="contenido-programa">
            <div class="contenedor">
                <div class="programa-evento">
                    <h2>Programa del Evento</h2>

                    <?php 
                        try {
                            require_once('includes/funciones/bd_conexion.php');
                            $sql = " SELECT * FROM categoria_evento ";                            
                            $resultado = $conn->query($sql);

                        } catch(\Exception $e) {
                            echo $e->getMessage();
                        }
                    ?>

                    <nav class="menu-programa">
                        <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                            <?php $categoria = $cat['cat_evento']; ?>
                            <a href="#<?php echo strtolower($categoria) ?>"><i class="fas <?php echo $cat['icono'] ?>" aria-hidden="true"></i><?php echo $categoria ?></a>                      
                        <?php } ?>
                    </nav>

                    <?php 
                        try {
                            require_once('includes/funciones/bd_conexion.php');
                            $sql = "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `nombre_invitado`, `apellido_invitado` ";
                            $sql .= "FROM `eventos` ";
                            $sql .= "INNER JOIN `categoria_evento` ";
                            $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";
                            $sql .= "INNER JOIN `invitados` ";
                            $sql .= "ON eventos.id_inv=invitados.invitado_id ";
                            $sql .= "AND eventos.id_cat_evento = 1 ";
                            $sql .= "ORDER BY `evento_id` LIMIT 2;";
                            $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `nombre_invitado`, `apellido_invitado` ";
                            $sql .= "FROM `eventos` ";
                            $sql .= "INNER JOIN `categoria_evento` ";
                            $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";
                            $sql .= "INNER JOIN `invitados` ";
                            $sql .= "ON eventos.id_inv=invitados.invitado_id ";
                            $sql .= "AND eventos.id_cat_evento = 2 ";
                            $sql .= "ORDER BY `evento_id` LIMIT 2;";
                            $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `nombre_invitado`, `apellido_invitado` ";
                            $sql .= "FROM `eventos` ";
                            $sql .= "INNER JOIN `categoria_evento` ";
                            $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";
                            $sql .= "INNER JOIN `invitados` ";
                            $sql .= "ON eventos.id_inv=invitados.invitado_id ";
                            $sql .= "AND eventos.id_cat_evento = 3 ";
                            $sql .= "ORDER BY `evento_id` LIMIT 2;";
                        } catch (Exception $e) {
                            $error = $e->getMessage();
                        }
                    ?>

                    <?php $eventos = $resultado->fetch_assoc(); ?>

                    <?php $conn->multi_query($sql); ?>

                    <?php
                        do {
                            $resultado = $conn->store_result();
                            $row = $resultado->fetch_all(MYSQLI_ASSOC); ?>

                            <?php $i = 0; ?>

                            <?php foreach($row as $evento): ?>

                                <?php if($i % 2 == 0) { ?>
                                    <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix">
                                <?php } ?>
                                        <div class="detalle-evento">
                                            <h3><?php echo html_entity_decode($evento['nombre_evento']) ?></h3>
                                            <p><i class="far fa-clock" aria-hidden="true"></i> <?php echo $evento['hora_evento']; ?></p>
                                            <p><i class="far fa-calendar" aria-hidden="true"></i> <?php echo $evento['fecha_evento']; ?></p>
                                            <p><i class="far fa-user" aria-hidden="true"></i> <?php echo $evento['nombre_invitado'] . " " .  $evento['apellido_invitado']; ?></p>
                                        </div>
                                    <?php if($i % 2 == 1): ?>
                                        <a href="calendario.php" class="button float-right">Ver todos</a>
                                    </div>
                                <?php endif; ?>

                            <?php $i++; ?>

                            <?php endforeach; ?>

                            <?php $resultado->free(); ?>
                            
                    <?php } while ($conn->more_results() && $conn->next_result()); ?>
                </div>
            </div>
        </div>
    </section>

    <?php include_once 'includes/templates/invitados.php'; ?>

    <div class="contador parallax">
        <div class="contenedor">
            <ul class="resumen-evento clearfix">
                <li><p class="numero">0</p> Invitados</li>
                <li><p class="numero">0</p> Talleres</li>
                <li><p class="numero">0</p> Días</li>
                <li><p class="numero">0</p> Conferencias</li>
            </ul>
        </div>
    </div>

    <section class="precios seccion">
        <h2>Precios</h2>
        <div class="contenedor">
            <ul class="lista-precios clearfix">
                <li>
                    <div class="tabla-precio">
                        <h3>Pase por día</h3>
                        <p class="numero">$30</p>
                        <ul>
                            <li><i class="fas fa-check"></i>Bocadillos Gratis</li>
                            <li><i class="fas fa-check"></i>Todas las conferencias</li>
                            <li><i class="fas fa-check"></i>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
                    </div>
                </li>
                <li>
                    <div class="tabla-precio">
                        <h3>Todos los días</h3>
                        <p class="numero">$50</p>
                        <ul>
                            <li><i class="fas fa-check"></i>Bocadillos Gratis</li>
                            <li><i class="fas fa-check"></i>Todas las conferencias</li>
                            <li><i class="fas fa-check"></i>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button">Comprar</a>
                    </div>
                </li>
                <li>
                    <div class="tabla-precio">
                        <h3>Pase por 2 días</h3>
                        <p class="numero">$45</p>
                        <ul>
                            <li><i class="fas fa-check"></i>Bocadillos Gratis</li>
                            <li><i class="fas fa-check"></i>Todas las conferencias</li>
                            <li><i class="fas fa-check"></i>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <div id="mapa" class="mapa"></div>

    <section class="seccion">
        <h2>Testimoniales</h2>    
        <div class="testimoniales contenedor clearfix">
            <div class="testimonial">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum officia sed obcaecati voluptates placeat repudiandae aliquam velit recusandae esse, quis reiciendis quaerat voluptatem distinctio eius doloremque delectus deleniti in non.</p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="imagen testimonial">
                        <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <div class="testimonial">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum officia sed obcaecati voluptates placeat repudiandae aliquam velit recusandae esse, quis reiciendis quaerat voluptatem distinctio eius doloremque delectus deleniti in non.</p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="imagen testimonial">
                        <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <div class="testimonial">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum officia sed obcaecati voluptates placeat repudiandae aliquam velit recusandae esse, quis reiciendis quaerat voluptatem distinctio eius doloremque delectus deleniti in non.</p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="imagen testimonial">
                        <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
        </div>
    </section>

    <div class="newsletter parallax">
        <div class="contenido contenedor">
            <!-- Begin Mailchimp Signup Form -->
            <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7_dtp.css" rel="stylesheet" type="text/css">
            <style type="text/css">
                #mc_embed_signup {
                    background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; 
                }
                /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
            </style>
            <div id="form_register_mailchimp">
                <div id="mc_embed_signup">
                    <form action="https://gmail.us5.list-manage.com/subscribe/post?u=e848d475871757dd33e24a98c&amp;id=599d5e9e1b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                            <h2>Suscríbete a nuestro Newstter para no perderte ningún detalle</h2>
                            <div class="indicates-required"><span class="asterisk">*</span> es obligatorio</div>
                            <div class="mc-field-group">
                                <label for="mce-EMAIL">Correo Electrónico  <span class="asterisk">*</span>
                            </label>
                            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                        </div>
                        <div class="mc-field-group">
                            <label for="mce-FNAME">Nombre Completo</label>
                            <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                        </div>
                        <div id="mce-responses" class="clear foot">
                            <div class="response" id="mce-error-response" style="display:none"></div>
                            <div class="response" id="mce-success-response" style="display:none"></div>
                        </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_e848d475871757dd33e24a98c_599d5e9e1b" tabindex="-1" value=""></div>
                            <div class="optionalParent">
                                <div class="clear foot">
                                    <input type="submit" value="Suscribirse" name="subscribe" id="mc-embedded-subscribe" class="button">
                                    <p class="brandingLogo"><a href="http://eepurl.com/hRWx3n" title="Mailchimp - email marketing made easy and fun"><img src="https://eep.io/mc-cdn-images/template_images/branding_logo_text_dark_dtp.svg"></a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
            <!--End mc_embed_signup-->
        </div>
    </div>

    <section class="seccion">
        <h2>Faltan</h2>
        <div class="cuenta-regresiva contenedor">
            <ul class="clearfix">
                <li><p id="dias" class="numero"></p> días</li>
                <li><p id="horas" class="numero"></p> horas</li>
                <li><p id="minutos" class="numero"></p> minutos</li>
                <li><p id="segundos" class="numero"></p> segundos</li>
            </ul>
        </div>
    </section>

<?php include_once 'includes/templates/footer.php'; ?>