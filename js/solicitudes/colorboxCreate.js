$(document).ready(function()
{
    var loc = window.location.href;
    var index3 = loc.length;
    var index2 = loc.indexOf('update');
    var direccion = loc.substring(0,index2);
    console.log(direccion);
    // var id = loc.substring(index2+7,index3);
    $('.botonOtra').click(function()
    {
        var html = $('.domicilioForm').children().clone();
        $.colorbox(
        {
            html: html,
            width:'600px', 
            height:'525px',
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
                        console.log('URL: '+direccion);
                        if( index2 != -1){
                            var dir = direccion+'AddDireccion';
                        }else{
                            var dir = 'AddDireccion';
                        }
                        console.log('Dir: '+dir);
                        $.ajax(
                        {
                            type: 'GET',
                            url: dir , //'AddDireccion',
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

                                // console.log(a, b, c);
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