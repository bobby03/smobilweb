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
    $('.siguiente.uno').click(function()
    {
        $('[data-tab="1"]').addClass('hide');
        $('[data-tab="2"]').removeClass('hide');
        $('.menuTabs div:nth-child(4)').addClass('selected');
        $('.menuTabs div:nth-child(5)').addClass('selected');
        $('.pedidoWraper').css('height', 'auto');
    });
    $('.siguiente.dos').click(function()
    {
        $('[data-tab="2"]').addClass('hide');
        $('[data-tab="3"]').removeClass('hide');
        $('.menuTabs div:nth-child(6)').addClass('selected');
        $('.menuTabs div:nth-child(7)').addClass('selected');
        $('.menuTabs div:nth-child(8)').addClass('selected');
        $('.menuTabs div:nth-child(9)').addClass('selected');
    });
    checkInicio();
    var h = 0;
    $('.pedidoWraper').each(function()
    {
        var h2 = $(this).height();
        if(h2 > h)
        {
            h = h2;
        }
    });
    $('.pedidoWraper').css('height',h+14);
});