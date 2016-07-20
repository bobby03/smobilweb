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
    
    function graficarPorTanque()
    {
        $('.tab[data-tab="1"] .tanque' ).each(function()
        {
            var id = $(this).find('.grafica').attr('data-tanque');

            
            var i = 1;
            
            $(this).find('.grafica div').each(function()
            {
                var flag = $(this).attr('data-num');
                $.ajax(
                {
                    type: 'GET',
                    url: 'monitoreo/GetTanqueGrafica',
                    dataType: 'JSON', 
                    data:
                    {
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

	});