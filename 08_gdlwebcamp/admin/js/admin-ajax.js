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
            }
        });
    });
});