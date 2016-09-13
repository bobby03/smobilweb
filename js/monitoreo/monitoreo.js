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
        var estacion=0;
        graficarPorTanque();
        graficarPorParametro();
    
    function graficarPorTanque()
    {
        $('.tab[data-tab="1"] .tanque' ).each(function()
        {
            estacion = $(this).find('.grafica').attr('datos');
            
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
            estacion=$(this).attr('datos');
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

    $("[data-tab='1'] .boton.adve").click(function()
    {
        var estacion = $(this).attr('datos');
        var nombre = $(this).parent().siblings('.datIzq').children('p:first-child').text();
        var id = $(this).data('ale');
        //alert(id+" "+nombre+" "+estacion);
        $.ajax(
        {
            type: 'GET',
            url: 'GetAlertasTanque',
            dataType: 'JSON', 
            data:
            {
                estacion:estacion,
                id: id
            },
            success: function(data)
            {
                $.colorbox(
                {
                    html: data,
                    onComplete: function()
                    {
                        $.colorbox.resize();
                        $('.tituloAlerta').text('Alertas: '+nombre);
                        $('.tableRow > div').each(function()
                        {
                            var h = $(this).height();
                            var height = (50-h)/2;
                            $(this).css('padding',height+'px 0');
                        });
                        
                    }
                });
            },
            error: function(a,b,c)
            {
                console.log(a, b, c);
            }
        });
    });
    $('[data-tab="2"] .boton.adve').click(function()
    {
        total = 1;
        delay = 250;
        var id = $(this).data('ale');
        estacion=$(this).attr('datos');
        $.ajax(
        {
            type: 'GET',
            url: 'GetAlertasParametro',
            dataType: 'JSON', 
            data:
            {
                estacion:estacion,
                id: id
            },
            success: function(data)
            {
                $.colorbox(
                {
                    html: data,
                    onComplete: function()
                    {
                        $.colorbox.resize();
                        $('.tableRow > div').each(function()
                        {
                            var h = $(this).height();
                            var height = (50-h)/2;
                            $(this).css('padding',height+'px 0');
                        });
                        
                    }
                });
            },
            error: function(a,b,c)
            {
                console.log(a, b, c);
            }
        });
    });
    $('[data-tab="1"] .boton.graf').click(function()
    {
        var estacion = $(this).attr('datos');
        var nombre = $(this).parent().siblings('.datIzq').children('p:first-child').text();
        var id = $(this).data('graf');
        $.ajax(
        {
            type: 'GET',
            url: 'GetHistorialTanque',
            dataType: 'JSON', 
            data:
            {
                estacion: estacion,
                id: id
            },
            success: function(data)
            {
                console.log(data);
                $.colorbox(
                {
                    html: data.codigo,
                    onComplete: function()
                    {
                        $('.historial .titulo').text('Historial '+nombre);
                        var ctx1 = $('#historialTanque1');
                        var myChart1 = new Chart(ctx1, data.ox);
                        var ctx2 = $('#historialTanque2');
                        var myChart2 = new Chart(ctx2, data.temp);
                        var ctx3 = $('#historialTanque3');
                        var myChart3 = new Chart(ctx3, data.ph);
                        var ctx4 = $('#historialTanque4');
                        var myChart4 = new Chart(ctx4, data.cond);
                        var ctx5 = $('#historialTanque5');
                        var myChart5 = new Chart(ctx5, data.orp);
                        $.colorbox.resize();
                        $('[data-para]').click(function()
                        {
                            var id = $(this).data('para');
                            $('[data-para]').removeClass('selected');
                            $(this).addClass('selected');
                            $('.grafScroll').addClass('hide');
                            $('.grafScroll[data-rece="'+id+'"]').removeClass('hide');
                        });
                        $('.rangosHistorial div').click(function()
                        {
                            if(!$(this).hasClass('selected'))
                            {
                                $('.rangosHistorial div').removeClass('selected');
                                $(this).addClass('selected');
                                var range = $(this).attr('data-range');
                                $.ajax(
                                {
                                    type: 'GET',
                                    url: 'GetGraficaTanqueRango',
                                    dataType: 'JSON', 
                                    data:
                                    {
                                        estacion: estacion,
                                        id: id,
                                        rango: range
                                    },
                                    success: function(data)
                                    {
                                        var ctx1 = $('#historialTanque1');
                                        var myChart1 = new Chart(ctx1, data.ox);
                                        var ctx2 = $('#historialTanque2');
                                        var myChart2 = new Chart(ctx2, data.temp);
                                        var ctx3 = $('#historialTanque3');
                                        var myChart3 = new Chart(ctx3, data.ph);
                                        var ctx4 = $('#historialTanque4');
                                        var myChart4 = new Chart(ctx4, data.cond);
                                        var ctx5 = $('#historialTanque5');
                                        var myChart5 = new Chart(ctx5, data.orp);
                                    }
                                });
                            }
                        });
                    }
                });
            },
            error: function(a,b,c)
            {
                console.log(a, b, c);
            }
        });
    });
    $('[data-tab="2"] .boton.graf').click(function()
    {
        var nombre = $(this).parent().siblings('.datIzq').children('div:first-child').text();
        var id = $(this).data('ale');
        var estacion = $(this).attr('datos');
        $.ajax(
        {
            type: 'GET',
            url: 'GetHistorialParametro',
            dataType: 'JSON', 
            data:
            {
                estacion: estacion,
                id: id
            },
            success: function(data)
            {
                $.colorbox(
                {
                    html: data.codigo,
                    onComplete: function()
                    {
                        var ctx = $('#parametrosGrafica');
                        var myChart = new Chart(ctx, data.graficaTodos);
                        if(data.graf0 != '' && data.graf0 != null)
                        {
                            var ctx0 = $('#parametrosGrafica0');
                            var myChart0 = new Chart(ctx0, data.graf0);
                        }
                        if(data.graf1 != '' && data.graf1 != null)
                        {
                            var ctx1 = $('#parametrosGrafica1');
                            var myChart1 = new Chart(ctx1, data.graf1);
                        }
                        if(data.graf2 != '' && data.graf2 != null)
                        {
                            var ctx2 = $('#parametrosGrafica2');
                            var myChart2 = new Chart(ctx2, data.graf2);
                        }
                        if(data.graf3 != '' && data.graf3 != null)
                        {
                            var ctx3 = $('#parametrosGrafica3');
                            var myChart3 = new Chart(ctx3, data.graf3);
                        }
                        if(data.graf4 != '' && data.graf4 != null)
                        {
                            var ctx4 = $('#parametrosGrafica4');
                            var myChart4 = new Chart(ctx4, data.graf4);
                        }
                        if(data.graf5 != '' && data.graf5 != null)
                        {
                            var ctx5 = $('#parametrosGrafica5');
                            var myChart5 = new Chart(ctx5, data.graf5);
                        }
                        if(data.graf6 != '' && data.graf6 != null)
                        {
                            var ctx6 = $('#parametrosGrafica6');
                            var myChart6 = new Chart(ctx6, data.graf6);
                        }
                        if(data.graf7 != '' && data.graf7 != null)
                        {
                            var ctx7 = $('#parametrosGrafica7');
                            var myChart7 = new Chart(ctx7, data.graf7);
                        }
                        $('.menuSeccion').click(function()
                        {
                            var id = $(this).attr('data-tanque');
                            $('.menuSeccion').removeClass('selected');
                            $(this).addClass('selected');
                            $('[data-parame]').addClass('hide');
                            $('[data-parame="'+id+'"]').removeClass('hide');
                        });
                        $('.rangosHistorial div').click(function()
                        {
                            if(!$(this).hasClass('selected'))
                            {
                                $('.rangosHistorial div').removeClass('selected');
                                $(this).addClass('selected');
                                var range = $(this).attr('data-range');
                                $.ajax(
                                {
                                    type: 'GET',
                                    url: 'GetGraficaParametroRango',
                                    dataType: 'JSON', 
                                    data:
                                    {
                                        estacion: estacion,
                                        id: id,
                                        rango: range
                                    },
                                    success: function(data)
                                    {
                                        $('.graficasWraper div').remove();
                                        $('.graficasWraper').append('<div class="grafScroll" data-parame="-1">\n\
                                                                        <canvas id="parametrosGrafica" width="7684" height="405" style="width: 7684px; height: 405px;">\n\
                                                                        </canvas>\n\
                                                                    </div>');
                                        var ctx = $('#parametrosGrafica');
                                        var myChart = new Chart(ctx, data.graficaTodos);
                                        if(data.graf0 != '' && data.graf0 != null)
                                        {
                                            $('.graficasWraper').append('<div class="grafScroll hide" data-parame="0">\n\
                                                                        <canvas id="parametrosGrafica0" width="7684" height="405" style="width: 7684px; height: 405px;">\n\
                                                                        </canvas>\n\
                                                                    </div>');
                                            var ctx0 = $('#parametrosGrafica0');
                                            var myChart0 = new Chart(ctx0, data.graf0);
                                        }
                                        if(data.graf1 != '' && data.graf1 != null)
                                        {
                                            $('.graficasWraper').append('<div class="grafScroll hide" data-parame="1">\n\
                                                                        <canvas id="parametrosGrafica1" width="7684" height="405" style="width: 7684px; height: 405px;">\n\
                                                                        </canvas>\n\
                                                                    </div>');
                                            var ctx1 = $('#parametrosGrafica1');
                                            var myChart1 = new Chart(ctx1, data.graf1);
                                        }
                                        if(data.graf2 != '' && data.graf2 != null)
                                        {
                                            $('.graficasWraper').append('<div class="grafScroll hide" data-parame="2">\n\
                                                                        <canvas id="parametrosGrafica2" width="7684" height="405" style="width: 7684px; height: 405px;">\n\
                                                                        </canvas>\n\
                                                                    </div>');
                                            var ctx2 = $('#parametrosGrafica2');
                                            var myChart2 = new Chart(ctx2, data.graf2);
                                        }
                                        if(data.graf3 != '' && data.graf3 != null)
                                        {
                                            $('.graficasWraper').append('<div class="grafScroll hide" data-parame="3">\n\
                                                                        <canvas id="parametrosGrafica3" width="7684" height="405" style="width: 7684px; height: 405px;">\n\
                                                                        </canvas>\n\
                                                                    </div>');
                                            var ctx3 = $('#parametrosGrafica3');
                                            var myChart3 = new Chart(ctx3, data.graf3);
                                        }
                                        if(data.graf4 != '' && data.graf4 != null)
                                        {
                                            $('.graficasWraper').append('<div class="grafScroll hide" data-parame="4">\n\
                                                                        <canvas id="parametrosGrafica4" width="7684" height="405" style="width: 7684px; height: 405px;">\n\
                                                                        </canvas>\n\
                                                                    </div>');
                                            var ctx4 = $('#parametrosGrafica4');
                                            var myChart4 = new Chart(ctx4, data.graf4);
                                        }
                                        if(data.graf5 != '' && data.graf5 != null)
                                        {
                                            $('.graficasWraper').append('<div class="grafScroll hide" data-parame="5">\n\
                                                                        <canvas id="parametrosGrafica5" width="7684" height="405" style="width: 7684px; height: 405px;">\n\
                                                                        </canvas>\n\
                                                                    </div>');
                                            var ctx5 = $('#parametrosGrafica5');
                                            var myChart5 = new Chart(ctx5, data.graf5);
                                        }
                                        if(data.graf6 != '' && data.graf6 != null)
                                        {
                                            $('.graficasWraper').append('<div class="grafScroll hide" data-parame="6">\n\
                                                                        <canvas id="parametrosGrafica6" width="7684" height="405" style="width: 7684px; height: 405px;">\n\
                                                                        </canvas>\n\
                                                                    </div>');
                                            var ctx6 = $('#parametrosGrafica6');
                                            var myChart6 = new Chart(ctx6, data.graf6);
                                        }
                                        if(data.graf7 != '' && data.graf7 != null)
                                        {
                                            $('.graficasWraper').append('<div class="grafScroll hide" data-parame="7">\n\
                                                                        <canvas id="parametrosGrafica7" width="7684" height="405" style="width: 7684px; height: 405px;">\n\
                                                                        </canvas>\n\
                                                                    </div>');
                                            var ctx7 = $('#parametrosGrafica7');
                                            var myChart7 = new Chart(ctx7, data.graf7);
                                        }
                                    }
                                });
                            }
                        });
                    }
                });
            },
            error: function(a,b,c)
            {
                console.log(a, b, c);
            }
        });
    });

	});