$(document).ready(function()
{
   $('.items tbody tr').each(function()
   {       
       $(this).find('a.view').remove();
   });            
});