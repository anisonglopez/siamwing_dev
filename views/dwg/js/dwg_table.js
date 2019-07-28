function export_excel(url) {
    // var cre_date_start = $('input[name="daterange"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
    // var cre_date_end = $('input[name="daterange"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
  $.ajax({              
      url: "ajax/dwg_export.php",
      type: 'GET',
      success: function(e) {
            window.location = 'ajax/dwg_export.php';
          //sconsole.log(data);

            //console.log(data);
      }
  });
}