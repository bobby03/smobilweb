
$(document).ready(function()
{
    var valores = [];
    $('#SolicitudesViaje_id_personal_1_chofer').chosen({placeholder_text_multiple: 'Seleccionar'});
    $('#SolicitudesViaje_id_personal_1_tecnico').chosen({placeholder_text_multiple: 'Seleccionar'});
    $('#Viajes_id_estacion').on('change', function()
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

$('.siguiente.uno').click(function() {

    $('#Viajes_fecha_salida').blur();
    $('#Viajes_hora_salida').blur();
    $('#Viajes_id_responsable').blur();
 //   $('#Viajes_id_estacion').blur();

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

    } else {
        if (formSendViajes()) {
            $('[data-tab="1"]').addClass('hide');
            $('[data-tab="2"]').removeClass('hide');
            $('.menuTabs div:nth-child(4)').addClass('selected');
            $('.menuTabs div:nth-child(5)').addClass('selected');
            $('.pedidoWraper').css('height', 'auto');
        } else {
            return 0;

        }

    }


});


$('.siguiente.dos').click(function() {
    $('.fsalida').html($('#Viajes_fecha_salida').val());
    
    if (formSendViajesTanque()) {
        $('[data-tab="2"]').addClass('hide');
        $('[data-tab="3"]').removeClass('hide');
        $('.menuTabs div:nth-child(6)').addClass('selected');
        $('.menuTabs div:nth-child(7)').addClass('selected');
        $('.menuTabs div:nth-child(8)').addClass('selected');
        $('.menuTabs div:nth-child(9)').addClass('selected');

    } else {}

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

    $('div.chosen-container').bind('DOMSubtreeModified', function(event) {
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
    });
}

function launcher() {
    validaTanques();
    validaTabUno();
}

window.onload = launcher;
