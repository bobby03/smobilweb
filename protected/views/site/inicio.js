$(document).ready(function(){

	$('#viajes').on( 'click', function(){
		if(!$(this).hasClass('selected')){
			$('.contaier-viaje').toggleClass('none');
			$('.contaier-granja').toggleClass('none');
		}

	});
});  