$(document).ready(function()
{
    $('#Cepa_id').chosen();
    $('#Solicitudes_id_clientes').chosen();
    $('#Especie_id').chosen();
    $('#ClientesDomicilio_domicilio').chosen();
    var flag = true;
    var loc = window.location.href;
    var index2 = loc.indexOf('update');
    var direccion = loc.substring(0,index2);
    $('#Solicitudes_id_clientes').val('');
    $('#Solicitudes_id_clientes').on('change', function()
    {
        var id = $(this).val();
        if(id != '' && id != null)
        {
            $.ajax(
            {
                type: 'GET',
                url: direccion+'GetCliente',
                dataType: 'JSON', 
                data:
                {
                    id: id,
                    flag: 1
                },
                async: false,
                success: function(data)
                {
                    $('.datosCliente').empty();
                    $('.datosCliente').append(data.cliente);
                    $('#ClientesDomicilio_domicilio option:gt(0)').remove();
                    $('#ClientesDomicilio_domicilio').append(data.domicilio);
                    $('#ClientesDomicilio_domicilio').trigger("chosen:updated");
                    $('.row.pedido').removeClass('hide');
                    $('.titulo').removeClass('hide');
                },
                error: function()
                {
                    
                }
            });
        }
        else
        {
            if(flag)
            {
                $('.datosCliente').empty();
                $('.row.pedido').addClass('hide');
                $('.titulo').addClass('hide');
            }
        }
    });
    $('#Especie_id').on('change', function()
    {
        var id = $(this).val();
        if(id != '' && id != null)
        {
            $.ajax(
            {
                type: 'GET',
                url: direccion+'GetCepas',
                dataType: 'JSON', 
                async: false,
                data:
                {
                    id: id
                },
                success: function(data)
                {
                    $('#Cepa_id option:gt(0)').remove();
                    $('#Cepa_id').append(data);
                    $('#Cepa_id').trigger("chosen:updated");
                    $('.row.cepa').removeClass('hide');
                    $('.requerida input').val('');
                },
                error: function()
                {
                    
                }
            });
        }
        else
        {
            $('.row.cepa').addClass('hide');
            $('.row.cantidad').addClass('hide');
            $('.requerida input').val('');
            $('.row.direcciones').addClass('hide');
        }
    });
    $('#Cepa_id').on('change', function()
    {
        $('.requerida input').val('');
        $('.row.cantidad').removeClass('hide');
        $('.requerida input').change(function()
        {
           validacionCantidad();
        });
        $('.requerida input').keyup(function()
        {
           validacionCantidad();
        });
    });
    $('#ClientesDomicilio_domicilio').on('change', function()
    {
        var id = $('#ClientesDomicilio_domicilio').val();
        if(id != '' && id!= null)
            $('.row.buttons').removeClass('hide');
        else
            $('.row.buttons').addClass('hide');
    });
    function validacionCantidad()
    {
        var cantidad = $('#Cepa_nombre_cepa_1_cantidad').val();
        if(cantidad != '' && cantidad != null)
        {
            if(cantidad < 0)
                //$('#Cepa_nombre_cepa_1_cantidad').val(1);
            $('.row.direcciones').removeClass('hide');
        }
        else
            $('.row.direcciones').addClass('hide');
    }
    $('[name="yt0"]').click(function()
    {
        $('#Solicitudes_id_clientes').removeAttr('disabled');
        $('#Solicitudes_id_clientes').trigger('chosen:update');
    });
    /* Validación Números tanques */
    $('#tanquesNO').on('change', function()
    {
        $('.row.cantidad').removeClass('hide');
        $('.noTanques input').change(function()
        {
           validacionCantidadTanques();
        });
        $('.noTanques input').keyup(function()
        {
           validacionCantidadTanques();
        });
    });
    function validacionCantidadTanques()
    {
        var cantidad = $('#tanquesNO').val();
        if(cantidad != '' && cantidad != null)
        {
            if(cantidad < 0){
                //$('#tanquesNO').val(1);
            }
            $('.row.direcciones').removeClass('hide');
        }
        else
            $('.row.direcciones').addClass('hide');
    }
    /* ----- */
});