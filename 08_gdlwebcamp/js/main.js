(function () {
    "use strict";

    var regalo = document.getElementById('regalo');
    
    document.addEventListener('DOMContentLoaded', function() {
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
    });
})();