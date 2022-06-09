

       $( function() {
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            altFormat: 'dd/mm/yyyy',
            dayNamesMin: ["ma", "di", "wo", "do", "vr", "za", "zo"],
            monthNames: ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"],
            

            dateFormat: 'dd-mm-yy', // this is the format of the date that will be shown
            onSelect: function(dateText, inst) {
              var date  = new Date(dateText);
              $("#submittedDate").val(date.getTime()); // transform into what you want to submit here
         }

          });        
    });


