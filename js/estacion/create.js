$(document).ready(function()
{
    var total = 0;
    var flag = true;
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
        var campo = '\
                <div class="tanque nuevo" data-id="'+total+'">\n\
                    <div class="tacha">X</div>\n\
                    <div class="row nom">\n\
                        <label for="Tanque_nombre" class="required">\n\
                            Nombre\n\
                            <span class="required">*</span>\n\
                        </label>\n\
                        <input size="50" class="fnombre" maxlength="50" name="Tanque[activo]['+total+'][nombre]" id="Tanque_status_'+total+'_nombre" type="text" autocomplete="off">\n\
                        <div class="errorMessage" id="Tanque_nombre_em_" style="display:none"></div>\n\
                    </div>\n\
                    <div class="row cap">\n\
                    <label for="Tanque_nombre" class="required">\n\
                            Capacidad (Litros)\n\
                            <span class="required">*</span>\n\
                    </label>\n\
                    <input class="ttan fcapacidad" placeholder="500"  name="Tanque[activo]['+total+'][capacidad]" id="Tanque_status_'+total+'_capacidad" type="text" autocomplete="off">\n\
                    <div class="errorMessage" id="Tanque_capacidad_em_" style="display:none"></div>\n\
                    </div>\n\
                </div>';
        $('.allTanques').prepend(campo);
        total = total + 1;
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
        validator();
    });
$('#btnguardar').click(function()
    {
        var a = 0;
        $('.tanque').each(function()
        {
            var capacidad = $(this).find('.fcapacidad');
            var nombre = $(this).find('.fnombre');
            var valor = capacidad.val();
            if(valor == '')
            {
                capacidad.siblings('.errorMessage').text('Valor requerido').show();
                a++;
            }
            else
                capacidad.siblings('.errorMessage').text('').hide();
            var valor2 = nombre.val();
            if(valor2 == '')
            {
                nombre.siblings('.errorMessage').text('Nombre requerido').show();
                a++;
            }
            else
                nombre.siblings('.errorMessage').text('').hide();
        });
        if(a>0)
            return false;
        else
            return true;
        
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
     $('.btncanc').click(function()
     {
        console.log('Back');
        window.history.back();
        // window.location.href = "../../";
    });

    function validator()
    {
        $('.row.nom input').keyup(function()
        {
            var nombre = $(this).val();
            var div = $(this);
            div.addClass('noCheck');
            flag = true;
            $('.row.nom input').each(function()
            {
                if(!$(this).hasClass('noCheck'))
                {
                    var nombre2 = $(this).val();
                    if(nombre2 == nombre)
                    {
                        div.addClass('error');
                        div.siblings('.errorMessage').show().text('Ese nombre ya existe');
                        flag = false;
                    }
                }
            });
            div.removeClass('noCheck');
            if(flag)
            {
                $('.row.nom input').removeClass('error');
                div.siblings('.errorMessage').hide();
            }
        });
    }
    validator();
    $('input[type="submit"]').click(function(evt)
    {
        if(flag == false)
            evt.preventDefault();
    });
});

