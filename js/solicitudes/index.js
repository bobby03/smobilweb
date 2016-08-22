$(document).ready(function()
{
	var urlSplit = window.location.href;
      //  var id = urlSplit[ urlSplit.length]; 
      var id=urlSplit.split('/');
      var val=id[ id.length - 1 ];

    $('.tab').click(function()
    {
        var id = $(this).attr('data-id');
        $('.tab').removeClass('select');
        $(this).addClass('select');
        $('.tabContent').addClass('hide');
        $('[data-tan="'+id+'"]').removeClass('hide');
    });
    if(val=='#asignadas'){
    	$('#asignadas').click();
    }


});