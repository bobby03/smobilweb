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
        total = total + 1;
        var campo = '\
                <div class="tanque" data-id="'+total+'">\n\
                    <div class="tacha">X</div>\n\
                    <div class="row nom">\n\
                        <label for="Tanque_nombre" class="required">\n\
                            Nombre\n\
                            <span class="required">*</span>\n\
                        </label>\n\
                        <input size="50" maxlength="50" name="Tanque[status]['+total+'][nombre]" id="Tanque_status_'+total+'_nombre" type="text" autocomplete="off">\n\
                        <div class="errorMessage" id="Tanque_nombre_em_" style="display:none"></div>\n\
                    </div>\n\
                    <div class="row cap">\n\
                    <label for="Tanque_nombre" class="required">\n\
                            Capacidad (Litros)\n\
                            <span class="required">*</span>\n\
                    </label>\n\
                    <input size="50" maxlength="50" name="Tanque[status]['+total+'][capacidad]" id="Tanque_status_'+total+'capacidad" type="text" autocomplete="off">\n\
                    <div class="errorMessage" id="Tanque_capacidad_em_" style="display:none"></div>\n\
                    </div>\n\
                </div>';
        $('.allTanques').append(campo);
//        $('.allTanques').children().last().attr('data-id', total);
//        $('.allTanques').children().last().children('input[type="hidden"]').remove();
//        $('.allTanques').children().last().children('.row.cap').children('input')
//                .attr('name','Tanque[status]['+total+'][capacidad]')
//                .attr('id','Tanque_status_'+total+'_capacidad')
//                .removeAttr('disabled')
//                .val('');
//        $('.allTanques').children().last().children('.row.nom').children('input')
//                .attr('name','Tanque[status]['+total+'][nombre]')
//                .attr('id','Tanque_status_'+total+'_nombre')
//                .removeAttr('disabled')
//                .val('');
//        $('.allTanques').children().last().children('.row.sta').remove();
//        $('.allTanques').children().last().children('.row.act').remove();
        borrarTanque();
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
        var a=$('option:selected',this).text();
        if(a=='Ocupado')
            $(this).parent().siblings('.act').children('.activo').attr('disabled',true);
        else
            $(this).parent().siblings('.act').children('.activo').attr('disabled',false);
     });
    $('.status').change(function()
    {
        var a=$('option:selected',this).text();
        if(a=='Ocupado')
            $(this).parent().siblings('.act').children('.activo').attr('disabled',true);
        else
            $(this).parent().siblings('.act').children('.activo').attr('disabled',false);
     });
     function borrarTanque()
     {
         $('div.tacha').click(function()
        {
            $(this).parent('.tanque').remove();
        });
     }
     borrarTanque();
});

