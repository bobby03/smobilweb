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
                url: 'GetCliente',
                dataType: 'JSON', 
                data:
                {
                    id: id,
                    flag: 1
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
//                    console.log(a, b, c);
                    var url = direccion+'GetCliente';
                    $.ajax(
                    {
                        type: 'GET',
                        url: url,
                        dataType: 'JSON', 
                        data:
                        {
                            id: id,
                            flag: 1
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
                    $('.requerida input').val('');
                },
                error: function(a, b, c)
                {
                    var url = direccion+'GetCepas';
                    $.ajax(
                    {
                        type: 'GET',
                        url: url,
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
                            $('.requerida input').val('');
                        },
                        error: function(a, b, c)
                        {
                            console.log(a, b, c);
                        }
                    });
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
                $('#Cepa_nombre_cepa_1_cantidad').val(1);
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
});