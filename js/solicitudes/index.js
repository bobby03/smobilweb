$(document).ready(function()
{
	var urlSplit = window.location.href;

      var id=urlSplit.split('#');
      var val=id[ id.length - 1 ];

    $('.tab').click(function()
    {
        //Seccion Default
        Cookies.set('tabse', 'sinAsignar');

        var id = $(this).attr('data-id');
        var idtab = $(this).attr('id');
        Cookies.set('tabse', idtab);
        $('.tab').removeClass('select');
        $(this).addClass('select');
        $('.tabContent').addClass('hide');
        $('[data-tan="'+id+'"]').removeClass('hide');
        console.log(Cookies.get('tabse'));
    });


//    if(val=='asignadas'){
//    	$('#asignadas').click();
//    }
//
//    if(val=='sinAsignar'){
//      $('#sinAsignar').click();
//    }
//
//    if(val=='enRuta'){
//      $('#enRuta').click();
//    }
//
//    if(val=='finalizado'){
//      $('#finalizado').click();
//    }
    var url = window.location.href;
    var pos = url.lastIndexOf('asignadas');
    
    if(pos > -1) {
        $('#asignadas').trigger('click');
    }
    
});