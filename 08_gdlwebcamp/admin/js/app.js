$(document).ready(function () {
    $('.sidebar-menu').tree();
    
    $('#registros').DataTable({
        'paging'      : true,
        'pageLength'  : 10,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'language'    : {
            paginate: {
                next: 'Siguiente',
                previous: 'Anterior',
                last: 'Último',
                first: 'Primero'
            },
            info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
            emptyTable: 'No hay registros',
            inforEmpty: '0 registros',
            search: 'Buscar: '
      }
    });

    $('#crear_registro_admin').attr('disabled', true);

    $('#repetir_password').on('input', function() {
        var password_nuevo = $('#password').val();
        
        if( $(this).val() == password_nuevo ) {
            $('#resultado_password').text('Correcto');
            $('#resultado_password').parents('.form-group').addClass('has-success').removeClass('has-error');
            $('input#password').parents('.form-group').addClass('has-success').removeClass('has-error');
            $('#crear_registro_admin').attr('disabled', false);
        } else {
            $('#resultado_password').text('Los Passwords no son iguales');
            $('#resultado_password').parents('.form-group').addClass('has-error').removeClass('has-success');
            $('input#password').parents('.form-group').addClass('has-error').removeClass('has-success');
            $('#crear_registro_admin').attr('disabled', true);
        }
    });

    $('#fecha').datepicker({
        autoclose: true
    });
    
    $('.seleccionar').select2({
        width: '100%'
    });

    $('.hora').timepicker({
        showInputs: false,
        defaultTime: '10',
    });

    $('#icono').iconpicker();
    
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass   : 'iradio_flat-blue'
    });

    if(document.getElementById('grafica-registros')){
        $.getJSON('servicio-registrados.php', function(data) {
            var line = new Morris.Line({
                element: 'grafica-registros',
                resize: true,
                data: data,
                xkey: 'fecha',
                ykeys: ['cantidad'],
                labels: ['Item 1'],
                lineColors: ['#3c8dbc'],
                hideHover: 'auto'
            });
        });
    }
});