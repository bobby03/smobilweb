$(document).ready(function()
{
    function checkUpdate()
    {
        $('tr td:nth-child(2)').each(function()
        {
            var texto = $(this).text();
            var columna = $(this).siblings('.button-column');
            var index = texto.indexOf('proceso');
            if(index == -1)
            {
                columna.find('a.update').remove();
                columna.find('a.delete').remove();
            }
        });
    }
    checkUpdate();
    $('.aceptar-boton').click(function()
    {
        checkUpdate();
    });
});