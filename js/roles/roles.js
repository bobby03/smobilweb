$(document).ready(function()
{ 
    checkBox();
    $('div.botonTodos').click(function()
    {
        if($(this).hasClass('clicked'))
        {
            $(this).removeClass('clicked');
            $(this).text('Marcar');
            $(this).parent().siblings('div').children('[type="checkbox"]').prop('checked', false);
        }
        else
        {
            $(this).addClass('clicked');
            $(this).text('Desmarcar');
            $(this).parent().siblings('div').children('[type="checkbox"]').prop('checked', true);
        }
    });
    $('[type="checkbox"]').click(function()
    {
        var total = 0;
        if($(this).is(':checked'))
            total++;
        $(this).parent().siblings('div').children('[type="checkbox"]').each(function()
        {
            if($(this).is(':checked'))
                total++;
        });
        if(total == 0)
        {
            $(this).parent().siblings('div').children('div.botonTodos').removeClass('clicked');
            $(this).parent().siblings('div').children('div.botonTodos').text('Marcar'); 
        }
        if(total == 4)
        {
            $(this).parent().siblings('div').children('div.botonTodos').addClass('clicked');
            $(this).parent().siblings('div').children('div.botonTodos').text('Desmarcar'); 
        }
    });
    function checkBox()
    {
        $('div.separador').each(function()
        {
            var total = 0;
            var cont = 0;
            $(this).find('[type="checkbox"]').each(function()
            {
                if($(this).is(':checked'))
                total++;
                cont++;
                if(cont == 4)
                {
                    if(total == 0)
                    {
                        $(this).parent().siblings('div').children('div.botonTodos').removeClass('clicked');
                        $(this).parent().siblings('div').children('div.botonTodos').text('Marcar'); 
                    }
                    if(total == 4)
                    {
                        $(this).parent().siblings('div').children('div.botonTodos').addClass('clicked');
                        $(this).parent().siblings('div').children('div.botonTodos').text('Desmarcar'); 
                    }
                }
            });
        });
    }
    $('div#rol tr:first-child td.button-column a.update').remove();
    $('div#rol tr:first-child td.button-column a.delete').remove();
    $('div#rol tr:nth-child(2) td.button-column a.update').remove();
    $('div#rol tr:nth-child(2) td.button-column a.delete').remove();
    $('div#rol tr:nth-child(3) td.button-column a.update').remove();
    $('div#rol tr:nth-child(3) td.button-column a.delete').remove();
});
