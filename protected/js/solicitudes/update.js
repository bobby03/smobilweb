$(document).ready(function()
{
    var loc = window.location.href;
    var index3 = loc.length;
    var index2 = loc.indexOf('update');
    var direccion = loc.substring(0,index2);
    var url = direccion+'GetCliente';
    var id = loc.substring(index2+7,index3);
    $.ajax(
    {
        type: 'GET',
        url: url,
        dataType: 'JSON', 
        data:
        {
            id: id,
            flag: 2
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
            var id = $('#Solicitudes_id_clientes option[selected="selected"]').attr('value');
            $('#Solicitudes_id_clientes').val(id);
            $('#Solicitudes_id_clientes').attr('disabled',true).trigger("chosen:updated");
            $('.botones').removeClass('hide');
            $('.crearViaje').removeClass('hide');
            $('.viajeSel').click(function()
            {
                var id = $(this).attr('data-viaje');
                $('#ClientesDomicilio_id_cliente').val(id);
                $('#Solicitudes_id_clientes').removeAttr('disabled').trigger("chosen:updated");
                $('#solicitudes-form').submit();
            });
            countPedidos();
            borrarPedido();
            editarPedido();
        },
        error: function(a, b, c)
        {
            console.log(a, b, c);
        }
    });
    function countPedidos()
    {
        var i = 0;
        $('.pedidoViaje').each(function()
        {
            i++;
        });
        if(i == 0)
        {
            $('.crearViaje').addClass('hide');
            $('.pedidos').addClass('hide');
            $('#Solicitudes_id_clientes').removeAttr('disabled').trigger("chosen:updated");
        }
        else
            contarTanques();
    }
    function contarTanques()
    {
        var tanques = 0;
        $('.pedidoViaje').each(function()
        {
            var id = $(this).attr('data-id');
            tanques = tanques + parseInt($(this).find('input[name="pedido['+id+'][tanques]"]').val());
        });
        $('.renglon').each(function()
        {
            var total = $(this).find('[data-tanque]').attr('data-tanque');
            if(total < tanques)
                $(this).addClass('hide');
            else
                $(this).removeClass('hide');
        });
    }
    function borrarPedido()
    {
        $('.borrarPedido').click(function()
        {
            $(this).closest('.pedidoViaje').remove();
            countPedidos();
        });
    }
    function editarPedido()
    {
        $('.editarPedido').click(function()
        {
            var id          = $(this).attr('data-id');
            var especieID   = parseInt($('[name="especiePedido'+id+'"]').val());
            var cepaID      = parseInt($('[name="cepaPedido'+id+'"]').val());
            var cantidad    = parseInt($('[name="cantidadPedido'+id+'"]').val());
            var direccionID = parseInt($('[name="destinoPedido'+id+'"]').val());
            $('#Especie_id').val(especieID);
            $('#Especie_id').trigger("change");
            $('#Especie_id').trigger("chosen:updated");
            $('#requerida input').val(cantidad);
            $('#ClientesDomicilio_domicilio').val(direccionID);
            $('#ClientesDomicilio_domicilio').trigger("chosen:updated");
//            $(this).closest('.pedido').remove();
            changeCepa(cepaID);
        });
    }
//    $('.row.pedido').removeClass('hide');
//    $('.titulo').removeClass('hide');
});