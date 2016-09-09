
$(document).ready(function()
{

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
        node.val(node.val().replace(/[^[a-zA-ZáéíóúñÁÉÍÓÚÑ ]/g,'') ); 
    });



    /*
    * INICIA VALIDACION PASO 1
    */

    $('.siguiente.uno').click(function() {

        
        // Activa Validacion en Los inputs
        $('#Granjas_id').blur();
        $('#CampSensado_id_estacion').blur();
        $('#CampSensado_id_responsable').blur();
        $('#CampSensado_nombre_camp').blur();
        $('#CampSensado_fecha_inicio').blur();
        $('#CampSensado_fecha_fin').blur();
        $('#CampSensado_hora_inicio').blur();
        $('#CampSensado_hora_fin').blur();
        validaGranjas();

        //Listeners
        $('select').on('change',function(){
        validaGranjas();
        });
        
        //Agrega un setTimeout de 0.5 segundos en espera de la respuesta de ajax
        setTimeout(function(){ 
             var err = $('div.formContainer1').find('.error');
             console.log(err.length);
               if (err.length > 0) {
                return 0;
            } else {
                if (err.length == 0) {
                    $('[data-tab="1"]').addClass('hide');
                    $('[data-tab="2"]').removeClass('hide');
                    $('.menuTabs div:nth-child(4)').addClass('selected');
                    $('.menuTabs div:nth-child(5)').addClass('selected');
              
                } else {
                    return 0;

                }

            }


            $('.ValidaNum').bind('keyup blur',function(){ 
                var node = $(this);
                node.val(node.val().replace(/[^[0-9]/g,'') ); 
             });

         }, 500);
    });
    /*
    * TERMINA VALIDACION PASO 1
    */




    /*
    *   INICIA VALIDACION PASO 2
    *
    *   Si el campo especie se encuentra seleccionado, valida el resto de los inputs
    */

    $("[data-tab='2']").bind("DOMSubtreeModified", function() {

        $('[data-tab="2"] select.especie').each(function() {
           if ($("option:selected", this).text() === "" || $("option:selected", this).text() === "Seleccionar") {
                 $(this).parents('.pedido').removeClass('valida');
            } else { 
                 $(this).parents('.pedido').addClass('valida');
           }
       });

});



    $('.siguiente.dos').click(function() {

         if (goStep()) {
                    $('[data-tab="1"]').addClass('hide');
                    $('[data-tab="2"]').addClass('hide');
                    $('[data-tab="3"]').removeClass('hide');
                    $('.menuTabs div:nth-child(4)').addClass('selected');
                    $('.menuTabs div:nth-child(5)').addClass('selected');
                    $('.menuTabs div:nth-child(6)').addClass('selected');
                    $('.menuTabs div:nth-child(7)').addClass('selected');
              
                } else {
                    return 0;

                }
    
    });



}); // jQuery




function validaGranjas(e) {
    if ($("#Granjas_id option:selected").text() == "" || $("#Granjas_id option:selected").text() === "Seleccionar") {
         $("#Granjas_id").parents('.row').addClass('error');
    } else {
          //$("#Granjas_id").parents('.row').removeClass('error');
    }
}

function validaTanquesData(e){

    var c=0;
     $('div.pedido.valida').each(function() {
                console.log(c++);
                // Verifica que La cepa este seleccionada
               // if($(this).find('select.cepa option').size() > 1){
                          
                        if($('select.cepa option:selected',this).text() == "" || $('select.cepa option:selected',this).text() === "Seleccionar") {
                            $('select.cepa',this).addClass('error');
                        }else{
                            $('select.cepa',this).removeClass('error');
                        }
                //}

               
                if($(this).find('input.cant-peces').val()==""){
                    $(this).find('input.cant-peces').addClass('error');
                }else{
                    $(this).find('input.cant-peces').removeClass('error');   
                }


                if($(this).find('.error').size() > 0){
                    $(this).removeClass('ok');
                }else{
                            
                    $(this).addClass('ok');
                }
        });




}


function goStep(e){
    validaTanquesData();
    var ok=0;
    if($('div.pedido.valida').size() >0){
            if ($('div.pedido.valida').size() === $('div.pedido.valida.ok').size()){
              ok =1;
            }else{
              ok =0;
            }

    }
    return ok;
}