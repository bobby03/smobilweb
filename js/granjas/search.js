$(document).ready(function()
{
    $('.search-form form').submit(function()
    {
        $('#granjas-grid2').yiiGridView('update', 
        {
            data: $(this).serialize()
        });
        return false;
    });
    $('#searchDropDown').on('change',function()
    {
        if($('#searchDropDown2 option:selected').val() ==''){
           $('.search-form form').trigger("reset");
        }
        var id = $(this).val();
        $('.search-form div.row[data-id]').addClass('hide');
        $('.search-form div.row[data-id="'+id+'"]').removeClass('hide');

    });

    $('.search-form select').on('change',function(){
         $('.search-form form').submit();
         $('.search-form form div.hide input[type=text]').val('');
         $('.search-form form').submit();
    });

    $('.search-form input').on('keyup',function(){
         $('.search-form form').submit();
    });
});