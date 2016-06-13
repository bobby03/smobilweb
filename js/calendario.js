$(document).ready(function()
{
    $( ".calendario" ).datepicker(
    {
        changeMonth: true,
        changeYear: true,
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
<<<<<<< HEAD
        dateFormat: 'dd-mm-yyyy'
=======
        dateFormat: 'dd-mm-yy'
>>>>>>> 5ee369a842a3e612a28b2e282ecf7b7f1b6ee706
    }); 
    $('.calendario').click(function()
    {
        $('.ui-datepicker-calendar').css('min-width' ,'100%');
        $('.ui-datepicker-calendar').css('max-width','150px');
    });
});