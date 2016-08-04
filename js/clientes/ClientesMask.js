$(function() {
    $('#Clientes_rfc').after('<div class="errorMessage"></div>');        

    $('#Clientes_tel').mask('(000) 000-0000');




    /* Validacion de RFC para empresas */
   $('body.clientes-create input[type="submit"]').on('click',function()
    {
      $('#Clientes_rfc').val($('#Clientes_rfc').val().toUpperCase());
    if(ValidaRfc($('#Clientes_rfc').val())){
      $('#Clientes_rfc').removeClass('error');
      $('#Clientes_rfc').parent().children('.errorMessage').html('');
    }else{
      $('#Clientes_rfc').addClass('error');
      $('#Clientes_rfc').next('.errorMessage').html('RFC No Valido');
      return false;

    }

    });

  });


function ValidaRfc(rfcStr) {
  
    var re = /^(([A-Za-z]){3})([0-9]{6})(([A-Z]|[a-z]|[0-9]){3})$/; 
    var str = rfcStr;
    
    if(re.test(str) ==true){
      return true;
    }else{
      return false;
    }

}