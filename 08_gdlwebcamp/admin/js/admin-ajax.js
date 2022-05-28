$(document).ready(function() {
    $('#crear-admin').on('submit', function(e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                var resultado = data; 
                if(resultado.respuesta == 'exito') {
                    swal(
                        'Correcto!',
                        'El administrador se creó correctamente!',
                        'success'
                    );
                }
            },
            error: function(error) {
                swal(
                    'Error!',
                    'Hubo un error al enviar su información!',
                    'error'
                );
            }
        });
    });

    $('#login-admin').on('submit', function(e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                var resultado = data; 
                console.log(resultado);
            },
            error: function(error) {
                swal(
                    'Error!',
                    'Hubo un error al enviar su información!',
                    'error'
                );
            }
        });
    });
});