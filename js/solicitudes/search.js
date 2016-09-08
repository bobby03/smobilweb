$(document).ready(function()
{
    $('.search-button').click(function()
    {
    	$('.search-form2').toggle();
    	return false;
    });

    $('.search-form2 form').submit(function()
    {
        $('#solicitudes-grid2').yiiGridView('update', 
        {
            data: $(this).serialize()
        });
        return false;
    });


    $('#searchDropDown2').on('change',function()
    {
        if($('#searchDropDown2 option:selected').val() ==''){
           $('.search-form2 form').trigger("reset");
        }
        var id = $(this).val();
        $('.search-form2 div.row[data-id]').addClass('hide');
        $('.search-form2 div.row[data-id="'+id+'"]').removeClass('hide');

    });

    $('.search-form2 select').on('change',function(){
         $('.search-form2 form').submit();
         $('.search-form2 form div.hide input[type=text]').val('');
         $('.search-form2 form').submit();
    });

    $('.search-form2 input').on('keyup',function(){
         $('.search-form2 form').submit();
    });
//Search 3 En ruta
  $('.search-button').click(function()
    {
        $('.search-form3').toggle();
        return false;
    });

    $('.search-form3 form').submit(function()
    {
        $('#solicitudes-grid3').yiiGridView('update', 
        {
            data: $(this).serialize()
        });
        return false;
    });


    $('#searchDropDown3').on('change',function()
    {
   
    
        
        if($('#searchDropDown3 option:selected').val() ==''){
           $('.search-form3 form').trigger("reset");
        }
        var id = $(this).val();
        $('.search-form3 div.row[data-id]').addClass('hide');
        $('.search-form3 div.row[data-id="'+id+'"]').removeClass('hide');

    });

    $('.search-form3 select').on('change',function(){
         $('.search-form3 form').submit();
         $('.search-form3 form div.hide input[type=text]').val('');
         $('.search-form3 form').submit();
    });

    $('.search-form3 input').on('keyup',function(){
         $('.search-form3 form').submit();
    });

    //Form search 4
    $('.search-button').click(function()
    {
        $('.search-form4').toggle();
        return false;
    });

    $('.search-form4 form').submit(function()
    {
        $('#solicitudes-grid4').yiiGridView('update', 
        {
            data: $(this).serialize()
        });
        return false;
    });

    $('#searchDropDown4').on('change',function()
    { 
        if($('#searchDropDown4 option:selected').val() ==''){
           $('.search-form4 form').trigger("reset");
        }
        var id = $(this).val();
        $('.search-form4 div.row[data-id]').addClass('hide');
        $('.search-form4 div.row[data-id="'+id+'"]').removeClass('hide');
    });
    
    $('.search-form4 select').on('change',function(){
         $('.search-form4 form').submit();
         $('.search-form4 form div.hide input[type=text]').val('');
         $('.search-form4 form').submit();
    });

    $('.search-form4 input').on('keyup',function(){
         $('.search-form4 form').submit();
    });
});