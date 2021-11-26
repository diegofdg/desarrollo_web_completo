<?php include 'includes/templates/header.php'; ?>
    
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 Años de experiencia</blockquote>
                <p>Proin consequat viverra sapien, malesuada tempor tortor feugiat vitae. In dictum felis et nunc aliquet molestie. Proin tristique commodo felis, sed auctor elit auctor pulvinar. Arcu nisl semper mi, vitae sagittis lorem dolor non risus. Curabitur malesuada sodales congue. Suspendisse potenti. Ut sit amet convallis nisi.</p>
                <p>Aliquam lectus magna, luctus vel gravida nec, iaculis ut augue. Praesent ac enim lorem. Quisque ac dignissim sem, non condimentum orci. Morbi a iaculis neque, ac euismod felis. Fusce augue quam, fermentum sed turpis nec, hendrerit dapibus ante. Cras mattis laoreet nibh, quis tincidunt odio fermentum vel. Nulla facilisi.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quae corporis itaque numquam facere molestias voluptatum beatae nemo nesciunt ipsa impedit incidunt culpa, sunt quis et ullam. Necessitatibus, ut sequi.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quae corporis itaque numquam facere molestias voluptatum beatae nemo nesciunt ipsa impedit incidunt culpa, sunt quis et ullam. Necessitatibus, ut sequi.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quae corporis itaque numquam facere molestias voluptatum beatae nemo nesciunt ipsa impedit incidunt culpa, sunt quis et ullam. Necessitatibus, ut sequi.</p>
            </div>
        </div>
    </section>

<?php include 'includes/templates/footer.php';?>