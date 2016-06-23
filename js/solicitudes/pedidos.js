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
        var direccionID = $('#ClientesDomicilio_domicilio').val();
        var direccion = $('#ClientesDomicilio_domicilio option:selected').text();
        var html ='\n\
                    <div class="pedido">\n\
                        <div class="datosPedido">\n\
                            <input type="hidden" name="especiePedido'+tot+'" readonly value="'+especieID+'">\n\
                            <input type="hidden" name="cepaPedido'+tot+'" readonly value="'+cepaID+'">\n\
                            <input type="hidden" name="cantidadPedido" value="'+cantidad+'" readonly>\n\
                            <input type="hidden" name="destinoPedido'+tot+'" readonly value="'+direccionID+'">\n\
                            <div class="pedidoInfo">'+especie+'</div>\n\
                            <div class="pedidoInfo">'+cepa+'</div>\n\
                            <div class="pedidoInfo">'+cantidad+'</div>\n\
                            <div class="pedidoInfo">'+direccion+'</div>\n\
                        </div>\n\
                        <div class="botonesPedido">\n\
                            <div class="editarPedido">E</div>\n\
                            <div class="borrarPedido">X</div>\n\
                        </div>\n\
                    </div>';
        $('.pedidosWraper').append(html);
        $('#Solicitudes_id_clientes').attr('disabled',true).trigger("chosen:updated");
        $('.pedidos').removeClass('hide');
    });
});