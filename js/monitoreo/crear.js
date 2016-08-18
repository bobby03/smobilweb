$(document).ready(function(){
	var cepa;
	var especie;
	$('#Granjas_id').on('change', function(){
		var id = $(this).val();
		if(id == '') {
			$('#CampSensado_id_estacion').empty();
			$('#CampSensado_id_estacion').append('<option value="">Seleccionar</option>');
			$('#CampSensado_id_estacion').prop('disabled', 'disabled');
		}
		else {
			$.ajax({
				type: 'GET',
				url: 'GetEstacionesFromGranja',
				dataType: 'JSON',
				data: {
					id: id
				},
				success: function(data) {
					$('#CampSensado_id_estacion').empty();
					$('#CampSensado_id_estacion').append(data.html);
					$('#CampSensado_id_estacion').removeAttr("disabled")	;
				},
				error: function(a, b, c ) {
					console.log(a, b, c);
				}
			});

		}

	});
	$('.siguiente.uno').on('click', function() {
		var id = $('#CampSensado_id_estacion').val();
		if( id!= '') {
			$.ajax({
				type : 'GET',
				url  : 'GetTanquesFromEstacion',
				dataType : 'JSON',
				data: {
					id: id
				},
				success: function(data) {
					$('.pedidosWraper').empty();
					$('.pedidosWraper').html(data.libres);
					changeCepas();
				},
				error: function(a,b,c) {
					console.log(a,b,c);
				}


			});
		}
	});
    $('.siguiente.dos').on('click', function() {
        $('.pedido').each(function() {
        	var tanque   = $(this).find('.tituloEspecie').html();
        	var id_especie  = $(this).find('.css-select.especie').val();
        	var id_cepa     = $(this).find('.css-select.cepa').val();
        	var cantidad = $(this).find('.cant-peces').val();
        	var fecha_inicio = $('#CampSensado_fecha_inicio').val();
        	var hora_inicio = $('#CampSensado_hora_inicio').val();
        	var fecha_fin = $('#CampSensado_fecha_fin').val();
        	var hora_fin = $('#CampSensado_hora_fin').val();
        	InfoCepa(id_cepa);
			$.ajax({
				type: 'GET',
				url : 'GetNombreEspecie',
				dataType : 'JSON',
				data : {
					id: id_especie
				},
				success : function(data) {
					especie = data.nombre;
						$.ajax({
						type: 'GET',
						url : 'GetInfoCepa',
						dataType : 'JSON',
						data : {
							id: id_cepa
						},
						success : function(data) {
							var app = '<div class="boxCont">'+
					                    '<div id="contV3">'+
					                        '<div id="vt1">'+
					                        	'<div class="headerT">'+tanque+'</div>'+
					                        '</div>'+
					                        '<div id="vc1" class="vbox">'+
					                            '<div class="left">'+
							                        '<p><span class="vresalta">Fecha de inicio:</span> <span class="fsalida">'+fecha_inicio+' </span></p>'+
							                        '<p><span class="vresalta">hora de inicio:</span> <span class="fsalida"> '+hora_inicio+' </span></p>'+
							                    '</div>'+
							                    '<div class="right">'+
							                        '<p><span class="vresalta">Fecha de inicio:</span> <span class="fsalida">'+fecha_fin+' </span></p>'+
							                        '<p><span class="vresalta">hora de inicio:</span> <span class="fsalida"> '+hora_fin+' </span></p>'+
							                    '</div>'+
					                        '</div>'+
						                    '<div id="vc2">'+
						                        '<p><span class="vresalta">Especie:</span>'+especie+' </p>'+
						                        '<p><span class="vresalta">Cepa:</span>'+data.nombre+' </p>'+
						                        '<p><span class="vresalta">No. Organismos:</span> '+cantidad+'</p>'+
						                        '<table id="vcont">'+
						                            '<tbody><tr class="pf">'+
						                                '<th class="pc"></th><th>Mínima</th><th>Máxima</th>'+
						                            '</tr>'+
						                            '<tr>'+
						                                '<th class="pc">Temperatura (Temp)</th><th>'+data.temp_min+' °C</th><th>'+data.temp_max+' °C</th>'+
						                            '</tr>'+
						                            '<tr>'+
						                                '<th class="pc">PH (ph)</th><th>'+data.ph_min+'</th><th>'+data.ph_min+'</th>'+
						                            '</tr>'+
						                            '<tr>'+
						                                '<th class="pc">Oxígeno (O)</th><th> '+data.ox_min+' mg/l</th><th>'+data.ox_min+' mg/l </th>'+
						                            '</tr>'+
						                        '</tbody></table>'+
						                    '</div>'+
						                '</div>'+
						            '</div>';
        					$('.inner-third-wrapper').append( app );
						},
						error : function(a, b, c) {
							console.log(a, b, c);
						}
					});
				},
				error : function(a, b, c) {
					console.log(a, b, c);
				}
			});
        });
    });
	function changeCepas() {
		$('.css-select.especie').on('change', function() {
			var id = $(this).val();
			var selector_change = $(this).closest('.pedidoWraper').find('.css-select.cepa');
			if($(this).val()!="") { 
				$.ajax({
					type : 'GET',
					url  : 'GetCepasFromEspecie',
					dataType : 'JSON',
					data: {
						id: id
					},
					success: function(data) {
						selector_change.empty();
						selector_change.html(data.cepas);
					},
					error: function(a,b,c) {
						console.log(a,b,c);
					}
				});
				selector_change.removeAttr('disabled');
			}
			else{
				selector_change.empty();
				selector_change.html('<option>Seleccionar</option>');
				selector_change.prop('disabled', 'disabled');
			}
		});
	}
	function NombreEspecie(id) {
		$.ajax({
			type: 'GET',
			url : 'GetNombreEspecie',
			dataType : 'JSON',
			data : {
				id: id
			},
			success : function(data) {
				especie = data.nombre;
			},
			error : function(a, b, c) {
				console.log(a, b, c);
			}
		});
	}
	function InfoCepa(id) {
		$.ajax({
			type: 'GET',
			url : 'GetInfoCepa',
			dataType : 'JSON',
			data : {
				id: id
			},
			success : function(data) {
				cepa = data;
			},
			error : function(a, b, c) {
				console.log(a, b, c);
			}
		});
	}

});