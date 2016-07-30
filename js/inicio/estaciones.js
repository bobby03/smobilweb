$(document).ready(function()
{
$('.liest').click(function()
    {
        var id = $(this).attr('data-id');
        $('.liest').removeClass('selected');
        $(this).addClass('selected');
        $('.cont').addClass('hide');
        $('.infocliente').addClass('hide');
        $('.infocontacto').addClass('hide');
        $('.ubicacion').addClass('hide');
        $('[data-id="'+id+'"]').removeClass('hide');
        
    });

});//Cierre de ready function