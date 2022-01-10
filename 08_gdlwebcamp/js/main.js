(function () {
    "use strict";

    var regalo = document.getElementById('regalo');
    
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

        if(document.getElementById('calcular')){
            var nombre = document.getElementById('nombre');
            var apellido = document.getElementById('apellido');
            var email = document.getElementById('email');
    
            var pase_dia = document.getElementById('pase_dia');
            var pase_dosdias = document.getElementById('pase_dosdias');
            var pase_completo = document.getElementById('pase_completo');
    
            var calcular = document.getElementById('calcular');
            var errorDiv = document.getElementById('error');
            var botonRegistro = document.getElementById('btnRegistro');
            var lista_productos = document.getElementById('lista-productos');
            var suma = document.getElementById('suma-total');
            var camisas = document.getElementById('camisa_evento');
            var etiquetas = document.getElementById('etiquetas');
    
            calcular.addEventListener('click', calcularMontos);
    
            pase_dia.addEventListener('blur', mostrarDias);
            pase_dosdias.addEventListener('blur', mostrarDias);
            pase_completo.addEventListener('blur', mostrarDias);
    
            nombre.addEventListener('blur', validarCampos);
            apellido.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarMail);
    
            function validarCampos() {
                if(this.value == '') {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = 'Este campo es obligatorio';
                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red';
                } else {
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #CCCCCC';
                }
            }
    
            function validarMail() {
                if(this.value.indexOf("@") > -1) {
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #CCCCCC';
                } else {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = 'Debe tener algún @';
                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red';
                }
            }
    
            function calcularMontos(e) {
                e.preventDefault;
                if(regalo.value === '') {
                    alert("Debes elegir un regalo");
                    regalo.focus();
                } else {
                    var boletosDia = parseInt(pase_dia.value, 10) || 0;
                    var boletos2Dias = parseInt(pase_dosdias.value, 10) || 0;
                    var boletosCompleto = parseInt(pase_completo.value, 10) || 0;
                    var cantidadCamisas = parseInt(camisas.value, 10) || 0;
                    var cantidadEtiquetas = parseInt(etiquetas.value, 10) || 0;
    
                    var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletosCompleto * 50) + ((cantidadCamisas * 10) * 0.93) + (cantidadEtiquetas * 2);
    
                    var listadoProductos = [];               
    
                    if(boletosDia >= 1) {
                        listadoProductos.push(boletosDia + ' Pases por dia');                    
                    }
    
                    if(boletos2Dias >= 1) {
                        listadoProductos.push(boletos2Dias + ' Pases por 2 dias');                    
                    }
    
                    if(boletosCompleto >= 1) {
                        listadoProductos.push(boletosCompleto + ' Pases completos');                    
                    }
    
                    if(cantidadCamisas >= 1) {
                        listadoProductos.push(cantidadCamisas + ' Camisas');                    
                    }
    
                    if(cantidadEtiquetas >= 1) {                    
                        listadoProductos.push(cantidadEtiquetas + ' Etiquetas');
                    }
    
                    lista_productos.style.display = 'block';
                    lista_productos.innerHTML = '';
    
                    for(var i = 0; i < listadoProductos.length; i++) {
                        lista_productos.innerHTML += listadoProductos[i] + '<br/>';
                    }
                    suma.innerHTML = '$' + totalPagar.toFixed(2);
                }
            }
    
            function mostrarDias() {
                var boletosDia = parseInt(pase_dia.value, 10) || 0;
                var boletos2Dias = parseInt(pase_dosdias.value, 10) || 0;            
                var boletosCompleto = parseInt(pase_completo.value, 10) || 0;
    
                var diasElegidos = [];
    
                if(boletosDia > 0) {                
                    diasElegidos.push('viernes');
                }
    
                if(boletos2Dias > 0) {                
                    diasElegidos.push('viernes','sabado');
                }
    
                if(boletosCompleto > 0) {                
                    diasElegidos.push('viernes','sabado','domingo');
                }
    
                console.log(diasElegidos);
    
                for(var i = 0; i < diasElegidos.length; i++) {  
                    console.log(document.getElementById(diasElegidos[i]));
                    document.getElementById(diasElegidos[i]).style.display = 'block';
                } 
            }
        }
        
    });
})();

$(function() {
    $('.nombre-sitio').lettering();

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

    $('.invitado-info').colorbox({inline: true, width: "50%"});
});