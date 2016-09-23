
$(document).ready(function()
{
    var valores = [];
    $('.bBoton').click(function(){ window.history.back();  });
    $('.fBoton.bUno').click(function(){
        console.log('Tab2 hide');
        $('[data-tab="2"]').addClass('hide');
        console.log('Tab1 show');
        $('[data-tab="1"]').removeClass('hide');
        $('.menuTabs div:nth-child(4)').removeClass('selected');
        $('.menuTabs div:nth-child(5)').removeClass('selected');

    });
    $('.fBoton.bDos').click(function(){
        console.log('Tab2 hide');
        
        console.log('Tab1 show');

    });
    $('div.bDos.fBoton.floatingbutton').click(function(){
        $('[data-tab="3"]').addClass('hide');
        console.log('Tab1 show');
        $('[data-tab="2"]').removeClass('hide');
        // $('.menuTabs div:nth-child(4)').removeClass('selected');
        // $('.menuTabs div:nth-child(5)').removeClass('selected');
        $('.menuTabs div:nth-child(6)').removeClass('selected');
        $('.menuTabs div:nth-child(7)').removeClass('selected');
        $('.menuTabs div:nth-child(8)').removeClass('selected');
        $('.menuTabs div:nth-child(9)').removeClass('selected');

    });


    $('#SolicitudesViaje_id_personal_1_chofer').chosen({placeholder_text_multiple: 'Seleccionar'});
    $('#SolicitudesViaje_id_personal_1_tecnico').chosen({placeholder_text_multiple: 'Seleccionar'});
    $('#Viajes_id_solicitudes').chosen({placeholder_text_multiple: 'Seleccionar'});
    
    
    $("#Viajes_id_responsable").on('change', function(){
        if($(this).val() == '' || $(this).val()=='Seleccionar'){
            $(this).addClass('error');
        }
        else {
            $(this).removeClass('error');
        }
    });
    
//    $("#Viajes_id_estacion").on('change', function(){
//        if($(this).val() == '' || $(this).val()=='Seleccionar'){
//            $(this).addClass('error');
//        }
//        else {
//            $(this).removeClass('error');
//        }
//    });
    $('#Viajes_id_estacion').on('click', function()
    {
        var id = $(this).val();
        if(id != '' && id != null)
        {
            $.ajax(
            {
                type: 'GET',
                url: 'GetTanques',
                dataType: 'JSON', 
                data:
                {
                    id: id
                },
                success: function(data)
                {
                    $('.selectTanque').removeClass('hide');
                    $('[data-tan] option').remove();
                    $('[data-tan]').append('<option>Seleccionar</option>');
                    $('[data-tan]').append(data);
                    $('.tanqueNombre').each(function()
                    {
                        var id = $(this).attr('data-tanque');
                        console.log(id);
                        $('div.pedido select option[value="'+id+'"]').remove();
                    });
                    $('[data-tan]').on('change', function()
                    {
                        var num = $(this).val();
                        var id = $(this).attr('id');
                        var ide = $(this).attr('data-tan');
                        if(num != 'Seleccionar')
                        {
                            var nuevo = valores[ide];
                            $('[data-tan] option[value="'+nuevo+'"]').removeAttr('disabled');
                            valores[ide] = num;
                            $('[data-tan] option[value="'+num+'"]').attr('disabled','disabled');
                            $('[id="'+id+'"] option[value="'+num+'"]').removeAttr('disabled');
                        }
                        else
                        {
                            var nuevo = valores[ide];
                            $('[data-tan] option[value="'+nuevo+'"]').removeAttr('disabled');
                            valores[ide] = '';
                        }
                    });
                },
                error: function(a, b, c)
                {
                    console.log(a, b, c);
                }
            });
        }
        else
        {
            $('.selectTanque').addClass('hide');
        }
    });
    function checkInicio()
    {
        var id = $('#Viajes_id_estacion');
        if(id != '' && id != null)
        {
            $('#Viajes_id_estacion').trigger('change');
        }
    }
    function ntanque(a)
    {
        console.log(a);
        var b = $('.ttan'+a+' option:selected').text();
        $(".ntan"+a).html(' '+b);
    }
    $('.siguiente.uno').click(function() 
    {
        $('#Viajes_fecha_salida').blur();
        $('#Viajes_hora_salida').blur();
        $('#Viajes_id_responsable').blur();
     //   $('#Viajes_id_estacion').blur();

        if($('#Viajes_hora_salida').val()==''){
             $('#Viajes_hora_salida').addClass("error");
        }
        if($('#Viajes_fecha_salida').val()==''){
             $('#Viajes_fecha_salida').addClass("error");
        }else{
            $('#Viajes_fecha_salida').removeClass("error");
        }
        if($('#Viajes_id_responsable').val() == '') {
            $('#Viajes_id_responsable').addClass("error");
        }
        else {
            $('#Viajes_id_responsable').removeClass("error");
        }
        if($('#Viajes_id_estacion').val() == '') {
            $('#Viajes_id_estacion').addClass("error");
        }
        else {
            $('#Viajes_id_estacion').removeClass("error");
        }
        $('[data-tab="1"] select[multiple="multiple"]').each(function() {
            if ($("option:selected", this).text() === "" || $("option:selected", this).text() === "Seleccionar") {
                $(this).next('div.chosen-container').addClass("error");
                $(this).closest('div').find('.errorMessage').show().html('Debe Seleccionar una persona');
                $(this).next('div.chosen-container').removeClass("success");
            } else {
                $(this).closest('div').find('.errorMessage').hide().html('');
                $(this).next('div.chosen-container').addClass("success");
                $(this).next('div.chosen-container').removeClass("error");
            }
        });

        var err = $('div').find('.error');

        if (err.length > 0) {
            return 0;
        } 
        else 
        {
            if (formSendViajes()) 
            {
                $('[data-tab="1"]').addClass('hide');
                $('[data-tab="2"]').removeClass('hide');
                $('.menuTabs div:nth-child(4)').addClass('selected');
                $('.menuTabs div:nth-child(5)').addClass('selected');
                $('.pedidoWraper').css('height', 'auto');
            } 
            else 
                return 0;
        }
    });


    $('.siguiente.dos').click(function() 
    {
    //    var a=(numElem = $('.ttan').size());
    //    for (var i = 0; i<a; i++) { 
    //        console.log('pasdao a'+i);
    //        ntanque(i+1);
    //    }
        $('.fsalida').html($('#Viajes_fecha_salida').val());

//        if (formSendViajesTanque()) 
//        {
            $('[data-tab="2"]').addClass('hide');
            $('[data-tab="3"]').removeClass('hide');
            $('.menuTabs div:nth-child(6)').addClass('selected');
            $('.menuTabs div:nth-child(7)').addClass('selected');
            $('.menuTabs div:nth-child(8)').addClass('selected');
            $('.menuTabs div:nth-child(9)').addClass('selected');

//        }
    });
    checkInicio();
    var h = 0;
    $('.pedidoWraper').each(function() {
        var h2 = $(this).height();
        if (h2 > h) {
            h = h2;
        }
    });
    $('.pedidoWraper').css('height', h + 14);
    });

    function formSendViajes(e) {


        if ($("#Viajes_id_responsable option:selected").text() === "Seleccionar" || $("#Viajes_id_estacion option:selected").text() === "Seleccionar") {
            return 0;
        } else {
            return 1;
        }
    }





    function formSendViajesTanque(e) {


        $('[data-tab="2"] select').each(function() {
            if ($("option:selected", this).text() === "Seleccionar") {
                $(this).parent().addClass("error");
                $(this).parent().removeClass("success");
            } else {
                $(this).parent().addClass("success");
                $(this).parent().removeClass("error");
            }
        });




        var re = /Seleccionar/gi;
        var str = $('.pedidosWraper').find('select option:selected').text();

        if (str.search(re) == -1) {
            return 1;
        } else {
            return 0;
        }


    }



