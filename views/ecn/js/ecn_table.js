//date picker
function search_con(){
    var search_by_create_date = document.getElementById("search_date");
    var search_by_part_no = document.getElementById("search_part_no");
    var search_status = document.getElementById("search_status");
    var daterange = document.getElementById("daterange");
    var part_no_search = document.getElementById("part_no_search");
    var ecn_status = document.getElementById("ecn_status");
    if(search_by_create_date.checked == true){
        part_no_search.disabled = true;
        ecn_status.disabled = true;
        daterange.disabled = false;
    }
    if(search_by_part_no.checked == true){
        daterange.disabled = true;
        ecn_status.disabled = true;
        part_no_search.disabled = false;
    }
    if(search_status.checked == true){
        daterange.disabled = true;
        part_no_search.disabled = true;
        ecn_status.disabled = false;
    }
    // alert(search_by_create_date);
}
function search_submit(){
    var search_by_create_date = document.getElementById("search_date");
    var search_by_part_no = document.getElementById("search_part_no");
    var search_status = document.getElementById("search_status");
    var part_no_search = document.getElementById("part_no_search").value;
    var ecn_status = document.getElementById("ecn_status").value;
    var cre_date_start = $('input[name="daterange"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var cre_date_end = $('input[name="daterange"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
    if(search_by_create_date.checked == true){
        $.ajax({              
            url: "ajax/ecn_table.php",
            type: 'POST',
            data: {cre_date_start:cre_date_start, cre_date_end:cre_date_end },
            beforeSend: function() {
                $('#detail').html('กำลังโหลด ..');        
            },
            success: function(data) {
                $('#detail').html(data);          
            }
        });
    }
    if(search_by_part_no.checked == true){
        $.ajax({              
            url: "ajax/ecn_table.php",
            type: 'POST',
            data: {part_no_search:part_no_search},
            beforeSend: function() {
                $('#detail').html('กำลังโหลด ..');        
            },
            success: function(data) {
                $('#detail').html(data);          
            }     
        });
    }
    if(search_status.checked == true){
        $.ajax({              
            url: "ajax/ecn_table.php",
            type: 'POST',
            data: {ecn_status:ecn_status},
            beforeSend: function() {
                $('#detail').html('กำลังโหลด ..');        
            },
            success: function(data) {
                $('#detail').html(data);          
            }
        });
    }

}
$(document).ready(function() {
//Search Condition
var search_by_create_date = document.getElementById("search_date");
var search_by_part_no = document.getElementById("search_part_no");
var search_status = document.getElementById("search_status");
var daterange = document.getElementById("daterange");
var part_no_search = document.getElementById("part_no_search");
var ecn_status = document.getElementById("ecn_status");

if(search_by_create_date.checked == true){
    part_no_search.disabled = true;
    ecn_status.disabled = true;
    daterange.disabled = false;
}
//End

    var progress = $(".loading-progress").progressTimer({
        timeLimit: 5,
        onFinish: function () {
            $('#progressTimer').hide();
        }
    });
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '/' + mm + '/' + dd;

    var day30_pass = new Date();
    var dd = String(day30_pass.getDate()).padStart(2, '0');
    var mm = String(day30_pass.getMonth()).padStart(2, '0'); //January is 0!
    var yyyy = day30_pass.getFullYear();
    day30_pass = yyyy + '/' + mm + '/' + dd;

    var cre_date_start =   day30_pass;
    var cre_date_end = today;
//Ready Onload
$.ajax({              
    url: "ajax/ecn_table.php",
    type: 'POST',
    data: {cre_date_start:cre_date_start, cre_date_end:cre_date_end },
    beforeSend: function() {
        // setting a timeout
        $('#detail').html('กำลังโหลด ..');        
    },
    success: function(data) {
        //progress.progressTimer('complete');
       $('#detail').html(data);          
    },
    error: function(jqXHR, status, error) {
        progress.progressTimer('error', {
            errorText:'ERROR!',
            onFinish:function(){
            }
        });
    }
});

//enc ajax onload
    $('input[name="daterange"]').daterangepicker({
      opens: 'left',
      locale: {  format: 'DD/MM/YYYY' }  
    }
    , function(start, end, label) {
        var cre_date_start = start.format('YYYY-MM-DD') ;
        var cre_date_end = end.format('YYYY-MM-DD');
          event.preventDefault();
    $.ajax({              
        url: "ajax/ecn_table.php",
        type: 'POST',
        data: {cre_date_start:cre_date_start, cre_date_end:cre_date_end },
        beforeSend: function() {
            // setting a timeout
            $('#detail').html('กำลังโหลด ..');        
        },
        success: function(data) {
            //progress.progressTimer('complete');
            $('#detail').html(data);          
        }
    });
    });

  });
  function export_excel(url) {
    var search_by_create_date = document.getElementById("search_date");
    var search_by_part_no = document.getElementById("search_part_no");
    var search_status = document.getElementById("search_status");
    var part_no_search = document.getElementById("part_no_search").value;
    var ecn_status = document.getElementById("ecn_status").value;
    var cre_date_start = $('input[name="daterange"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var cre_date_end = $('input[name="daterange"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
    if(search_by_create_date.checked == true){
        // alert("Create Date True");
        $.ajax({               
            url: "ajax/ecn_export.php",
            type: 'GET',
            success: function(e) {
                    window.location = 'ajax/ecn_export.php?cre_date_start=' + cre_date_start + '&cre_date_end=' + cre_date_end;
            }
        });
    }
    if(search_by_part_no.checked == true){
        // alert("Search by Part no");
        $.ajax({               
            url: "ajax/ecn_export.php",
            type: 'GET',
            success: function(e) {
                    window.location = 'ajax/ecn_export.php?partno=' + part_no_search;
            }
        });
    }
    if(search_status.checked == true){
        // alert("Search by Status");
        $.ajax({               
            url: "ajax/ecn_export.php",
            type: 'GET',
            success: function(e) {
                    window.location = 'ajax/ecn_export.php?searchstatus=' + ecn_status;
            }
        });
    }
}
