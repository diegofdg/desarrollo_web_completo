$(document).ready(function() {
    $('#guardar-registro').on('submit', function(e) {
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
                        'Se guardó correctamente!',
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

    $('.borrar_registro').on('click', function(e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');

        $.ajax({
            type: 'post',
            data: {
                'id': id,
                'registro': 'eliminar'

            },
            url: 'modelo-'+tipo+'.php',
            success: function(data) {
                console.log(data);
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
                console.log(data);
                
                var resultado = data;
                if(resultado.respuesta == 'exitoso') {
                    swal(
                        'Login Correcto!',
                        'Bienvenid@ '+resultado.usuario+' !!',
                        'success'
                    );
                    setTimeout(() => {
                        window.location.href = 'admin-area.php';
                    }, 2000);
                } else {
                    swal(
                        'Error!',
                        'Usuario o Password incorrectos!',
                        'error'
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
});