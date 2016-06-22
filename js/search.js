$(document).ready(function()
{
    $('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
    });
    $('.search-form form').submit(function(){
            $('.grid-view').yiiGridView('update', {
                    data: $(this).serialize()
            });
            return false;
    });
});