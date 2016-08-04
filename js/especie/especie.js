$(document).ready(function()
{
    $('div.agregar.especie').click(function(evt)
    {
        evt.preventDefault();
        miHtml= '<div class="sub-content">\n\
                <div class="title-content">Agregar especie '+'</div>\n\
                <div class="esp">Especie</div>\n\
                <div class="separator-content"></div>\n\
                <input id="ingesp" class="ingesp" type="text">\n\
                <div class="botones-content">\n\
                    <div class="btnadd">Agregar</div>\n\
                </div>\n\
        </div>';
        $.colorbox(
        {
            html: miHtml,
            width:'400px', 
            height:'200px',
            onComplete: function()
            {
                
                $('.btnadd').click(function()
                {
                    var especie = document.getElementById('ingesp').value;
                    $.ajax(
                    {
                        type: 'POST',
                        url: '/especie/Create1',
                        dataType: 'JSON', 
                        data:
                        {
                            especie: especie
                        },
                        success: function(data)
                        {
                            $('#cboxClose').click();
                             window.location = "especie";
                        },
                        error: function(a, b, c)
                        {
                            
                        }
                    });
                });
            }
        });
    });

    $('a.update img').click(function(evt)
    {
        evt.preventDefault();
        var href = $(this).parent().attr('href');
        var index1 = (href.lastIndexOf('/'))+1;
        var index2 = href.length;
        var id = href.substring(index1, index2);
        var miHtml = '';
        var nombre = $(this).parents('tr').eq(0).find('td').html();
        console.log(nombre);
        miHtml= '<div class="sub-content">\n\
                <div class="title-content">Editar especie '+'</div>\n\
                <div class="esp">Especie</div>\n\
                <div class="separator-content"></div>\n\
                <input id="ingesp" value="'+nombre+'" class="ingesp" type="text">\n\
                <div class="botones-content">\n\
                    <div class="btnadd">Agregar</div>\n\
                </div>\n\
        </div>';
        $.colorbox(
        {
            html: miHtml,
            width:'400px', 
            height:'200px',
            onComplete: function()
            {
                
                $('.btnadd').click(function()
                {
                    var especie = document.getElementById('ingesp').value;

                    $.ajax(
                    {
                        type: 'POST',
                        url: '/especie/Update1',
                        dataType: 'JSON', 
                        data:
                        {
                            id:id,
                            especie: especie
                        },
                        success: function(data)
                        {
                            $('#cboxClose').click();
                             window.location = "especie";
                        },
                        error: function(a, b, c)
                        {
                            
                        }
                    });
                });
            }
        });
    });
    $('.items tbody tr').each(function()
    {       
        $(this).find('a.view').remove();
    });
});