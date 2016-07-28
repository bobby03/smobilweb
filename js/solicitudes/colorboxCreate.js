$(document).ready(function()
{
    $('.botonOtra').click(function()
    {
        var html = $('.domicilioForm').children().clone();
        $.colorbox(
        {
            html: html,
               width:'600px', 
                    height:'350px',
            onComplete: function()
            {
                googleMap();
                $('.aceptarDireccion').click(function()
                {
                    var id = $('#Solicitudes_id_clientes').val();
                    var domicilio = $('#colorbox #ClientesDomicilio_domicilio_1_domicilio').val();
                    var coordenadas = $('#colorbox #ClientesDomicilio_domicilio_1_ubicacion_mapa').val();
                    var descripcion = $('#colorbox #ClientesDomicilio_domicilio_1_descripcion').val();
                    if(domicilio != '' && coordenadas != '')
                    {
                        $.ajax(
                        {
                            type: 'GET',
                            url: 'AddDireccion',
                            dataType: 'JSON', 
                            data:
                            {
                                id: id,
                                dom: domicilio,
                                coord: coordenadas,
                                desc: descripcion
                            },
                            success: function(data)
                            {
                                if(data.boolean)
                                {
                                    $('#ClientesDomicilio_domicilio').append('<option value="'+data.id+'" selected>'+domicilio+'</option>');
                                    $('#ClientesDomicilio_domicilio').trigger("chosen:updated");
                                    $('.row.buttons').removeClass('hide');
                                    $.colorbox.close();
                                }
                                else
                                    console.log(data);
                            },
                            error: function(a, b, c)
                            {
                                console.log(a, b, c);
                            }
                        });
                    }
                });
                $('.cancelarDireccion').click(function()
                {
                    $.colorbox.close();
                });
            }
        });
    });
});