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



        if($(this).is(':checked')) {

              if($(this).hasClass('altaBox')){
                    $id = $(this).parent().parent().find('div.botonTodos').attr('data-id');
                    $(this).parent().parent().attr('data-iz',$id);
                    $('[data-iz='+$id+']').find('input.consultaBox').prop( "checked", true );
                }

                 if($(this).hasClass('bajaBox')){
                    $id = $(this).parent().parent().find('div.botonTodos').attr('data-id');
                    $(this).parent().parent().attr('data-iz',$id);
                    $('[data-iz='+$id+']').find('input.consultaBox').prop( "checked", true );
                }

                 if($(this).hasClass('editBox')){
                    $id = $(this).parent().parent().find('div.botonTodos').attr('data-id');
                    $(this).parent().parent().attr('data-iz',$id);
                    $('[data-iz='+$id+']').find('input.consultaBox').prop( "checked", true );
                }
        }


        if(!$('input.consultaBox').is("checked")){
            $idConsulta = $(this).parent().parent().attr('data-iz');
            if($(this).parent().parent().find('[type="checkbox"]').is(':checked')){
                $('[data-iz='+$idConsulta+']').find('input.consultaBox').prop( "checked", true );
            }
           
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

    borrarBotones();
    function borrarBotones()
    {
        $('.items tbody tr').each(function()
        {
            var check = $(this).find('a.delete').attr('href');
            var index = check.lastIndexOf('/');
            var id = parseInt(check.substring(index+1));
            if(id == 1 || id == 2 || id == 3){
                $(this).find('a.delete').remove();
                $(this).find('a.update').remove();
            }
            
        });
    }


    function activaConsulta()
    {

        if ($('[type="checkbox"].alta').is(':checked')) {
            console.log($(this));
        }

    }


});
