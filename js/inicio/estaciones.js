$(document).ready(function()
{
$('.liest').click(function()
    {
        var id = $(this).attr('data-id');
        $('.liest').removeClass('selected');
        $(this).addClass('selected');
        $('.cont').addClass('none');
        $('[data-id="'+id+'"]').removeClass('none');
    });

});//Cierre de ready function