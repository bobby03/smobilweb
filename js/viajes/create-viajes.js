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
                    url: 'GetIdCliente',
                    dataType: 'JSON',
                    data: 
                    {
                        s: sol[i]
                    },
                    async: false
                }).responseText);
//                $.ajax(
//                {
//                    type:'GET',
//                    url: 'GetIdCliente',
//                    dataType: 'JSON',
//                    data: 
//                    {
//                        s: sol[i]
//                    },
//                    success: function(data) 
//                    {
//                        if(data != null)
//                        {
////                            for(var j = 0; j< data.length; j++)
////                            {
////                                totalTanque = totalTanque + parseInt(data[j].tanques);
////                                pedidos[pedidos.length] = data[j];
//                                dataAjax = data;
////                            }
//        //                    $('.hiden-input').val(data.html);
//        //                    $('.hiden-input-id').val(sol);
//        //                    $('.hiden-input-notas').val(data.nota);
//                        }
//                    },
//                    error: function(a,b,c) 
//                    {    
//                    }
//                });
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
                url: 'GetCamionesDisponibles',
                dataType: 'JSON',
                data:
                {
                    total: totalTanque,
                    fecha: fecha
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
        $('.pedidosWraper').empty();
        var contador;
        for(var i =0; i < solicitud.length; i++)
        {
            if(i == 0)
                contador = 1;
            else
                contador = dataAjax.total;
            var id = solicitud[i];
            dataAjax = $.parseJSON($.ajax(
            {
                type:'GET',
                url: 'GetTanquesConSolicitud',
                dataType: 'JSON',
                data: 
                {
                    solicitud: id,
                    camion: camion,
                    i: contador
                },
                async: false
            }).responseText);
            $('.pedidosWraper').append(dataAjax.html);
            validateChangesTanque();
        }
    });
    $('.siguiente.dos').on('click', function() 
    {
        var solicitud = $('#Viajes_id_solicitudes').val();
//        var camion = $('#Viajes_id_estacion').val();
        var fecha = $('#Viajes_fecha_salida').val();
//        $('.inner-third-wrapper').empty();
        for(var i =0; i < solicitud.length; i++)
        {
            var id = solicitud[i];
            $.ajax(
            {
                type:'GET',
                url: 'GetResumenViaje',
                dataType: 'JSON',
                data: 
                {
                    solicitud: id,
//                    camion: camion,
                    tanque: valores[i+1]
//                    fecha: fecha
                },
                async: false,
                success: function(dataAjax)
                {
                    $('.inner-third-wrapper').append(dataAjax.html);
                    $('.fsalida').text(fecha);
                }
            });
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