$(document).ready(function()
{
    var tot = 1;
    var loc = window.location.href;
    var index2 = loc.indexOf('update');
    var direccion = loc.substring(0,index2);
    if(!$('.pedidos').hasClass('hide'))
    {
        $('.pedidoViaje').each(function()
        {
            tot++;
        });
    }

    $('.agregar').click(function()
    {
        var especieID = $('#Especie_id').val();
        var especie = $('#Especie_id option:selected').text();
        var cepaID = $('#Cepa_id').val();
        var cepa = $('#Cepa_id option:selected').text();
        var cantidad = $('#Cepa_nombre_cepa_1_cantidad').val();
        var tanques = parseInt($('#tanquesNO').val());
        var tanque = '';

        //Validaciones campos

        var error=0;
        if (isNaN(cantidad)||cantidad==0||cantidad<0){
            
            $('#Cepa_nombre_cepa_1_cantidad').css('border-color', '#C00');
            document.getElementById('errorCan').innerHTML='Cantidad requerida';
            error=1;}
        else{
            $('#Cepa_nombre_cepa_1_cantidad').css('border-color', '#0077B0');
            document.getElementById('errorCan').innerHTML='';
            }
        if (isNaN(tanques)||tanques==0||tanques<0){
            
            $('#tanquesNO').css('border-color', '#C00');
            document.getElementById('errorTan').innerHTML='Cantidad requerida';
            error=1;}
        else{
            $('#tanquesNO').css('border-color', '#0077B0');
            document.getElementById('errorTan').innerHTML='';
            }

        //validaciones dropdown

        if(cepaID==""){
            
            error=1;
        }
        if(especieID==""){
            
            error=1;
        }
        if(error==1){
            
            return 0;
        }

        //Tanque

        if(tanques == 1)
            tanque = 'Tanque:';
        if(tanques > 1)
            tanque = 'Tanques:';
        var direccionID = $('#ClientesDomicilio_domicilio').val();
        var direccion = $('#ClientesDomicilio_domicilio option:selected').text();
        var html ='\n\
                    <div class="pedidoViaje" data-id="'+tot+'">\n\
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
                            <div class="editarPedido" data-id="'+tot+'"></div>\n\
                            <div class="borrarPedido"></div>\n\
                        </div>\n\
                    </div>';
        $('.pedidosWraper').append(html);

//        $('#Especie_id_chosen .chosen-single span').empty(); 
        $('#Especie_id').val('');
        $('#Especie_id').trigger("chosen:updated");
        $('#Cepa_id_chosen .chosen-single span').empty(); 
        $('#Cepa_nombre_cepa_1_cantidad').val(''); 
        $('#tanquesNO').val(''); 
        $('#ClientesDomicilio_domicilio').val(''); 
        $('#ClientesDomicilio_domicilio').trigger("chosen:updated");
//        $('#Solicitudes_notas').val(''); 
        
        $('#Solicitudes_id_clientes').attr('disabled',true).trigger("chosen:updated");
        $('.row.cepa').addClass('hide');
        $('.row.cantidad').addClass('hide');
        $('.row.direcciones').addClass('hide');
        $('.row.buttons').addClass('hide');
        $('.pedidos').removeClass('hide');
        borrarPedido();
        editarPedido();
        tot++;
        $('.botones').removeClass('hide');
        if(!$('.crearViaje').hasClass('hide'))
        {
            contarTanques();
        }
    });
    $('div.continuar').click(function()
    {
        $('div.crearViaje').removeClass('hide');
        contarTanques();
        $('.viajeSel').click(function()
        {
            var id = $(this).attr('data-viaje');
            $('#ClientesDomicilio_id_cliente').val(id);
            $('#Solicitudes_id_clientes').removeAttr('disabled');
            $('#Solicitudes_id_clientes').trigger('chosen:update');
            $('#solicitudes-form').submit();
        });
        $('.viajeLoc').click(function()
        {
            var id2 = $(this).data('viaje');
            var url = direccion+'GetDirecciones';
            $.ajax(
            {
                type: 'GET',
                url: url,
                dataType: 'JSON', 
                async: false,
                data:
                {
                    id: id2
                },
                success:function(data)
                {
                    $.colorbox(
                    {
                        html: data
                    });
                },
                error:function(a,b,c)
                {
                    console.log(a,b,c);
                }
            });
        });
    });

    $('div.guardar').click(function()
    {
        var baseUrl = window.location.href;
        $('form#solicitudes-form').attr('action',baseUrl);
        $('#Solicitudes_id_clientes').removeAttr('disabled');
        $('#Solicitudes_id_clientes').trigger('chosen:update');
//        console.log('hola');
        $('#solicitudes-form').submit();
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
            var especieID   = parseInt($('[name="pedido['+id+'][especie]"]').val());
            var cepaID      = parseInt($('[name="pedido['+id+'][cepa]"]').val());
            var cantidad    = parseInt($('[name="pedido['+id+'][cantidad]"]').val());
            var direccionID = parseInt($('[name="pedido['+id+'][destino]"]').val());
            var tanques     = parseInt($('[name="pedido['+id+'][tanques]"]').val());
            if($.isNumeric(especieID))
            {
                $('#Especie_id').val(especieID);
                $('#Especie_id').trigger("change");
                $('#Especie_id').trigger("chosen:updated");
                $('#Cepa_id').val(cepaID);
                $('#Cepa_id').trigger("change");
                $('#Cepa_id').trigger("chosen:updated");
                $('#Cepa_nombre_cepa_1_cantidad').val(cantidad);
                $('#Cepa_nombre_cepa_1_cantidad').trigger("change");
                $('#tanquesNO').val(tanques);
                $('#ClientesDomicilio_domicilio').val(direccionID);
                $('#ClientesDomicilio_domicilio').trigger("change");
                $('#ClientesDomicilio_domicilio').trigger("chosen:updated");
    //            $('.row.direcciones .row.buttons').removeClass('hide');
                $(this).closest('.pedidoViaje').remove();
            }
        });
    }
    function countPedidos()
    {
        var i = 0;
        $('.pedidoViaje').each(function()
        {
            i++;
        });
        if(i === 0)
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
        checkViajes();
    }
    function checkViajes()
    {
        var total = 0;
        var totalHide = 0;
        $('div.tablaViajes').children().each(function()
        {
            if($(this).hasClass('hide'))
                totalHide++;
            total++;
        });
        if(totalHide == total)
        {
            $('div.siViaje').addClass('hide');
            $('div.noViaje').removeClass('hide');
        }
        else
        {
            $('div.siViaje').removeClass('hide');
            $('div.noViaje').addClass('hide');
        }
    }
    $('#Solicitudes_id_clientes').change
    (
        function(){
           var sc = $('#Solicitudes_id_clientes').val();
            if (sc== "") {
                //If the "Please Select" option is selected display error.
                $('#Solicitudes_id_clientes_chosen').css('border-color', '#C00');
            }else{
                $('#Solicitudes_id_clientes_chosen').css('border-color', '#0077B0');
            }
        }
        );
    $('#Especie_id').change
    (
        function(){
           var eid = $('#Especie_id').val();
            if (eid== "") {
                //If the "Please Select" option is selected display error.
                $('#Especie_id_chosen').css('border-color', '#C00');
            }else{
                $('#Especie_id_chosen').css('border-color', '#0077B0');
            }
        }
        );
    $('#Cepa_id').change
    (
        function(){
           var cepaID = $('#Cepa_id').val();
            if (cepaID== "") {
                //If the "Please Select" option is selected display error.
                $('#Cepa_id_chosen').css('border-color', '#C00');
            }else{
                $('#Cepa_id_chosen').css('border-color', '#0077B0');
            }
        }
        );

    $('#ClientesDomicilio_domicilio').change
    (
        function(){
           var direccionID = $('#ClientesDomicilio_domicilio').val();
           console.log(direccionID);
            if (direccionID== "") {
                //If the "Please Select" option is selected display error.
                $('#ClientesDomicilio_domicilio_chosen').css('border-color', '#C00');
            }else{
                $('#ClientesDomicilio_domicilio_chosen').css('border-color', '#0077B0');
            }
        }
    );
});