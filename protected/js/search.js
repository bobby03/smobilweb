$(document).ready(function()
{
    $('.search-button').click(function()
    {
    	$('.search-form').toggle();
    	return false;
    });
    $('.search-form form').submit(function()
    {
        $('.grid-view').yiiGridView('update', 
        {
            data: $(this).serialize()
        });
        return false;
    });
    $('#searchDropDown').on('change',function()
    {
        var id = $(this).val();
        $('.search-form div.row[data-id]').addClass('hide');
        $('.search-form div.row[data-id="'+id+'"]').removeClass('hide');
    });
    $('.search-form select').on('change',function(){
         $('.search-form form').submit();
    });

});