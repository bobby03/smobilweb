$(function() {

  $('#CampSensado_hora_inicio').mask('00:00');

  $('#CampSensado_hora_inicio').mask('HX:YZ', 
    {
      translation:  
      {
        'H': {pattern: /[0-2]/,optional: false},
        'X': {pattern: /[0-9]/,optional: false},
        'Y': {pattern: /[0-5]/,optional: false},
        'Z': {pattern: /[0-9]/,optiona: false},
      }});



  $('#CampSensado_hora_fin').mask('00:00');

  $('#CampSensado_hora_fin').mask('HX:YZ', 
    {
      translation:  
      {
        'H': {pattern: /[0-2]/,optional: false},
        'X': {pattern: /[0-9]/,optional: false},
        'Y': {pattern: /[0-5]/,optional: false},
        'Z': {pattern: /[0-9]/,optiona: false},
      }});


  $('.ValidaAlpha').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^[a-zA-ZáéíóúñÁÉÍÓÚÑ ]/g,'') ); }
  );





$('body.CampSensado-create .siguiente.uno').click(function() {
    $('#Granjas_id').blur();
    $('#CampSensado_id_estacion').blur();
    $('#CampSensado_id_responsable').blur();
    $('#CampSensado_nombre_camp').blur();

    $('#CampSensado_fecha_inicio').blur();
    $('#CampSensado_fecha_fin').blur();
    $('CampSensado_hora_inicio').blur();
    $('CampSensado_hora_fin').blur();


 /*   $('[data-tab="1"] select[multiple="multiple"]').each(function() {
        if ($("option:selected", this).text() === "" || $("option:selected", this).text() === "Seleccionar") {
            $(this).next('div.chosen-container').addClass("error");
            $(this).closest('div').find('.errorMessage').show().html('Debe Seleccionar una persona');
            $(this).next('div.chosen-container').removeClass("success");
        } else {
            $(this).closest('div').find('.errorMessage').hide().html('');
            $(this).next('div.chosen-container').addClass("success");
            $(this).next('div.chosen-container').removeClass("error");
        }
    });*/

    var err = $('div').find('.error');

    if (err.length > 0) {
        return 0;

    } else {
        if (formSendViajes()) {
            $('[data-tab="1"]').addClass('hide');
            $('[data-tab="2"]').removeClass('hide');
            $('.menuTabs div:nth-child(4)').addClass('selected');
            $('.menuTabs div:nth-child(5)').addClass('selected');
            $('.pedidoWraper').css('height', 'auto');
        } else {
            return 0;

        }

    }


});
});