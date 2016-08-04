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
                ;
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

    
    $('.items tbody tr').each(function()
    {       
        $(this).find('a.view').remove();
    });
});