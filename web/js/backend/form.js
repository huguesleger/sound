/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
   
    
  ////////////////////////show list musique////////////////    
$(function() { 
  $('#datatable').dataTable({
           url: "admin/sound",
            async: true,
            type: 'GET',
            datatype: "json",
            success: function (datas) {
                alert(datas);
  }
  }
            );
            $('#datatable-keytable').DataTable({
              keys: true
            });
 
        });
        
        
  ////////////////////////datepicker-form////////////////
 $('#appbundle_sound_annee').daterangepicker({
     
        singleDatePicker: true,
        minDate: moment(),
        format: 'YYYY-MM-DD',
        calender_style: "picker_1",
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
          monthNames: ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
          firstDay: 1
        }
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });      
        
        
        
     ////////////////////////notifaction////////////////     
      $(function() {
           $('#success').append(function(){
                    
      new PNotify({
          title:"Success",
          type: "success",
          text: "création ok",
        nonblock: {
          nonblock: true
        },
        before_close: function(PNotify) {
          PNotify.queueRemove();
          return false;
        }
      });

    });
        });
        
        
        
        $(function() {
           $('#delete').append(function(){
                    
      new PNotify({
          title:"Success",
          type: "success",
          text: "suppression ok",
        nonblock: {
          nonblock: true
        },
        before_close: function(PNotify) {
          PNotify.queueRemove();
          return false;
        }
      });

    });
        });
        
        
          $(function() {
           $('#update').append(function(){
                    
      new PNotify({
          title:"Success",
          type: "success",
          text: "mise à jour ok",
        nonblock: {
          nonblock: true
        },
        before_close: function(PNotify) {
          PNotify.queueRemove();
          return false;
        }
      });

    });
        });
        
        
        
           $(function() {
           $('#error').append(function(){
                    
      new PNotify({
          title:"Error",
          type: "error",
          text: "une erreur est survenue",
        nonblock: {
          nonblock: true
        },
        before_close: function(PNotify) {
          PNotify.queueRemove();
          return false;
        }
      });

    });
        }); 
        
  ////////////////////////recupere name morceau uploader////////////////       
         $('#appbundle_sound_morceau').on("change", function(e){
       
        var filename = e.target.value.split('\\').pop();
        $('#selectName').text(filename);
 
    });
    
    
            
  ////////////////////////recupere name avatar uploader////////////////       
         $('#fos_user_profile_form_avatar').on("change", function(e){
       
        var filename = e.target.value.split('\\').pop();
        $('#selectName').text(filename);
 
    });
    
    
    
// ////////////////////////select liste texte animation header systeme tag////////////////       
//     $(document).ready(function() {
//      $(".select1_group").select2({});
//      $(".select1_multiple").select2({
//        maximumSelectionLength: 3,
//        placeholder: "Select...",
//        allowClear: true
//      });
//    });
    
    
 ////////////////////////select genre musique systeme tag////////////////       
     $(document).ready(function() {
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
//        maximumSelectionLength: 4,
        placeholder: "Select...",
        allowClear: true
      });
    });
    
// anim chiffre page index
$(document).ready(function(){        
$('.count').each(function () {
    $(this).prop('Counter',-1).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
});

// var selects = $('.form-control');
// var querysel  = new Object();
//
//
// $("#animateTexte").click(function(){ 
//    
//   
// 
//       selects.each(function(){
//             var id  = $(this).attr('id');
//       var value =  $(this).find("option:selected").text();
//       querysel = value;
//        
// $('#nameAnimate h3').addClass(value);
//
//
//     $("#animateTexte").click(function(){
//        $("#nameAnimate h3").removeClass(function(n) {
//        if (n===0){return value;}
//        else {
//         
//        }
//      
//        });
//    }); 
//    });
//
//});   



// animate css
  function testAnim(x) {
    $('#animationSandbox').removeClass().addClass(x + ' animated-demo').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
    });
  };
  
  

  $(document).ready(function(){
    $('.js--triggerAnimation').click(function(e){
      e.preventDefault();
      var anim = $('#appbundle_headertexte_animationTexte').find("option:selected").text();
      testAnim(anim);
    });

    $('#appbundle_headertexte_animationTexte').change(function(){
      var anim = $(this).find("option:selected").text();
      testAnim(anim);
    });
  });

    
  
});


////////////////////////recupere image uploader////////////////         
 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                
                $('#selectImage').attr('src', e.target.result);
                $('#selectImage').removeClass('default-picture');
                $('#selectImage').removeClass('default-avatar');
                $('.fos_user_profile_edit #selectImage').addClass('img-circle');

            },
             
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#appbundle_sound_image,#appbundle_present_image, #appbundle_header_image, #appbundle_promotion_image, #appbundle_imagemobile_image, #fos_user_profile_form_avatar").change(function(){
        readURL(this);
        
    });
    
    
    
////////////////////////compte caractere saisi description sound///////////////
///  

   function reste(texte)
{
    var restants = 320-texte.length;
    document.getElementById('caracteres').innerHTML=restants + "&nbsp;caractère(s)&nbsp;disponible(s)";
}

$(function(){
   $('<div id="caracteres">320 caracatère(s) disponible(s)</div>').insertAfter('#appbundle_sound_description'); 
});

////////////////////////compte caractere saisi description service///////////////
///  

   function saisie(textes)
{
    var restants = 220-textes.length;
    document.getElementById('write').innerHTML=restants + "&nbsp;caractère(s)&nbsp;disponible(s)";
}

