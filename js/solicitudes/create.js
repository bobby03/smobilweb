$(document).ready(function()
{
    $('#Cepa_id').chosen();
    $('#Solicitudes_id_clientes').chosen();
    $('#Especie_id').chosen();
    $('#Solicitudes_id_clientes').on('change', function()
    {
        var id = $(this).val();
        $.ajax(
        {
            type: 'GET',
            url: 'GetCliente',
            dataType: 'JSON', 
            data:
            {
                id: id
            },
            success: function(data)
            {
                $('.datosCliente').empty();
                $('.datosCliente').append(data);
            },
            error: function(a, b, c)
            {
                console.log(a, b, c);
            }
        });
    });
    $('#Especie_id').on('change', function()
    {
        var id = $(this).val();
        if(id != '' && id != null)
        {
            $.ajax(
            {
                type: 'GET',
                url: 'GetCepas',
                dataType: 'JSON', 
                data:
                {
                    id: id
                },
                success: function(data)
                {
                    $('#Cepa_id option:gt(0)').remove();
                    $('#Cepa_id').append(data);
                    $('#Cepa_id').trigger("chosen:updated");
                    $('.row.cepa').removeClass('hide');
                },
                error: function(a, b, c)
                {
                    console.log(a, b, c);
                }
            });
        }
        else
            $('.row.cepa').addClass('hide');
    });
});