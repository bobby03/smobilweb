/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    var url  = window.location.href;
    var hash = url.lastIndexOf('#');
    if(hash>-1) {
        var id=url.split('#');
        var val=id[ id.length - 1 ];
        console.log(val);
        $('#'+val).trigger('click');
    }
    
});