function validaTanques() {
    $(".selectTanque select").change(function() {

        if ($("option:selected", this).text() === "Seleccionar") {
            $(this).parent().addClass("error");
            $(this).parent().removeClass("success");
        } else {
            $(this).parent().addClass("success");
            $(this).parent().removeClass("error");
        }

    });
}


function validaTabUno() {
    $('#SolicitudesViaje_id_personal_1_tecnico_chosen').bind('DOMSubtreeModified', function(event) {
        $('[data-tab="1"] select[multiple="multiple"]').each(function() {
            if ($("option:selected", this).text() === "" || $("option:selected", this).text() === "Seleccionar") {
                $(this).next('#SolicitudesViaje_id_personal_1_tecnico_chosen').addClass("error");
                $(this).closest('#SolicitudesViaje_id_personal_1_tecnico_chosen').find('.errorMessage').show().html('Debe Seleccionar una persona');
                $(this).next('#SolicitudesViaje_id_personal_1_tecnico_chosen').removeClass("success");
            } else {
                $(this).closest('#SolicitudesViaje_id_personal_1_tecnico_chosen').find('.errorMessage').hide().html('');
                $(this).next('#SolicitudesViaje_id_personal_1_tecnico_chosen').addClass("success");
                $(this).next('#SolicitudesViaje_id_personal_1_tecnico_chosen').removeClass("error");
            }
        });
    });
    $('#SolicitudesViaje_id_personal_1_chofer_chosen').bind('DOMSubtreeModified', function(event) {
        $('[data-tab="1"] select[multiple="multiple"]').each(function() {
            if ($("option:selected", this).text() === "" || $("option:selected", this).text() === "Seleccionar") {
                $(this).next('#SolicitudesViaje_id_personal_1_chofer_chosen').addClass("error");
                $(this).closest('#SolicitudesViaje_id_personal_1_chofer_chosen').find('.errorMessage').show().html('Debe Seleccionar una persona');
                $(this).next('#SolicitudesViaje_id_personal_1_chofer_chosen').removeClass("success");
            } else {
                $(this).closest('#SolicitudesViaje_id_personal_1_chofer_chosen').find('.errorMessage').hide().html('');
                $(this).next('#SolicitudesViaje_id_personal_1_chofer_chosen').addClass("success");
                $(this).next('#SolicitudesViaje_id_personal_1_chofer_chosen').removeClass("error");
            }
        });
    });
    $('#Viajes_id_solicitudes_chosen').bind('DOMSubtreeModified', function(event) {
        $('[data-tab="1"] select[multiple="multiple"]').each(function() {
            if ($("option:selected", this).text() === "" || $("option:selected", this).text() === "Seleccionar") {
                $(this).next('#Viajes_id_solicitudes_chosen').addClass("error");
                $(this).closest('#Viajes_id_solicitudes_chosen').find('.errorMessage').show().html('Debe Seleccionar una persona');
                $(this).next('#Viajes_id_solicitudes_chosen').removeClass("success");
            } else {
                $(this).closest('#Viajes_id_solicitudes_chosen').find('.errorMessage').hide().html('');
                $(this).next('#Viajes_id_solicitudes_chosen').addClass("success");
                $(this).next('#Viajes_id_solicitudes_chosen').removeClass("error");
            }
        });
    });
    $('#Viajes_hora_salida').change(function() {
        hora=$(this).val();
        if(hora.length==2){
            $(this).val(hora+':00');
        }
        hora=$(this).val();
        if(hora.length!=5){
                $(this).addClass("error");
                $(this).find('.errorMessage').show().html('Debe Seleccionar una persona');
                $(this).removeClass("success");   
        }else{
            $(this).removeClass("error");
            $(this).find('.errorMessage').hide().html('');
            $(this).addClass("success");
        }
        
    });
    /*$('div.chosen-container').bind('DOMSubtreeModified', function(event) {
        $('[data-tab="1"] select[multiple="multiple"]').each(function() {
            if ($("option:selected", this).text() === "" || $("option:selected", this).text() === "Seleccionar") {
                $(this).next('div.chosen-container').addClass("error");
                $(this).closest('div').find('.errorMessage').show().html('Debe Seleccionar una persona');
                $(this).next('div.chosen-container').removeClass("success");
            } else {
                $(this).closest('div').find('.errorMessage').hide().html('');
                $(this).next('div.chosen-container').addClass("success");
                $(this).next('div.chosen-container').removeClass("error");
            }
        });
    });*/

}

function launcher() {
    validaTanques();
    validaTabUno();
}



window.onload = launcher;
