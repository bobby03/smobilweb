$(document).ready(function() {
	var valores = [];
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

		$.ajax({
			type:'GET',
            url: 'GetTanquesConSolicitud',
            dataType: 'JSON',
            data: {
            	solicitud: solicitud,
            	camion: camion
            },
            success: function(data) {
            	$('.pedidosWraper').empty();
            	$('.pedidosWraper').append(data.html);
            	validateChangesTanque();
            },
            error: function(a,b,c) {	
                console.log(a, b, c);
            }
		});

	});
	function validateChangesTanque(){
		$('[data-tan]').on('change', function() {
            var num = $(this).val();
            var id = $(this).attr('id');
            var ide = $(this).attr('data-tan');
            if(num != 'Seleccionar') {
             console.log(valores);
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