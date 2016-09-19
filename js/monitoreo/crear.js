$(document).ready(function()
{
    var url = window.location.href;
    var index = url.lastIndexOf('update');
    var cepa;
    var especie;
    var n = window.location.href.lastIndexOf('update');
    var isupdate = 0;
    if (n >=0) {
        isupdate = 1;
    }
    $('#Granjas_id').on('change', function(){
        var id = $(this).val();
        if(id == '') {
                $('#CampSensado_id_estacion').empty();
                $('#CampSensado_id_estacion').append('<option value="">Seleccionar</option>');
                $('#CampSensado_id_estacion').prop('disabled', 'disabled');
        }
        else {
            var url="getEstacionesFromGranja";
            if(isupdate!=0){
                url = "../getEstacionesFromGranja";
            }
            $.ajax({
                type: 'GET',
                url: url,
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
    $('.gBoton.regresar.uno').on('click', function() {
        $('.tab[data-tab="2"]').addClass('hide');
        $('.tab[data-tab="1"]').removeClass('hide');
        $('.menuTabs div:nth-child(4)').removeClass('selected');
        $('.menuTabs div:nth-child(5)').removeClass('selected');
    });
	$('.siguiente.uno').on('click', function() {
		var id = $('#CampSensado_id_estacion').val();
                var fecha_inicio = $('#CampSensado_fecha_inicio').val();
                var fecha_final = $('#CampSensado_fecha_fin').val();
		if( id!== '') {
                    var url="GetTanquesFromEstacion";
                    var idSiembra = 0;
                    if(isupdate!=0){
                        url = "../GetTanquesFromEstacion";
                        idSiembra = $('#CampSensado_id').val();
                    }
                    if(isupdate == 0)
                    {
			$.ajax({
				type : 'GET',
				url  : url,
				dataType : 'JSON',
				data: {
					id: id,
                                        update: isupdate,
                                        fecha_inicial: fecha_inicio,
                                        fecha_final: fecha_final,
                                        id_siembra: idSiembra
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
		}
	});
    $('.gBoton.regresar.dos').on('click', function() {
        $('.tab[data-tab="3"]').addClass('hide');
        $('.tab[data-tab="2"]').removeClass('hide');
        $('.menuTabs div:nth-child(6)').removeClass('selected');
        $('.menuTabs div:nth-child(7)').removeClass('selected');
    });
    $('.siguiente.dos').on('click', function() {
        $('.inner-third-wrapper').empty();
        $('.pedido').each(function() {
        	var tanque   = $(this).find('.tituloEspecie').html();
        	var id_especie  = $(this).find('.css-select.especie').val();
        	var id_cepa     = $(this).find('.css-select.cepa').val();
        	var cantidad = $(this).find('.cant-peces').val();
        	var fecha_inicio = $('#CampSensado_fecha_inicio').val();
        	var hora_inicio = $('#CampSensado_hora_inicio').val();
        	var fecha_fin = $('#CampSensado_fecha_fin').val();
        	var hora_fin = $('#CampSensado_hora_fin').val();
                if(id_especie != "Seleccionar") {
                    var url="GetNombreEspecie";
                    if(isupdate!=0){
                        url = "../GetNombreEspecie";
                    }
			$.ajax({
				type: 'GET',
				url : url,
				dataType : 'JSON',
				data : {
					id: id_especie,
                                        update: isupdate
				},
				success : function(data) {
					especie = data.nombre;
                                            var url2="GetInfoCepa";
                                            if(isupdate!=0){
                                                url2 = "../GetInfoCepa";
                                            }
						$.ajax({
						type: 'GET',
						url : url2,
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
							                        '<p><span class="vresalta">Fecha de inicio: </span> <span class="fsalida">'+fecha_inicio+' </span></p>'+
							                        '<p><span class="vresalta">Hora de inicio: </span> <span class="fsalida"> '+hora_inicio+' </span></p>'+
							                    '</div>'+
							                    '<div class="right">'+
							                        '<p><span class="vresalta">Fecha de inicio: </span> <span class="fsalida">'+fecha_fin+' </span></p>'+
							                        '<p><span class="vresalta">Hora de inicio: </span> <span class="fsalida"> '+hora_fin+' </span></p>'+
							                    '</div>'+
					                        '</div>'+
						                    '<div id="vc2">'+
						                        '<p><span class="vresalta">Especie: </span>'+especie+' </p>'+
						                        '<p><span class="vresalta">Cepa: </span>'+data.nombre+' </p>'+
						                        '<p><span class="vresalta">No. Organismos: </span> '+cantidad+'</p>'+
						                        '<table id="vcont">'+
						                            '<tbody><tr class="pf">'+
						                                '<th class="pc"></th><th>Mínima</th><th>Máxima</th>'+
						                            '</tr>'+
						                            '<tr>'+
						                                '<th class="pc">Temperatura </th><th>'+data.temp_min+' °C</th><th>'+data.temp_max+' °C</th>'+
						                            '</tr>'+
						                            '<tr>'+
						                                '<th class="pc">PH </th><th>'+data.ph_min+'</th><th>'+data.ph_max+'</th>'+
						                            '</tr>'+
						                            '<tr>'+
						                                '<th class="pc">Oxígeno </th><th> '+data.ox_min+' mg/l</th><th>'+data.ox_max+' mg/l </th>'+
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
                }
        });
    });
	function changeCepas() {
		$('.css-select.especie').on('change', function() {
			var id = $(this).val();
			var selector_change = $(this).closest('.pedidoWraper').find('.css-select.cepa');
			if($(this).val()!="") { 
                            var url="GetCepasFromEspecie";
                            if(isupdate!=0){
                                url = "../GetCepasFromEspecie";
                            }
				$.ajax({
					type : 'GET',
					url  : url,
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
    changeCepas();
});