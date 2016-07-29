$(document).ready(function()
{
$('.liest').click(function()
    {
        var id = $(this).attr('data-id');
        var estacion = $(this).attr('data-estacion');
        $('.liest').removeClass('selected');
        $(this).addClass('selected');
        $('.cont').addClass('hide');
        $('.infocliente').addClass('hide');
        $('.infocontacto').addClass('hide');
        $('.ubicacion').addClass('hide');
        $('[data-id="'+id+'"]').removeClass('hide');


        cargaTanques(estacion); 
        
    });

function cargaTanques(id) {
        var url = window.location.href;
        var pos = url.lastIndexOf('php');
        if (pos > 0) {
            url += '/site/DashboardTanques';
        }
        else {
            url += 'index.php/site/DashboardTanques';
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
              container.children('.containerBoxE').last().find('.bubbleC').removeClass('bubbleC');
              container.children('.containerBoxE').last().find('.txtRuta').removeClass('txtRuta').addClass('txtR2');
              console.log(container.length);
            },
            error: function( a, b, c){
                console.error(a, b, c);
            }
        });
     }


});//Cierre de ready function