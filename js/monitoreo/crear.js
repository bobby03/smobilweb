$(document).ready(function(){
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
public function changeCepas() {
	$('.css-select.especie').on('change', function() {
		if($(this).val()!=""){ 
			$(this).closest('.pedidoWraper').find('.css-select.cepa').removeAttr('disabled');
		}
	});
}
	// $('.css-select.especie').on('change', function() {
	// 	$(this).closest('.pedidoWraper').find('.css-select.cepa').removeAttr('disabled');
	// });

	$('.siguiente.dos').on('click', function() {

	});

});