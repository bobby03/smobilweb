$(document).ready(function()
{
    var total = 0;
    function contar()
    {
        $('.tanque').each(function()
        {
            total = total + 1;
        });
    }
    contar();
    $('.addTanque').click(function()
    {
        console.log(total);
        if(total <= 8)
        {
            var campo = $('.tanque[data-id="1"]').clone();
            $('.allTanques').append(campo);
            total = total + 1;
            $('.allTanques').children().last().attr('data-id', total);
            $('.allTanques').children().last().children('input[type="hidden"]').remove();
            $('.allTanques').children().last().children('.row.cap').children('input')
                    .attr('name','Tanque[status]['+total+'][capacidad]')
                    .attr('id','Tanque_status_'+total+'_capacidad')
                    .removeAttr('disabled')
                    .val('');
            $('.allTanques').children().last().children('.row.nom').children('input')
                    .attr('name','Tanque[status]['+total+'][nombre]')
                    .attr('id','Tanque_status_'+total+'_nombre')
                    .removeAttr('disabled')
                    .val('');
            $('.allTanques').children().last().children('.row.sta').remove();
            $('.allTanques').children().last().children('.row.act').remove();
        }
    });
    
     $('.tab').click(function()
    {
        var id = $(this).attr('data-id');
        $('.tab').removeClass('select');
        $(this).addClass('select');
        $('.tabContent').addClass('hide');
        $('[data-tan="'+id+'"]').removeClass('hide');
    });
     $('.status').each(function(){
        a=$('option:selected',this).text();
        if(a=='Ocupado'){
            $(this).parent().siblings('.act').children('.activo').attr('disabled',true);
        }else{
            $(this).parent().siblings('.act').children('.activo').attr('disabled',false);
        }
     });
     $('.status').change(function()
     {
        a=$('option:selected',this).text();
        if(a=='Ocupado'){
            $(this).parent().siblings('.act').children('.activo').attr('disabled',true);
        }else{
            $(this).parent().siblings('.act').children('.activo').attr('disabled',false);
        }
     });
});

