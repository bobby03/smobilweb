$(document).ready(function()
{
    var noMap;
    $('.allMapa').each(function()
    {
        noMap = $(this).attr('data-id');
        var ubi = $(this).find('.row.ubi').find('.data').text();
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
            zoom: 15,
            disableDefaultUI: true,
            draggable: false,
            zoomControl: false,
            scrollwheel: false,
            disableDoubleClickZoom: true
        });
        map.id = noMap;
        var marker = new google.maps.Marker({
            position: myDir,
            map: map,
            title: 'Hello World!'
        });
        markers.push(marker);
    });
});