$(document).ready(function()
{
    $('.search-form2 form').submit(function()
    {
        $('#campsensado-grid2').yiiGridView('update', 
        {
            data: $(this).serialize()
        });
        return false;
    });
    $('.search-form2 input').on('keyup',function(){
         $('.search-form2 form').submit();
    });
});


