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
           $('#sucess').append(function(){
                    
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
        
  ////////////////////////recupere name uploader////////////////       
         $('#appbundle_sound_morceau').on("change", function(e){
       
        var filename = e.target.value.split('\\').pop();
        $('#selectName').text(filename);
 
    });
    
    
    
    
 ////////////////////////select genre musique systeme tag////////////////       
     $(document).ready(function() {
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
//        maximumSelectionLength: 4,
        placeholder: "With Max Selection limit 4",
        allowClear: true
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
                
            },
             
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#appbundle_sound_image").change(function(){
        readURL(this);
        
    }); 
   
    
////////////////////////compte caractere saisi description////////////////       
    function reste(texte)
{
    var restants = 250-texte.length;
    document.getElementById('caracteres').innerHTML=restants + "&nbsp;caractère(s)&nbsp;disponible(s)";
}

$(function(){
   $('<div id="caracteres">250 caracatère(s) disponible(s)</div>').insertAfter('#appbundle_sound_description'); 
});


