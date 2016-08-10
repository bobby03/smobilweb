$(document).ready(function()
{
    var noMap = parseInt(1);
    $('.addDireccion').click(function()
    {
        var nuevoMapa = $('.allMapa[data-id="1"]').clone();
        $('.row.mapa').append(nuevoMapa);
        noMap = parseInt(noMap) + 1;
        $('.row.mapa').children().last('allMapa').attr('data-id', noMap);
        $('.allMapa[data-id="'+noMap+'"]').children('#map').attr('data-map', noMap);
        $('.allMapa[data-id="'+noMap+'"]').children('#map').empty();
        $('.allMapa[data-id="'+noMap+'"]').children('.row.dom').find('input').attr('name','ClientesDomicilio[domicilio]['+noMap+'][domicilio]');
        $('.allMapa[data-id="'+noMap+'"]').children('.row.dom').find('input').attr('id','ClientesDomicilio_domicilio_'+noMap+'_domicilio');
        $('.allMapa[data-id="'+noMap+'"]').children('.row.dom').find('input').val('');
        $('.allMapa[data-id="'+noMap+'"]').children('.row.ubi').find('input').attr('name','ClientesDomicilio[domicilio]['+noMap+'][ubicacion_mapa]');
        $('.allMapa[data-id="'+noMap+'"]').children('.row.ubi').find('input').attr('id','ClientesDomicilio_domicilio_'+noMap+'_ubicacion_mapa');
        $('.allMapa[data-id="'+noMap+'"]').children('.row.ubi').find('input').val('');
        $('.allMapa[data-id="'+noMap+'"]').children('.row.des').find('input').attr('name','ClientesDomicilio[domicilio]['+noMap+'][descripcion]');
        $('.allMapa[data-id="'+noMap+'"]').children('.row.des').find('input').attr('id','ClientesDomicilio_domicilio_'+noMap+'_descripcion');
        $('.allMapa[data-id="'+noMap+'"]').children('.row.des').find('input').val('');
        initMap();
    });
    function initMap()
    {
        var markers = [];
        var myDir = {lat: 31.870803236698222, lng: -116.66807770729065};
        var mapDiv = $('[data-map="'+noMap+'"]')[0];
        var map = new google.maps.Map(mapDiv, 
        {
            center: {lat: 31.870803236698222, lng: -116.66807770729065},
            zoom: 15
        });
        map.id = noMap;
        var marker = new google.maps.Marker({
            position: myDir,
//                            map: map,
            title: 'Hello World!'
        });
        markers.push(marker);
        google.maps.event.addListener(map, 'click', function( event )
        {
//            console.log(map.id); 
            var marker = new google.maps.Marker(
            {        
                position: event.latLng,
                map: map,
                title: 'Hello World!'
            });
//            console.log(event.latLng);
            markers[0].setMap(null);
            markers = [];
            markers.push(marker);
            $('#ClientesDomicilio_domicilio_'+map.id+'_ubicacion_mapa').val(event.latLng);
            var div = $('#ClientesDomicilio_domicilio_'+map.id+'_domicilio');
            var direccion = $('#ClientesDomicilio_domicilio_'+map.id+'_ubicacion_mapa').val();
            reverseGeocoding(direccion,div);
        });
    }
    function runAllMaps()
    {
        $('.allMapa').each(function()
        {
            noMap = $(this).attr('data-id');
            var ubi = $(this).find('input#ClientesDomicilio_domicilio_'+noMap+'_ubicacion_mapa').val();
            if(ubi == '' || ubi == null)
                ubi = {lat: 31.870803236698222, lng: -116.66807770729065};
            else
            {
                var index = ubi.indexOf(',');
                var lat = parseFloat(ubi.substring(1,index));
                var index2 = ubi.length;
                var lng = parseFloat(ubi.substring(index+2,index2-1));
                ubi = {lat:lat, lng:lng};
            }
            var markers = [];
            var myDir = ubi;
            var mapDiv = $('[data-map="'+noMap+'"]')[0];
            var map = new google.maps.Map(mapDiv, 
            {
                center: ubi,
                zoom: 15
            });
            map.id = noMap;
            var marker = new google.maps.Marker({
                position: myDir,
                map: map,
                title: 'Hello World!'
            });
            markers.push(marker);
            google.maps.event.addListener(map, 'click', function( event )
            {
                var marker = new google.maps.Marker(
                {        
                    position: event.latLng,
                    map: map,
                    title: 'Hello World!'
                });
                markers[0].setMap(null);
                markers = [];
                markers.push(marker);
                $('#ClientesDomicilio_domicilio_'+map.id+'_ubicacion_mapa').val(event.latLng);
                var div = $('#ClientesDomicilio_domicilio_'+map.id+'_domicilio');
                var direccion = $('#ClientesDomicilio_domicilio_'+map.id+'_ubicacion_mapa').val();
                reverseGeocoding(direccion,div);
            });
        });
    }
    runAllMaps();
    function reverseGeocoding(direccion, div)
    {
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        var lng = direccion.length;
        var input = direccion.substring(1,lng-1);
        var latlngStr = input.split(',', 2);
        var lt = latlngStr[0].substring(0,10);
        var ln = latlngStr[1].substring(0,10);
        console.log("Lat: "+lt);
        console.log("Lng: "+ln);
        var latlng = {lat: parseFloat(lt), lng: parseFloat(ln)};
        geocoder.geocode({'location': latlng}, function(results, status) 
        {
            if (status === google.maps.GeocoderStatus.OK) 
            {
                if (results[1]) 
                {
                    infowindow.setContent(results[1].formatted_address);
                        $('.datosWraper > div:last-child span').text(infowindow.content);
                        div.val(infowindow.content);
                } 
                else 
                {
                    window.alert('No se encontraron resultados');
                    div.val('');
                }
              
            } 
            else
            {
//                reverseGeocoding(direccion, flag, div);
                window.alert('Falló la geolocalización debido a: ' + status);
            }
        });
    }
});