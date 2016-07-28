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

	$('.dashboardInicio > tbody > tr').on('click', function () {
		//alert($(this).data('id'));
	   if(!$(this).hasClass('selected')){
			$('.dashboardInicio > tbody > tr').removeClass('selected');
			var id = $(this).data('id');
			cargaTanques(id);
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
	        	if(data.result == 1) {
	        		$('.contenedor-tanques').empty();
	        		$('.contenedor-tanques').append(data.html);
	        		
	        	}
	        	else {
	        		
	        	}
	        },
	        error: function( a, b, c)  {
	        	console.log(a, b, c);
	        }
	    });
	 }
 	var content = $('.dashboardInicio > tbody > tr:first-child');
	content.trigger('click');
	var flag = false;
	$('.circle').hover(function()
	{ 
		flag = false;
		if($(this).closest('.containerBoxR').children('.ctxtr').is(':hidden'))
		{ 
			flag = true;
			$(this).closest('.containerBoxR').children('.ctxtr').show();	
		}
	},
	function()
	{
		if(flag)
			$(this).closest('.containerBoxR').children('.ctxtr').hide();	
	});
});  