$(document).ready(function()
{
    $('#Cepa_id').chosen();
    $('#Solicitudes_id_clientes').chosen();
    $('#Especie_id').chosen();
    $('#ClientesDomicilio_domicilio').chosen();
    var flag = true;
    $('#Solicitudes_id_clientes').on('change', function()
    {
        var id = $(this).val();
        if(id != '' && id != null)
        {
            $.ajax(
            {
                type: 'GET',
                url: 'GetCliente',
                dataType: 'JSON', 
                data:
                {
                    id: id
                },
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
                error: function(a, b, c)
                {
                    console.log(a, b, c);
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
                url: 'GetCepas',
                dataType: 'JSON', 
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
                },
                error: function(a, b, c)
                {
                    console.log(a, b, c);
                }
            });
        }
        else
        {
            $('.row.cepa').addClass('hide');
            $('.row.cantidad').addClass('hide');
            $('.row.direcciones').addClass('hide');
        }
    });
    $('#Cepa_id').on('change', function()
    {
        var cant = $('#Cepa_id option:selected').attr('data-cnt');
        $('.disponible input').val(cant);
        $('.requerida input').attr('max',cant);
        $('.requerida input').val(1);
        $('.row.cantidad').removeClass('hide');
        $('.row.direcciones').removeClass('hide');
    });
    $('#ClientesDomicilio_domicilio').on('change', function()
    {
        var id = $('#ClientesDomicilio_domicilio').val();
        if(id != '' && id!= null)
            $('.row.buttons').removeClass('hide');
        else
            $('.row.buttons').addClass('hide');
    });
});