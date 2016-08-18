$(function() {

  $('#Viajes_hora_salida').mask('00:00');

  $('#Viajes_hora_salida').mask('HX:YZ', 
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