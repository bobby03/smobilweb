$(document).ready(function()
{
    var flag2 = true;
    var markers = [];
    var loc = window.location.href;
    var index2 = loc.lastIndexOf('/');
    var viaje = loc.substring(index2+1);
    var ubi;
    var myDir = {lat: 31.870803236698222, lng: -116.66807770729065};
    var mapDiv = $('#map')[0];
    var total = 1;
    var delay = 250;
    var map = new google.maps.Map(mapDiv, 
    {
        center: myDir,
        zoom: 15,
        disableDefaultUI: true,
        draggable: false,
        zoomControl: false,
        scrollwheel: false,
        disableDoubleClickZoom: true
    });
    graficarPorTanque();
    graficarPorParametro();
    $('[data-id="1"] .boton.adve').click(function()
    {
        // console.log('paramretro graph');
        var nombre = $(this).parent().siblings('.izquierda').children('div:first-child').text();
        var id = $(this).data('ale');
        /*
        $.ajax({
            type:'GET',
            url:'GetAlertaParametroModel',
            data:{
                viaje: viaje,
                id: id
            },
            success: function(data){
                $.colorbox({
                    html:data,
                    onComplete: function(){
                        // $.colorbox.resize();
                        $('#alertaGrid tbody tr td:last-child').each(function()
                        {
                            
                                var texto = $(this).text();
                                var div = $(this);
                                console.log(texto);
                                reverseGeocoding(texto, 2, div);
                            //    total++;
                            
                        });

                    }
                });
            },
            error:function(a,b,c){
                console.log(a,b,c);
            }

        }); 
        */
        // *
        $.ajax(
        {
            //GetAlertaParametroModel
            //GetAlertasTanque
            type: 'GET',
            url: 'GetAlertasTanque',
            dataType: 'JSON', 
            data:
            {
                viaje: viaje,
                id: id
            },
            success: function(data)
            {

                $.colorbox(
                {
                    html: data,
                    onComplete: function()
                    {
                        $.colorbox.resize();
                        $('.tituloAlerta').text('Alertas: '+nombre);
                        var total = 0;
                        $('.tableRow > div:nth-child(5n)').each(function()
                        {
                            if(total < 6)
                            {
                                var texto = $(this).text();
                                var div = $(this);
                                reverseGeocoding(texto, 2, div);
                                total++;
                            }
                        });
                        $('.tableRow > div').each(function()
                        {
                            var h = $(this).height();
                            var height = (50-h)/2;
                            $(this).css('padding',height+'px 0');
                        });                        
                    }
                });
            },
            error: function(a,b,c)
            {
                console.log(a, b, c);
            }
        }); // */
    });
    $('[data-id="2"] .boton.adve').click(function()
    {
        total = 1;
        delay = 250;
        var id = $(this).data('ale');
        $.ajax(
        {
        // Original :  GetAlertasParametro 
        //actionGetAlertaParametroModel
        // console.log("Entre Aquí");
            type: 'GET',
            url: 'GetAlertasParametro',
            dataType: 'JSON', 
            data:
            {
                viaje: viaje,
                id: id
            },
            success: function(data)
            {
                $.colorbox(
                {
                    html: data,
                    onComplete: function()
                    {
                        $.colorbox.resize();
                        $('.tableRow > div:nth-child(5n)').each(function()
                        {
                            if(total <= 5)
                            {
                                var texto = $(this).text();
                                var div = $(this);
//                                setTimeout(reverseGeocoding, delay, texto, 2, div);
                                reverseGeocoding(texto, 2, div);
                                delay = delay + 250;
                            }
                            else
                            {
                                $(this).parent().addClass('hide');
                            }
                            total ++;
                        });
                        $('.tableRow > div').each(function()
                        {
                            var h = $(this).height();
                            var height = (50-h)/2;
                            $(this).css('padding',height+'px 0');
                        });
                        
                    }
                });
            },
            error: function(a,b,c)
            {
                console.log(a, b, c);
            }
        });
    });
    $('[data-id="1"] .boton.graf').click(function()
    {
        var nombre = $(this).parent().siblings('.izquierda').children('div:first-child').text();
        var id = $(this).data('graf');
        $.ajax(
        {
            type: 'GET',
            url: 'GetHistorialTanque',
            dataType: 'JSON', 
            data:
            {
                viaje: viaje,
                id: id
            },
            success: function(data)
            {
                console.log(data);
                $.colorbox(
                {
                    html: data.codigo,
                    onComplete: function()
                    {
                        $('.historial .titulo').text('Historial '+nombre);
                        var ctx1 = $('#historialTanque1');
                        var myChart1 = new Chart(ctx1, data.ox);
                        var ctx2 = $('#historialTanque2');
                        var myChart2 = new Chart(ctx2, data.temp);
                        var ctx3 = $('#historialTanque3');
                        var myChart3 = new Chart(ctx3, data.ph);
                        var ctx4 = $('#historialTanque4');
                        var myChart4 = new Chart(ctx4, data.cond);
                        var ctx5 = $('#historialTanque5');
                        var myChart5 = new Chart(ctx5, data.orp);
                        $.colorbox.resize();
                        $('[data-para]').click(function()
                        {
                            var id = $(this).data('para');
                            $('[data-para]').removeClass('selected');
                            $(this).addClass('selected');
                            $('.grafScroll').addClass('hide');
                            $('.grafScroll[data-rece="'+id+'"]').removeClass('hide');
                        });
                    }
                });
            },
            error: function(a,b,c)
            {
                console.log(a, b, c);
            }
        });
    });
    $('[data-id="2"] .boton.graf').click(function()
    {
        var nombre = $(this).parent().siblings('.izquierda').children('div:first-child').text();
        var id = $(this).data('ale');
        $.ajax(
        {
            type: 'GET',
            url: 'GetHistorialParametro',
            dataType: 'JSON', 
            data:
            {
                viaje: viaje,
                id: id
            },
            success: function(data)
            {
                $.colorbox(
                {
                    html: data.codigo,
                    onComplete: function()
                    {
                        var ctx = $('#parametrosGrafica');
                        var myChart = new Chart(ctx, data.graficaTodos);
                        if(data.graf0 != '' && data.graf0 != null)
                        {
                            var ctx0 = $('#parametrosGrafica0');
                            var myChart0 = new Chart(ctx0, data.graf0);
                        }
                        if(data.graf1 != '' && data.graf1 != null)
                        {
                            var ctx1 = $('#parametrosGrafica1');
                            var myChart1 = new Chart(ctx1, data.graf1);
                        }
                        if(data.graf2 != '' && data.graf2 != null)
                        {
                            var ctx2 = $('#parametrosGrafica2');
                            var myChart2 = new Chart(ctx2, data.graf2);
                        }
                        if(data.graf3 != '' && data.graf3 != null)
                        {
                            var ctx3 = $('#parametrosGrafica3');
                            var myChart3 = new Chart(ctx3, data.graf3);
                        }
                        if(data.graf4 != '' && data.graf4 != null)
                        {
                            var ctx4 = $('#parametrosGrafica4');
                            var myChart4 = new Chart(ctx4, data.graf4);
                        }
                        if(data.graf5 != '' && data.graf5 != null)
                        {
                            var ctx5 = $('#parametrosGrafica5');
                            var myChart5 = new Chart(ctx5, data.graf5);
                        }
                        if(data.graf6 != '' && data.graf6 != null)
                        {
                            var ctx6 = $('#parametrosGrafica6');
                            var myChart6 = new Chart(ctx6, data.graf6);
                        }
                        if(data.graf7 != '' && data.graf7 != null)
                        {
                            var ctx7 = $('#parametrosGrafica7');
                            var myChart7 = new Chart(ctx7, data.graf7);
                        }
                        $('.menuSeccion').click(function()
                        {
                            var id = $(this).attr('data-tanque');
                            $('.menuSeccion').removeClass('selected');
                            $(this).addClass('selected');
                            $('[data-parame]').addClass('hide');
                            $('[data-parame="'+id+'"]').removeClass('hide');
                        });
                    }
                });
            },
            error: function(a,b,c)
            {
                console.log(a, b, c);
            }
        });
    });
    function graficarPorTanque()
    {
        $('.allTanques[data-id="1"] .tanque').each(function()
        {
            var id = $(this).find('.grafica').attr('data-tanque');
            var i = 1;
            $(this).find('.grafica div').each(function()
            {
                var flag = $(this).attr('data-num');

                $.ajax(
                {
                    type: 'GET',
                    url: 'GetTanqueGrafica',
                    dataType: 'JSON', 
                    data:
                    {
                        viaje: viaje,
                        id: id,
                        flag: flag,
                        flag2: flag2
                    },
                    success: function(data2)
                    {
                        var ctx = $('[data-tanque="'+id+'"] #graf'+i+'');
                        if(data2 != '' && data2 != null)
                            var myChart = new Chart(ctx, data2.grafica);
                        i ++;
                        if(flag2)
                        {
                            var tiempo = data2.tiempo;
                            var datos = data2.viaje;
                            ubi = datos.ubicacion;
                            var index = ubi.indexOf(',');
                            var lat = parseFloat(ubi.substring(1,index));
                            var index2 = ubi.length;
                            var lng = parseFloat(ubi.substring(index+2,index2-1));
                            ubi = {lat:lat, lng:lng};
                            var marker = new google.maps.Marker(
                            {        
                                position: ubi,
                                map: map
                            });
                            markers.push(marker);
                            map.setCenter(ubi);
                            $('.txtA.ultimo span').text(data2.ultimo);
//                            console.log(data2);
                            $('.datosWraper span.tiempo').text(tiempo);
                            $('.datosViaje .titulo span').text('Ultima actualización: '+datos.fecha+' '+datos.hora);
                            reverseGeocoding(datos.ubicacion, 1, false);
                            $('.datosWraper span.distancia').text(data2.distancia);
                            flag2 = false;
                        }
                    },
                    error: function(a,b,c)
                    {
                        console.log(a, b, c);
                    }
                }); 
            });
        });
    }
    $('h2 span').click(function()
    {
        if(!$(this).hasClass('selected'))
        {
            $('h2 span').removeClass('selected');
            $(this).addClass('selected');
            $('.allTanques').addClass('hide');
            var id = $(this).data('id');
            $('.allTanques[data-id="'+id+'"]').removeClass('hide');
        }
    });
    function graficarPorParametro()
    {
        $('.allTanques[data-id="2"] .tanque').each(function()
        {
            var cont = $(this).attr('data-para');
            $.ajax(
            {
                type: 'GET',
                url: 'GetParametroGrafica',
                dataType: 'JSON', 
                data:
                {
                    viaje: viaje,
                    flag: cont
                },
                success: function(data2)
                {
                    var ctx = $('canvas#grafP'+cont+'');
                    if(data2 != '' && data2 != null)
                        var myChart = new Chart(ctx, data2);
                },
                error: function(a,b,c)
                {
                    console.log(a, b, c);
                }
            }); 
        });
    }
    function reverseGeocoding(direccion, flag, div)
    {
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        var lng = direccion.length;
        var input = direccion.substring(1,lng-1);
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) 
        {
            if (status === google.maps.GeocoderStatus.OK) 
            {
                if (results[1]) 
                {
                    infowindow.setContent(results[1].formatted_address);
                    if(flag == 1)
                        $('.datosWraper > div:last-child span').text(infowindow.content);
                    if(flag == 2)
                        div.text(infowindow.content);
                } 
                else 
                    window.alert('No results found');
              
            } 
            else
            {
                reverseGeocoding(direccion, flag, div);
//                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }
    $('#map').click(function()
    {
        $.ajax(
        {
            type: 'GET',
            url: 'GetMapa',
            dataType: 'JSON', 
            data:
            {
                viaje: viaje
            },
            success: function(data)
            {
                $.colorbox(
                {
                    html:data,
                    onComplete: function()
                    {
                        var mapDiv2 = $('#mapa2')[0];
                        var map2 = new google.maps.Map(mapDiv2, 
                        {
                            center: ubi,
                            zoom: 15,
                            disableDefaultUI: true,
                            draggable: false,
                            zoomControl: false,
                            scrollwheel: false,
                            disableDoubleClickZoom: true
                        });
                        var marker = new google.maps.Marker(
                        {        
                            position: ubi,
                            map: map2
                        });
                    }
                });
                
            },
            error: function(a, b, c)
            {
                console.log(a, b, c);
            }
        });
    });
});