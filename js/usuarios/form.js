$(document).ready(function()
{
    $('#Usuarios_tipo_usr').on('change',function()
    {
        var id = $(this).val();
        $('[data-tipo]').addClass('hide');
        $('#personalList, #clienteList').val('');
        if(id == 1)
            $('[data-tipo="1"]').removeClass('hide');
        if(id == 2)
            $('[data-tipo="2"]').removeClass('hide');
    });
});