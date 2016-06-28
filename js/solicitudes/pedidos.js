$(document).ready(function()
{
    var tot = 1;
    $('.agregar').click(function()
    {
        var especieID = $('#Especie_id').val();
        var especie = $('#Especie_id option:selected').text();
        var cepaID = $('#Cepa_id').val();
        var cepa = $('#Cepa_id option:selected').text();
        var cantidad = $('#Cepa_cantidad').val();
        var tanques = parseInt($('#tanquesNO').val());
        var tanque = '';
        if(tanques == 1)
            tanque = 'Tanque:';
        if(tanques > 1)
            tanque = 'Tanques:';
        var direccionID = $('#ClientesDomicilio_domicilio').val();
        var direccion = $('#ClientesDomicilio_domicilio option:selected').text();
        var html ='\n\
                    <div class="pedidoViaje">\n\
                        <div class="datosPedido">\n\
                            <input form="solicitudes-form" type="hidden" name="pedido['+tot+'][especie]" readonly value="'+especieID+'">\n\
                            <input form="solicitudes-form" type="hidden" name="pedido['+tot+'][cepa]" readonly value="'+cepaID+'">\n\
                            <input form="solicitudes-form" type="hidden" name="pedido['+tot+'][cantidad]" value="'+cantidad+'" readonly>\n\
                            <input form="solicitudes-form" type="hidden" name="pedido['+tot+'][destino]" readonly value="'+direccionID+'">\n\
                            <input form="solicitudes-form" type="hidden" name="pedido['+tot+'][tanques]" readonly value="'+tanques+'">\n\
                            <div class="pedidoInfo">'+especie+'</div>\n\
                            <div class="pedidoInfo">'+cepa+'</div>\n\
                            <div class="pedidoInfo">'+cantidad+'</div>\n\
                            <div class="pedidoInfo">'+tanque+' '+tanques+'</div>\n\
                            <div class="pedidoInfo">'+direccion+'</div>\n\
                        </div>\n\
                        <div class="botonesPedido">\n\
                            <div class="editarPedido" data-id="'+tot+'">E</div>\n\
                            <div class="borrarPedido">X</div>\n\
                        </div>\n\
                    </div>';
        $('.pedidosWraper').append(html);
        $('#Solicitudes_id_clientes').attr('disabled',true).trigger("chosen:updated");
        $('.pedidos').removeClass('hide');
        borrarPedido();
        editarPedido();
        tot++;
        $('.crearViaje').removeClass('hide');
    });
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
    function changeCepa(cepaID)
    {
        $('#Cepa_id').val(cepaID);
        $('#Cepa_id').trigger("change");
        $('#Cepa_id').trigger("chosen:updated");
    }
    function countPedidos()
    {
        var i = 0;
        $('.pedidoViaje').each(function()
        {
            i++;
        });
        if(i == 0)
            $('.crearViaje').addClass('hide');
    }
});