$(function(){
   $('<div id="write">220 caracatère(s) disponible(s)</div>').insertAfter('#appbundle_service_description'); 
});

////////////////////////compte caractere saisi texte promotion///////////////
///  

   function saisiePromo(textes)
{
    var restants = 865-textes.length;
    document.getElementById('write').innerHTML=restants + "&nbsp;caractère(s)&nbsp;disponible(s)";
}

$(function(){
   $('<div id="write">865 caracatère(s) disponible(s)</div>').insertAfter('#appbundle_promotion_texte'); 
});

////////////////////////compte caractere saisi texte presentation///////////////
///  

   function saisiePresent(textes)
{
    var restants = 600-textes.length;
    document.getElementById('write').innerHTML=restants + "&nbsp;caractère(s)&nbsp;disponible(s)";
}

$(function(){
   $('<div id="write">600 caracatère(s) disponible(s)</div>').insertAfter('#appbundle_present_texte'); 
});

////////////////////////compte caractere saisi texte intro production///////////////
///  

   function saisieProdIntro(textes)
{
    var restants = 320-textes.length;
    document.getElementById('write').innerHTML=restants + "&nbsp;caractère(s)&nbsp;disponible(s)";
}

$(function(){
   $('<div id="write">320 caracatère(s) disponible(s)</div>').insertAfter('#appbundle_production_texte'); 
});


     
              $(document).ready(function(){
          
        $ ( '.carousel' ). carousel ({ interval : 0 });
    });



   $(document).ready(function(){
$('#AddLabel').click(function(){
    $('#Label').modal({
        show:true  
    });   
});
    });
    
       $(document).ready(function(){
$('#AddGenre').click(function(){
    $('#Genre').modal({
        show:true  
    });   
});
    });
    
           $(document).ready(function(){
$('#AddProdIntro').click(function(){
    $('#ProdIntro').modal({
        show:true  
    });   
});
    });
    
         $(document).ready(function(){
$('#AddSectionName').click(function(){
    $('#SectionName').modal({
        show:true  
    });   
});
    });


   $(document).ready(function(){
$('#AddSocial').click(function(){
    $('#Social').modal({
        show:true  
    });   
});
    });
    
    

//    $(function() {
//      $('.chart').easyPieChart({
//        easing: 'easeOutElastic',
//        delay: 3000,
//        barColor: '#26B99A',
//        trackColor: '#fff',
//        scaleColor: false,
//        lineWidth: 20,
//        trackWidth: 16,
//        lineCap: 'butt',
//        onStep: function(from, to, percent) {
//          $(this.el).find('.percent').text(Math.round(percent));
//        }
//      });
//
//    });
  
  
  ///////fix info top alert section///////////////

    $(document).ready(function(){
         var present = $('#info-present .info-header').length;
         var promo = $('#info-promo .info-header').length;
         var header = $('.page-title .info-header').length;
         var mobile = $('#info-mobile .info-header').length;
         var head = $('#info-head .info-header').length;
         
         if(present == 1 && promo == 1){
                $('#info-present .info-header').addClass('is-active');
                $('#info-promo .info-header').addClass('is-active');
                $('.container').css('margin-top','100px');
                
                
                $('#info-present .close').click(function(){
                $('#info-present .info-header').removeClass('is-active');
                $('.container').animate({
                marginTop: "0"
              }, 300, function() {
                // Animation complete.
              });  
                });
                
                $('#info-promo .close').click(function(){
                $('#info-promo .info-header').removeClass('is-active');
                $('.container').animate({
                marginTop: "50px"
              }, 300, function() {
                // Animation complete.
              });    
                }); 
                
         } else if (present == 0 && promo == 1)  {
                $('.alert-promo').css('margin-top','0');
                $('#info-promo .info-header').addClass('is-active');
                $('.container').css('margin-top','50px');
                
                
                $('#info-promo .close').click(function(){
                $('#info-promo .info-header').removeClass('is-active');
                $('.container').animate({
                marginTop: "0"
              }, 300, function() {
                // Animation complete.
              });    
                }); 
         } else if (present == 1 && promo == 0)  {
                $('#info-present .info-header').addClass('is-active');
                $('.container').css('margin-top','50px');
                
                
                $('#info-present .close').click(function(){
                $('#info-present .info-header').removeClass('is-active');
                $('.container').animate({
                marginTop: "0"
              }, 300, function() {
                // Animation complete.
              });  
                });
         } else if (header == 1 ) {
             $('.container').css('margin-top','50px');
             $('.page-title .close').click(function(){
                $('.container').animate({
                marginTop: "0"
              }, 300, function() {
                // Animation complete.
              });    
                }); 
         } else if (head == 1 ){
            $('#info-head .info-header').addClass('is-active');
            $('.container').css('margin-top','50px');
                $('#info-head .close').click(function(){
                $('#info-head .info-header').removeClass('is-active');
                $('.container').animate({
                marginTop: "0"
              }, 300, function() {
                // Animation complete.
              });  
                }); 
         } else if (mobile == 1){
            $('#info-mobile .info-header').addClass('is-active');
            $('.container').css('margin-top','50px');
                $('#info-mobile .close').click(function(){
                $('#info-mobile .info-header').removeClass('is-active');
                $('.container').animate({
                marginTop: "0"
              }, 300, function() {
                // Animation complete.
              });  
                });              
         }       
 
      });
      

  
         