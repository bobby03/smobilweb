$(document).ready(function()
{
    $('.search-button').click(function()
    {
        $('.search-form2').toggle();
        return false;
    });

    $('.search-form2 form').submit(function()
    {
        $('#usuario-grid2').yiiGridView('update', 
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

});