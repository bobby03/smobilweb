$(document).ready(function()
{

    $('div.agregar.especie').click(function(e)
    {
        
        var href = window.location.href;
        var miHtml= '\
            <div class="sub-content">\n\
                <div class="title-content">Agregar especie</div>\n\
                <div class="esp">Especie</div>\n\
                <div class="separator-content"></div>\n\
                <input id="ingesp" class="ingesp" type="text">\n\
                <p id="ierror"></p>\n\
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

                $('.btnadd').click(function(e)
                {
               
                var nombre=$('#ingesp').val();
                r=validField(nombre, mCallback);


                    if(r == 1){  }else{
                       
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
                e.preventDefault();
                });
            }
        });
        e.preventDefault();
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
                var nombre=$('#ingesp').val();
                r=validField(nombre, mCallback);


                    if(r == 1){  }else{
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



function mCallback(res){
   // console.log('funcion mCallback:' +res);
     return res;
}

function validField(nombre,mCallback){
    
     var resp =false;
    if($('#ingesp').val()==''){
        $('#ierror').html('Campo requerido');
        e.preventDefault();
        return false;
       
    }else{


   
    resp = $.ajax(
            {
                type: 'POST',
                url: window.location.href+'/Rep',
                dataType: 'JSON', 
                data:
                        {
                            nombre:nombre
                        },
                success: function(result) {
                    if(result == true){
                                 $('#ierror').html('Campo ya existe');
                                 e = true;
                            }else{
                                $('#ierror').html('');
                                e = false;
                            }
                         ajax_result =  mCallback(result); 
                      //  console.log(ajax_result);
                 },
                 error: function(result) {},
                 async: false }).responseText;

  
    }

  return resp;

}
