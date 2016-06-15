$(document).ready(function()
{
    $('a.delete img').click(function(evt)
    {
        evt.preventDefault();
        var href = $(this).parent().attr('href');
        var index1 = (href.lastIndexOf('/'))+1;
        var index2 = href.length;
        var id = href.substring(index1, index2);
        var miHtml = '';
        var header = $('.grid-view').attr('id');
        var mensaje = '¿Está seguro que desea eliminar está '+header;
        var nombre = $(this).parents('tr').eq(0).find('td').html();
        miHtml= '<div class="sub-content">\n\
                <div class="title-content">Eliminar '+header+'</div>\n\
                <div class="value-content">'+nombre+'</div>\n\
                <div class="separator-content"></div>\n\
                <div class="mensaje-content">'+mensaje+'</div>\n\
                <div class="botones-content">\n\
                    <div class="aceptar-boton">Aceptar</div>\n\
                    <div class="cancelar-boton">Cancelar</div>\n\
                </div>\n\
        </div>';
        $.colorbox(
        {
            html: miHtml,
            onComplete: function()
            {
                $('.cancelar-boton').click(function()
                {
                    $('#cboxClose').click();
                });
                $('.aceptar-boton').click(function()
                {
                    index1 = (href.indexOf('index.php/'))+10;
                    index2 = href.indexOf('/delete');
                    var controller = href.substring(index1, index2);
                    controller = controller.toLowerCase().replace(/\b[a-z]/g, function(letter) 
                    {
                        return letter.toUpperCase();
                    });
                    href = controller+'/delete';
                    console.log(href, id);
                    $.ajax(
                    {
                        type: 'GET',
                        url: href,
                        dataType: 'JSON', 
                        data:
                        {
                            id: id
                        },
                        success: function(data)
                        {
                            console.log(data);
                            $.fn.yiiGridView.update(header);
                            $('#cboxClose').click();
                        }
                    });
                });
            }
        });
    });
});