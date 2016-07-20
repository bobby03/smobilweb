$(document).ready(function()
{
	var flag2=true;
	$('.enlace').click(function()
    {
        var id = $(this).attr('data-id');
        $('.enlace').removeClass('select');
        $(this).addClass('select');
        $('.tab').addClass('hide');
        $('[data-tab="'+id+'"]').removeClass('hide');
    });
        graficarPorTanque();
        graficarPorParametro();
    
    function graficarPorTanque()
    {
        $('.tab[data-tab="1"] .tanque' ).each(function()
        {
            var estacion = $(this).find('.grafica').attr('datos');
            
            var id = $(this).find('.grafica').attr('data-tanque');
            var i = 1;
            
            $(this).find('.grafica div').each(function()
            {
                var flag = $(this).attr('data-num');
                $.ajax(
                {
                    type: 'GET',
                    url: 'GetTanqueGrafica',
                    dataType: 'JSON', 
                    data:
                    {
                        estacion: estacion,
                        id: id,
                        flag: flag,
                        flag2: flag2
                    },

                    success: function(data2)
                    {
                        var ctx = $('[data-tanque="'+id+'"] #graf'+i+'');
                        if(data2 != '' && data2 != null)
                            var myChart = new Chart(ctx, data2.grafica);
                        i ++;
                    },
                    error: function(a,b,c)
                    {
                       console.log(a, b, c)
                    }
                }); 
            });
        });
    }
    function graficarPorParametro()
    {
        $('.tab[data-tab="2"] .tanque').each(function()
        {
            var cont = $(this).attr('data-para');
            var estacion=$(this).attr('datos');
            $.ajax(
            {
                type: 'GET',
                url: 'GetParametroGrafica',
                dataType: 'JSON', 
                data:
                {
                    estacion: estacion,
                    flag: cont
                },
                success: function(data2)
                {
                    var ctx = $('canvas#grafP'+cont+'');
                    if(data2 != '' && data2 != null)
                        var myChart = new Chart(ctx, data2);
                },
                error: function(a,b,c)
                {
                    console.log(a, b, c);
                }
            }); 
        });
    }

	});