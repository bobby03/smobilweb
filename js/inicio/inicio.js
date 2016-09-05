$(document).ready(function(){

  var hijos  =  $('.principal.index').children('#no-viajes').length;
  // console.log(hijos);
  if(hijos > 0) {
    $('#content').addClass('vacio');
  }
  

	$('#viaje').on( 'click', function(){
		if(!$(this).hasClass('selected')){
			$('.container-viaje').toggleClass('none');
			$('.container-granja').toggleClass('none');
      $('.infocontacto').addClass('hide');
      $('.infocliente').addClass('hide');
      $('.ubicacion').addClass('hide');
			$('#viaje').toggleClass('selected');
			$('.progressbar').addClass('hide');
      $('#granja').toggleClass('selected');
      
		}

	});
    var h = 0;
    $('.divTr').each(function()
    {
        var h2 = $(this).height();
        if(h2 > h)
            h = h2;
    });
    $('.divTr').each(function()
    {
        var h2 = $(this).height();
        var height = 0;
        if(h2 < h)
        {
            height = ((h - h2)/2)+14;
        }
        else
            height = 14;
        $(this).css('padding',height+'px 0');
    });
//    $('.divTr2').each(function()
//    {
//        var h2 = $(this).height();
//        if(h2 > h)
//            h = h2;
//    });
//    $('.divTr2').each(function()
//    {
//        var h2 = $(this).height();
//        var height = 0;
//        if(h2 < h)
//        {
//            height = ((h - h2)/2)+14;
//        }
//        else
//            height = 14;
//        $(this).css('padding',height+'px 0');
//    });
	$('#granja').on('click',function(){
		if(!$(this).hasClass('selected')){
			$('.container-granja').toggleClass('none');
			$('.container-viaje').toggleClass('none');
			$('#granja').toggleClass('selected');
			$('#viaje').toggleClass('selected');
			
		}

	});

    $('div.divTable > div.divTbody > div.divTr').on('click', function () 
    {
        if(!$(this).hasClass('selected'))
        {
            $('div.divTable > div.divTbody > div.divTr').removeClass('selected');
            var id = $(this).data('id');
            cargaTanques(id);
            cargaUbicacion(id);
    
            $(this).addClass('selected');
        }
    });
    function cargaTanques(id) 
    {
        var url = window.location.href;
        var pos = url.lastIndexOf('php');
//    console.log('id: '+id);
        if (pos > 0) 
                url += '/site/DashboardTanques';
        else 
                url += 'index.php/site/DashboardTanques';
        $.ajax(
        {
            type: 'GET',
            url: url,
            dataType: 'JSON', 
            data: 
            {
                id: id
            },
            success: function(data) 
            {
                $('.contenedor-tanques').empty();
                $('.contenedor-tanques').append(data.html);
                $('.containerR1').empty();
                $('.containerR1').append(data.linea);
                var container  = $(".containerR1");
                container.children('.containerBoxR').last().find('.bubbleC').removeClass('bubbleC');
                container.children('.containerBoxR').last().find('.txtRuta').removeClass('txtRuta').addClass('txtR2');
                console.log(container.length);
            },
            error: function( a, b, c)
            {
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

