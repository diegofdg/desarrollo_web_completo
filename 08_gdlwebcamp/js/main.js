(function () {
    "use strict";

    document.addEventListener('DOMContentLoaded', function() {
        if(document.getElementById('mapa')){
            var map = L.map('mapa').setView([20.674781, -103.38749], 17);
    
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
    
            L.marker([20.674781, -103.38749]).addTo(map)
                .bindPopup('GDLWebCamp 2021 <br> Boletos ya disponibles')
                .openPopup();   
            /* L.scrollWheelZoom('center'); */
        }
    });
})();

$(function() {
    $('.nombre-sitio').lettering();

    $('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');

    var windowHeight = $(window).height();
    var barraAltura = $('.barra').innerHeight();

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if(scroll > windowHeight) {
            $('.barra').addClass('fixed');
            $('body').css({'margin-top': barraAltura + 'px'});
        } else {
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top':'0px'});
        }
    });

    $('.menu-movil').on('click', function() {
        $('.navegacion-principal').slideToggle();

    });

    $('.programa-evento .info-curso:first').show(); 
    $('.menu-programa a:first').addClass('activo');    
    
    $('.menu-programa a').on('click', function() {
        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');
        $('.ocultar').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);
        return false;
    });

    var resumenLista = jQuery('.resumen-evento');
    if(resumenLista.length > 0) {
        $('.resumen-evento').waypoint(function() {
            $('.resumen-evento li:nth-child(1) p').animateNumber({ number: 6 }, 1200);
            $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 15 }, 1200);
            $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 3 }, 1500);
            $('.resumen-evento li:nth-child(4) p').animateNumber({ number: 9 }, 1500);
        }, {
            offset: '60%'
        });
    }

    $('.cuenta-regresiva').countdown('2022/12/10 09:00:00', function(event) {
        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));
    });

    var invitadoInfo = jQuery('.invitado-info');
    if(invitadoInfo.length > 0){
        $('.invitado-info').colorbox({inline: true, width: "50%"});
    }
});