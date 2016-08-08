$(document).ready(function() {
	var url = window.location.href;
	var p = url.lastIndexOf('/');
	var index = url.lastIndexOf('index.php');
	url = url.substr(0, p);
	p = url.lastIndexOf('/');
	var new_url = url.substr(0, p);
	if(index == -1) {
		new_url = new_url+'/index.php/'

	}
	console.log(new_url);
	
	$('.siguiente.uno').on('click', function(){
		var solicitud = $('#Viajes_id_solicitudes').val();
		var camion = $('#Viajes_id_estacion').val();
		console.log('camion: '+camion);
		console.log('solicitud: '+solicitud);

		$.ajax({
			type:'POST',
            url: 'GetTanquesConSolicitud',
            dataType: 'json',
            data: {
            	solicitud: solicitud,
            	camion: camion
            },
            succes: function(data) {
            	console.log(data);
            },
            error:function(a,b,c) {	
                console.log(a, b, c);
            }
		});

	});
});