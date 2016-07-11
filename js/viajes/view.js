$(document).ready(function()
{
    var flag2 = true;
    var markers = [];
    var loc = window.location.href;
    var index2 = loc.lastIndexOf('/');
    var viaje = loc.substring(index2+1);
    var myDir = {lat: 31.870803236698222, lng: -116.66807770729065};
    var mapDiv = $('#map')[0];
    var map = new google.maps.Map(mapDiv, 
    {
        center: myDir,
        zoom: 15,
        disableDefaultUI: true,
        draggable: false,
        zoomControl: false,
        scrollwheel: false,
        disableDoubleClickZoom: false
    });
    graficarPorTanque();
    graficarPorParametro();
    $('[data-id="1"] .boton.adve').click(function()
    {
        var nombre = $(this).parent().siblings('.izquierda').children('div:first-child').text();
        var id = $(this).data('ale');
        var html = '<div class="alertas">\n\
                        <div class="tituloAlerta">Alertas: '+nombre+'</div>\n\
                    </div>';
        $.ajax(
        {
            type: 'GET',
            url: 'GetTanqueGrafica',
            dataType: 'JSON', 
            data:
            {
                viaje: viaje,
                id: id
            },
            success: function(data2)
            {
                $.colorbox(
                {
                    html: html,
                    onComplete: function()
                    {

                    }
                });
            },
            error: function(a,b,c)
            {
                console.log(a, b, c)
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
                            var ubi = datos.ubicacion;
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
                            $('.datosWraper span.tiempo').text(tiempo);
                            $('.datosViaje .titulo span').text('Ultima actualización: '+datos.fecha+' '+datos.hora);
                            reverseGeocoding(datos.ubicacion);
                            $('.datosWraper span.distancia').text(data2.distancia);
                            flag2 = false;
                        }
                    },
                    error: function(a,b,c)
                    {
                        console.log(a, b, c)
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
    function reverseGeocoding(direccion)
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
                    $('.datosWraper > div:last-child span').text(infowindow.content);
                } 
                else 
                    window.alert('No results found');
              
            } 
            else 
                window.alert('Geocoder failed due to: ' + status);
        });
    }
});