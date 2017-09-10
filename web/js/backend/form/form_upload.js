/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//$(function () {
//    $('#appbundle_sound_morceau').fileupload({
//        dataType: 'json',
//      
//        progressall: function (e, data) {
//            var progress = parseInt(data.loaded / data.total * 100, 10);
//            $('#progress .progress-bar').css(
//                'width',
//                progress + '%'
//            );
//        }
//    });
//    });


//// ajout de la classe JS à HTML
//document.querySelector("html").classList.add('js');
// 
//// initialisation des variables
//var fileInput  = document.querySelector( ".input-file" ),  
//    button     = document.querySelector( ".input-file-trigger" ),
//    the_return = document.querySelector(".file-return");
// 
//// action lorsque la "barre d'espace" ou "Entrée" est pressée
//button.addEventListener( "keydown", function( event ) {
//    if ( event.keyCode === 13 || event.keyCode === 32 ) {
//        fileInput.focus();
//    }
//});
// 
//// action lorsque le label est cliqué
//button.addEventListener( "click", function( event ) {
//   fileInput.focus();
//   return false;
//});
// 
//// affiche un retour visuel dès que input:file change
//fileInput.addEventListener( "change", function( event ) {  
//    the_return.innerHTML = this.value;
//    
//});


$(document).ready(function(){
    
    
    $('#appbundle_sound_morceau').on("change", function(e){
       
        var filename = e.target.value.split('\\').pop();
        $('#selectName').text(filename);
    });






});
     
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                
                $('#selectImage').attr('src', e.target.result);
                $('#selectImage').removeClass('default-picture');
                
            },
             
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#appbundle_sound_image").change(function(){
        readURL(this);
        
    }); 
    
    
    
    function reste(texte)
{
    var restants = 250-texte.length;
    document.getElementById('caracteres').innerHTML=restants + "&nbsp;caractère(s)&nbsp;disponible(s)";
}

$(function(){
   $('<div id="caracteres">250 caracatère(s) disponible(s)</div>').insertAfter('#appbundle_sound_description'); 
});