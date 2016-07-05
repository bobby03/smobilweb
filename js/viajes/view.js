$(document).ready(function()
{
    var markers = [];
    var myDir = {lat: 31.870803236698222, lng: -116.66807770729065};
    var mapDiv = $('#map')[0];
    var map = new google.maps.Map(mapDiv, 
    {
        center: myDir,
        zoom: 15
    });
});