$(document).ready(function()
{
    updateForm()
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
    function updateForm()
    {
        var flag = $('#Usuarios_tipo_usr').val();
        var id = $('[type="hidden"]').val();
        console.log(flag);
        if(flag == 1)
        {
           $('.row[data-tipo="1"]').removeClass('hide');
           $('#clienteList').val(id);
        }
        if(flag == 2)
        {
           $('.row[data-tipo="2"]').removeClass('hide');
           $('#personalList').val(id);
        }
    }
});