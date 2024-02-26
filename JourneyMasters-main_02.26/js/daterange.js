
$(function() {
    

    $('input[name="datefilter"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Cancel'
        }
    });
  
    $('input[name="datefilter"], .fa-calendar').on('apply.daterangepicker', function(ev, picker) {
        $('.startDate').val(picker.startDate.format('MM/DD/YYYY'));
        $('.endDate').val(picker.endDate.format('MM/DD/YYYY'));
    });
  
    $('input[name="datefilter"], .fa-calendar').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    //var oke = document.getElementsByClassName('applyBtn');
    //oke[0].innerHTML = 'Alkalmaz';
    
  
  });