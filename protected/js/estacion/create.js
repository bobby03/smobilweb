$(document).ready(function()
{
    var total = 0;
    function contar()
    {
        $('.tanque').each(function()
        {
            total = total + 1;
//            $(this).find('input').attr('disabled','disabled');
//            $(this).find('select').attr('disabled','disabled');
        });
    }
    contar();
    $('.addTanque').click(function()
    {
        if(total < 8)
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
    $('.editarTanque').click(function()
    {
        $(this).siblings().find('input').removeAttr('disabled');
        $(this).siblings().find('select').removeAttr('disabled');
        $(this).remove();
    });
});
        