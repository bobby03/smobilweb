$(document).ready(function()
{

    
    $('.tab').click(function()
    {
        var id = $(this).attr('data-id');
        $('.tab').removeClass('select');
        $(this).addClass('select');
        $('.tabContent').addClass('hide');
        $('[data-tan="'+id+'"]').removeClass('hide');
    });
    $('.items tbody tr').each(function()
    {
        $(this).find('a.delete').remove();
    });
});