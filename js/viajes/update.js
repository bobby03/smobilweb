$(document).ready(function()
{
    var valores = [];
    var pedidos = [];
    var dataAjax;
    var url = window.location.href;
    var p = url.lastIndexOf('/');
    var index = url.lastIndexOf('index.php');
    url = url.substr(0, p);
    p = url.lastIndexOf('/');
    var new_url = url.substr(0, p);
    var totalTanque = 0;
    var idCamion = $('#Viajes_id_estacion').val();
    $('.bBoton').click(function(){ window.history.back();  });
    $('#SolicitudesViaje_id_personal_1_chofer').chosen({placeholder_text_multiple: 'Seleccionar'});
    $('#SolicitudesViaje_id_personal_1_tecnico').chosen({placeholder_text_multiple: 'Seleccionar'});
    $('#Viajes_id_solicitudes').chosen({placeholder_text_multiple: 'Seleccionar'});
    
    
    $('.fBoton.bUno').click(function(){
        console.log('Tab2 hide');
        $('[data-tab="2"]').addClass('hide');
        console.log('Tab1 show');
        $('[data-tab="1"]').removeClass('hide');
        $('.menuTabs div:nth-child(4)').removeClass('selected');
        $('.menuTabs div:nth-child(5)').removeClass('selected');

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
    if(index == -1) 
        new_url = new_url+'/index.php/';
    $('#Viajes_id_solicitudes').on('change', function()
    {
        totalTanque = 0;
        pedidos = [];
        var i;
        var sol = $(this).val();
        if(sol != null)
        {
            for(i = 0; i < sol.length;i++)
            {
                dataAjax = $.parseJSON($.ajax(
                {
                    type:'GET',
                    url: '../GetIdCliente',
                    dataType: 'JSON',
                    data: 
                    {
                        s: sol[i]
                    },
                    async: false
                }).responseText);
                for(var j = 0; j< dataAjax.length; j++)
                {
                    totalTanque = totalTanque + parseInt(dataAjax[j].tanques);
                    pedidos[pedidos.length] = dataAjax[j];
                }
            }
            var fecha = $('#Viajes_fecha_salida').val();
            $.ajax(
            {
                type: 'GET',
                url: '../GetCamionesDisponibles',
                dataType: 'JSON',
                data:
                {
                    total: totalTanque,
                    fecha: fecha,
                    idCamion: idCamion
                },
                success: function(data)
                {
                    $('#Viajes_id_estacion').empty();
                    $('#Viajes_id_estacion').append(data);
                },
                error: function(a,b,c)
                {
                }
            });
        }
    });
    $('.siguiente.uno').on('click', function()
    {
        var solicitud = $('#Viajes_id_solicitudes').val();
        var camion = $('#Viajes_id_estacion').val();
        var respuesta = {k:{}};
        $('.pedidosWraper').empty();
        for(var i =0; i < solicitud.length; i++)
            respuesta.k[i] = solicitud[i];
        respuesta = JSON.stringify(respuesta);
        $.ajax(
        {
            type:'GET',
            url: '../GetTanquesConSolicitud',
            dataType: 'JSON',
            data: 
            {
                solicitud: respuesta,
                camion: camion
            },
            success: function(data)
            {
                $('.pedidosWraper').append(data.html);
                validateChangesTanque();
            },
            error: function(a,b,c)
            {
                console.log(a,b,c);
            }
        });
        $('[data-tab="1"]').addClass('hide');
        $('[data-tab="2"]').removeClass('hide');
        $('.menuTabs div:nth-child(4)').addClass('selected');
        $('.menuTabs div:nth-child(5)').addClass('selected');
        $('.pedidoWraper').css('height', 'auto');
    });
    $('.siguiente.dos').on('click', function() 
    {
//        var solicitud = $('#Viajes_id_solicitudes').val();
        var total = 0;
        $('.pedido').each(function()
        {
            total++;
        });
        var fecha = $('#Viajes_fecha_salida').val();
        for(var i =0; i < total; i++)
        {
            var tanque = $('[name="Solicitudes[codigo]['+(i+1)+'][id_tanque]"').val();
            var seleccion = $('[name="Solicitudes[codigo]['+(i+1)+'][tanque]"').val();
            if(seleccion != '')
            {
                var solicit = seleccion.split(":");
                var pos = parseInt(solicit[1]);
                $.ajax(
                {
                    type:'GET',
                    url: '../GetResumenViaje',
                    dataType: 'JSON',
                    data: 
                    {
                        pedido: solicit[0],
                        tanque: tanque,
                        pos: pos
                    },
                    async: false,
                    success: function(dataAjax)
                    {
                        $('.inner-third-wrapper').append(dataAjax.html);
                        $('.fsalida').text(fecha);
                    }
                });
                $('[data-tab="2"]').addClass('hide');
                $('[data-tab="3"]').removeClass('hide');
                $('.menuTabs div:nth-child(6)').addClass('selected');
                $('.menuTabs div:nth-child(7)').addClass('selected');
                $('.menuTabs div:nth-child(8)').addClass('selected');
                $('.menuTabs div:nth-child(9)').addClass('selected');
            }
        }
    });

	function validateChangesTanque(){
		$('[data-tan]').on('change', function() {
            var num = $(this).val();
            var id = $(this).attr('id');
            var ide = $(this).attr('data-tan');
            if(num != 'Seleccionar') {
                var nuevo = valores[ide];
                $('[data-tan] option[value="'+nuevo+'"]').removeAttr('disabled');
                valores[ide] = num;
                $('[data-tan] option[value="'+num+'"]').attr('disabled','disabled');
                $('[id="'+id+'"] option[value="'+num+'"]').removeAttr('disabled');
            }
            else {
                var nuevo = valores[ide];
                $('[data-tan] option[value="'+nuevo+'"]').removeAttr('disabled');
                valores[ide] = '';
            }
        });
	}
});

