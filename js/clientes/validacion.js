$(function() {
    

$('#Clientes_tel').mask('(000) 000-0000', {placeholder: "(000) 000-0000"});
$('#Clientes_cel').mask('(000) 000-0000', {placeholder: "(000) 000-0000"});


    /* Validacion de RFC para empresas */

   $('#Clientes_rfc').on('keyup',function()
    {
      $('#Clientes_rfc').val($('#Clientes_rfc').val().toUpperCase());
     });

  $('.ValidaAlpha').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^[a-zA-ZáéíóúñÁÉÍÓÚÑ ]/g,'') ); }
  );

  });