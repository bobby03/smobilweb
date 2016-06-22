$(document).ready(function()
{
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
                $('.row.cepa').removeClass('hide');
            },
            error: function(a, b, c)
            {
                console.log(a, b, c);
            }
        });
    });
});