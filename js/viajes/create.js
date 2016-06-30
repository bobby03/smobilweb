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
                            console.log(valores[ide]);
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
    checkInicio();
});