$(document).ready(function(){

	$('#viaje').on( 'click', function(){
		if(!$(this).hasClass('selected')){
			$('.container-viaje').toggleClass('none');
			$('.container-granja').toggleClass('none');

			$('#viaje').toggleClass('selected');
			$('#granja').toggleClass('selected');

		}

	});

	$('#granja').on('click',function(){
		if(!$(this).hasClass('selected')){
			$('.container-granja').toggleClass('none');
			$('.container-viaje').toggleClass('none');
		
			$('#granja').toggleClass('selected');
			$('#viaje').toggleClass('selected');
			
		}

	});

 	$('div.divTable > div.divTbody > div.divTr').on('click', function () {
  		//alert($(this).data('id'));
  	   if(!$(this).hasClass('selected')){
  	   	$('div.divTable > div.divTbody > div.divTr').removeClass('selected');
  			var id = $(this).data('id');
 
  			cargaTanques(id);
 			cargaUbicacion(id);
  		   $(this).addClass('selected');
  		}
  	});

		function cargaTanques(id) {
 		var url = window.location.href;
 		var pos = url.lastIndexOf('php');
 		if (pos > 0) {
 			url += '/site/DashboardTanques';
 		}
 		else {
 			url += 'index.php/site/DashboardTanques';
 		}
 	 	$.ajax({
 	        type: 'GET',
 	        url: url,
 	        dataType: 'JSON', 
 	        data: {
  	            id: id,
  	        },
  	        success: function(data) {
  	        	$('.contenedor-tanques').empty();
        		$('.contenedor-tanques').append(data.html);
  	        },
  	        error: function( a, b, c){
  	        	console.log(a, b, c);
  	        }
  	    });
  	 }
	function cargaUbicacion(id) {
 		var url = window.location.href;
 		var pos = url.lastIndexOf('php');
 		if (pos > 0) {
 			url += '/site/Prueba';
 		}
 		else {
 			url += 'index.php/site/Prueba';
 		}
	 	$.ajax({
 	        type: 'GET',
 	        url: url,
 	        dataType: 'JSON', 
 	        data: {
 	            id: id,
 	        },
 	        success: function(data) {
         		$('.separador1').empty();
         		$('.separador1').append(data.html);
 	        },
 	        error: function( a, b, c)  {
 	        	console.log(a, b, c);
 	        }
 	    });
 	 }
 
  	var content = $('.divTable > .divTbody > .divTr:first-child');
  	content.trigger('click');
  });

