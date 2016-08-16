$(document).ready(function()
{

    $('div.agregar.especie').click(function(evt)
    {
        evt.preventDefault();
        var href = window.location.href;
        var miHtml= '\
            <div class="sub-content">\n\
                <div class="title-content">Agregar especie</div>\n\
                <div class="esp">Especie</div>\n\
                <div class="separator-content"></div>\n\
                <input id="ingesp" class="ingesp" type="text">\n\
                <div class="botones-content">\n\
                    <a class="gBoton" href="">Cancelar</a> \n\
                    <div class="btnadd gBoton">Agregar</div>\n\
                </div>\n\
                <script>UpperCaseInput();</script>\n\
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


                    if(validField()){
                    var especie = $('#ingesp').val();
                    $.ajax(
                    {
                        type: 'POST',
                        url: href+'/Create1',
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
                }
                });
            }
        });
    });

    $('a.update img').click(function(evt)
    {
        evt.preventDefault();
        var href = window.location.href;
        var hrefId = $(this).parent().attr('href');
//        var index1 = (hrefId.lastIndexOf('/'));
//        var index2 = hrefId.length;
        var urlSplit = hrefId.split( '/' );
        var id = urlSplit[ urlSplit.length - 1 ]; 
        var miHtml = '';
        var nombre = $(this).parents('tr').eq(0).find('td').html();
      //  console.log(nombre);
        miHtml= '\
            <div class="sub-content">\n\
                <div class="title-content">Editar especie '+'</div>\n\
                <div class="esp">Especie</div>\n\
                <div class="separator-content"></div>\n\
                <input name="ingesp" id="ingesp" value="'+nombre+'" class="ingesp" type="text">\n\
                <div class="botones-content">\n\
                    <a class="gBoton" href="">Cancelar</a> \n\
                    <div class="btnadd btnUpdate">Aceptar</div>\n\
                </div>\n\
                <script>UpperCaseInput();</script>\n\
            </div>';
        $.colorbox(
        {
            html: miHtml,
            width:'400px', 
            height:'200px',
            onComplete: function()
            {        
            

                $('.btnUpdate').click(function()
                {
       
        if(validField()){
                    var val = $('#ingesp').val();
                    $('#ingesp').val(val);
                    var especie = $('#ingesp').val();
                    $.ajax(
                    {
                        type: 'POST',
                        url: href+'/Update1',
                        dataType: 'JSON', 
                        data:
                        {
                            id:id,
                            especie: especie
                        },
                        success: function(dataR)
                        {
                           parent.$.colorbox.close();
                           window.location = "especie";
                        },
                        error: function(a, b, c)
                        {
                            
                        }
                    });
}
                   



                });
            }
        });
    });
    $('.items tbody tr').each(function()
    {       
        $(this).find('a.view').remove();
    });

});

function UpperCaseInput(){

      $('#ingesp').bind('keyup',function(){ 
        var node = $(this);
        node.val(node.val().replace(/^\s+[a-zA-záéíóúñÁÉÍÓÚÑ ]/g,'') ); 
        node.val(capitalizeFirstLetter(node.val()));
    });

}


function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function validField(){
    var e=0;
    if($('#ingesp').val()==''){
        e=0;
    }else {
        e=1;
    }
return e;
}


