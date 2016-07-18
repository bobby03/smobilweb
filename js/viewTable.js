$(document).ready(function(){
$('table.detail-view').each(function (){
            $(this).replaceWith( $(this).html()
                .replace(/<tbody/gi, "<div class='table-view'")
                .replace(/<tr/gi, "<div class='dato'")
                .replace(/<\/tr>/gi, "</div>")
                .replace(/<th/gi, "<div class='title'")
                .replace(/<\/th>/gi, "</div>")
                .replace(/<td/gi, "<div class='data'")
                .replace(/<\/td>/gi, "</div>")
                .replace(/<\/tbody/gi, "<\/div")
            );
        });

   $('div.table-view div.dato:even').addClass ('even');
   $('div.table-view div.dato:odd').addClass ('odd');
});