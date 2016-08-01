$(document).ready(function()
{
    var estacion=0;
$('.liest').click(function()
    {
        var id = $(this).attr('data-id');
        estacion = $(this).attr('data-estacion');
        $('.infocliente').addClass('hide');
        $('.infocontacto').addClass('hide');
        $('.liest').removeClass('selected');
        $(this).addClass('selected');
        $('.cont').addClass('hide');
        $('.ubicacion').addClass('hide');
        $('[data-id="'+id+'"]').removeClass('hide');
        $('.progressbar').removeClass('hide');
        $('.estv').addClass('hide');
        cargaTanques(estacion); 

    });

function cargaTanques(id) {
        var url = window.location.href;
        var pos = url.lastIndexOf('php');
        if (pos > 0) {
            url += '/site/Dbpb';
        }
        else {
            url += 'index.php/site/Dbpb';
        }
        console.log(url);
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'JSON', 
            data: {
                id: id,
            },
            success: function(data) {
                $('.contenedor-est').empty();
                $('.contenedor-est').append(data.html);
                $('.containerE1').empty();
                $('.containerE1').append(data.linea);
              var container  = $(".containerE1");
              container.children('.containerBoxR').last().find('.bubbleD').removeClass('bubbleD');
              container.children('.containerBoxR').last().find('.txtRuta').removeClass('txtRuta').addClass('txtR2');
            
              //console.log(container.length);
            },
            error: function( a, b, c){
                console.error(a, b, c);
            }
        });
     }


});//Cierre de ready function