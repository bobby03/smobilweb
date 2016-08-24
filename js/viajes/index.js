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
    $('.items tbody tr').each(function()
    {
        $(this).find('a.delete').remove();
    });
    
    //Busqueda para viajes En espera
    $('.search-form form[data-form="1"]').submit(function()
    {
        $('.grid-view[data-id="1"]').yiiGridView('update', 
        {
            data: $(this).serialize()
        });
        return false;
    }); 
    $('#searchDropDown').on('change',function()
    {
        if($('#searchDropDown option:selected').val() =='')
        {
           $('.search-form form[data-form="1"]').trigger("reset");
        }
        var id = $(this).val();
        $('.search-form form[data-form="1"] div.row[data-id]').addClass('hide');
        $('.search-form form[data-form="1"] div.row[data-id="'+id+'"]').removeClass('hide');
    });
    $('.search-form form[data-form="1"] select').on('change',function(){
         $('.search-form form[data-form="1"]').submit();
         $('.search-form form[data-form="1"] div.hide input[type=text]').val('');
         $('.search-form form[data-form="1"]').submit();
    });
    $('.search-form form[data-form="1"] input').on('keyup',function(){
         $('.search-form form[data-form="1"]').submit();
    }); 
    
    //Busqueda para viajes En ruta
    $('.search-form form[data-form="2"]').submit(function()
    {
        $('.grid-view[data-id="2"]').yiiGridView('update', 
        {
            data: $(this).serialize()
        });
        return false;
    }); 
    $('#searchDropDown2').on('change',function()
    {
        if($('#searchDropDown2 option:selected').val() =='')
        {
           $('.search-form form[data-form="2"]').trigger("reset");
        }
        var id = $(this).val();
        $('.search-form form[data-form="2"] div.row[data-id]').addClass('hide');
        $('.search-form form[data-form="2"] div.row[data-id="'+id+'"]').removeClass('hide');
    });
    $('.search-form form[data-form="2"] select').on('change',function(){
         $('.search-form form[data-form="2"]').submit();
         $('.search-form form[data-form="2"] div.hide input[type=text]').val('');
         $('.search-form form[data-form="2"]').submit();
    });
    $('.search-form form[data-form="2"] input').on('keyup',function(){
         $('.search-form form[data-form="2"]').submit();
    }); 
    
    //Busqueda para viajes Finalizados
    $('.search-form form[data-form="3"]').submit(function()
    {
        $('.grid-view[data-id="3"]').yiiGridView('update', 
        {
            data: $(this).serialize()
        });
        return false;
    }); 
    $('#searchDropDown3').on('change',function()
    {
        if($('#searchDropDown3 option:selected').val() =='')
        {
           $('.search-form form[data-form="3"]').trigger("reset");
        }
        var id = $(this).val();
        $('.search-form form[data-form="3"] div.row[data-id]').addClass('hide');
        $('.search-form form[data-form="3"] div.row[data-id="'+id+'"]').removeClass('hide');
    });
    $('.search-form form[data-form="3"] select').on('change',function(){
         $('.search-form form[data-form="3"]').submit();
         $('.search-form form[data-form="3"] div.hide input[type=text]').val('');
         $('.search-form form[data-form="3"]').submit();
    });
    $('.search-form form[data-form="3"] input').on('keyup',function(){
         $('.search-form form[data-form="3"]').submit();
    }); 
});