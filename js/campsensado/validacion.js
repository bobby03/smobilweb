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

});