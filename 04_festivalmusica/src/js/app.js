document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();    
});

function iniciarApp() {
    crearGaleria();
    scrollNav();
}

function crearGaleria() {
    const galeria = document.querySelector('.galeria-imagenes');

    for( let i = 1; i <= 12; i++ ) {
        const imagen = document.createElement('picture');
        imagen.innerHTML = `
            <source srcset="build/img/thumb/${i}.avif" type="image/avif">
            <source srcset="build/img/thumb/${i}.webp" type="image/webp">
            <img loading="lazy" width="200" height="300" src="build/img/thumb/${i}.jpg" alt="imagen galeria">
        `;
        imagen.onclick = function() {
            mostrarImagen(i);
        };

        galeria.appendChild(imagen);
    }    
}

function scrollNav() {
    const enlaces = document.querySelectorAll('.navegacion-principal a');

    enlaces.forEach( enlace => {
        enlace.addEventListener('click', function(e) {
            e.preventDefault();

            const seccionScroll = e.target.attributes.href.value;
            const seccion = document.querySelector(seccionScroll);
            seccion.scrollIntoView({ behavior: "smooth"});
        });
    });
}

function mostrarImagen(i) {

    const imagen = document.createElement('picture');
    imagen.innerHTML = `
        <source srcset="build/img/grande/${i}.avif" type="image/avif">
        <source srcset="build/img/grande/${i}.webp" type="image/webp">
        <img loading="lazy" width="200" height="300" src="build/img/grande/${i}.jpg" alt="imagen galeria">
    `;    

    const overlay = document.createElement('DIV');
    overlay.appendChild(imagen);
    overlay.classList.add('overlay');

    overlay.onclick = function() {
        const body = document.querySelector('body');
        body.classList.remove('fijar-body');
        overlay.remove();
    }

    const cerrarModal = document.createElement('P');
    cerrarModal.textContent = 'X';
    cerrarModal.classList.add('btn-cerrar');

    cerrarModal.onclick = function() {
        const body = document.querySelector('body');
        body.classList.remove('fijar-body');
        overlay.remove();
    }

    overlay.appendChild(cerrarModal);

    const body = document.querySelector('body');
    body.appendChild(overlay);
    body.classList.add('fijar-body');
}