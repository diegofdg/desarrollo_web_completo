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
        var resultado = document.getElementById('lista-productos');
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
                var boletoCompleto = parseInt(pase_completo.value, 10) || 0;
                var cantidadCamisas = parseInt(camisas.value, 10) || 0;
                var cantidadEtiquetas = parseInt(etiquetas.value, 10) || 0;

                var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletoCompleto * 50) + ((cantidadCamisas * 10) * 0.93) + (cantidadEtiquetas * 2);

                console.log("Total a pagar "+totalPagar);                
            }

        }
    });
})();