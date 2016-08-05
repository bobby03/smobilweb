$(function() {
    
    $('#Personal_tel').mask('(000) 000-0000', {placeholder: "(000) 000-0000"});

    /* Validacion de RFC para Personas */

   $('#Personal_rfc').on('keyup',function()
    {
      $('#Personal_rfc').val($('#Personal_rfc').val().toUpperCase());
    });


   $('.ValidaAlpha').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^[a-zA-ZáéíóúñÁÉÍÓÚÑ ]/g,'') ); }
  );

  });


function ValidaRfc(rfcStr) {
    var re = /^(([A-Za-z]){4})([0-9]{6})(([A-Z]|[a-z]|[0-9]){3})$/; 
    var str = rfcStr;
    
    if(re.test(str) ==true){
      return true;
    }else{
      return false;
    }

}