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
});