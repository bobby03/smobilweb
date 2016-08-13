function googleMap()
{
    var markers = [];
    var myDir = {lat: 31.870803236698222, lng: -116.66807770729065};
    var mapDiv = $('#colorbox #map')[0];
    var map = new google.maps.Map(mapDiv, 
    {
        center: myDir,
        zoom: 15
    });
    var marker = new google.maps.Marker({
        position: myDir,
//        map: map,
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
        $('#colorbox #ClientesDomicilio_domicilio_1_ubicacion_mapa').val(event.latLng);
        var div = $('#colorbox #ClientesDomicilio_domicilio_1_domicilio');
        var direccion = $('#colorbox #ClientesDomicilio_domicilio_1_ubicacion_mapa').val();
        reverseGeocoding(direccion,div);
    });
}
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