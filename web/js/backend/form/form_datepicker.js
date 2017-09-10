/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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