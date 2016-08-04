$(function() {
  
    $('#Clientes_tel').mask('(000) 000-0000');

   $('#Clientes_rfc').on('change',function()
    {
    ValidaRfc($(this));

    });


  });


function ValidaRfc(rfcStr) {
  var strCorrecta;
  strCorrecta = rfcStr; 
  var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
  var validRfc = new RegExp(valid);
  console.log(validRfc);

  /*var matchArray=strCorrecta.match(validRfc);
  if (matchArray==null) {
    alert('Cadena incorrectas');

    return false;
  }
  else
  {
    alert('Cadena correcta:' + strCorrecta);
    return true;
  }*/
  
}