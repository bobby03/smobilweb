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
    });
}