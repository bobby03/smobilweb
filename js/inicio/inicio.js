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


});  