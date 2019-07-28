<?php   
$title = "DWG Control";
require '../layout/header.php';
$tbl_dwg = '31_dwg_control';
try{
  // $statement = $pdo->prepare("SELECT *  FROM $tbl_dwg
  //  WHERE dwg_trash = 0 ");
  // $statement->execute();
  // $result = $statement->fetchAll();
} //try
catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
}
?>
          <!-- Page Content -->
          <h3><?=$title ?></h3>
          <hr>
          <div id="alert_box" class="alert alert-success  fade " style="display: none;">
  <strong id="msg_head"></strong><p id="msg_txt"></p>
  <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-success" onclick="location.href='dwg_create.php';">Create New</button>
                    <button class="btn btn-primary" onclick="location.href='../../file_import/dwg/dwg_import_template_updated_22072019.xlsx';">Load Template</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#import_excel_modal">Import Excel</button>
                    <button class="btn btn-primary" onclick="export_excel()">Export Data</button>
                </div>
        </div>
        <br>
    <div class="table-responsive">
      <table class="table table-hover table-sm small" id="dataTable">
        <thead class="bg-info text-white">
          <tr>
            <th>Drawing No.</th>
            <th>Minor</th>
            <th>Part Name</th>
            <th>Memo Part List</th>
            <th>QA Chart/Std. Perf.</th>
            <th>Part DWG</th>
            <th>Gen. DWG</th>
            <th>Mat. DWG</th>
            <th>Pages</th>
            <th>Remark</th>
            <th>PC Received Date</th>
            <th>Distribute Date</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
      </table>
      </div>




<?php   require 'modal/import_excel_modal.php';?>
<?php   require '../layout/footer.php';?>
<script src='js/dwg_table.js'></script>
<script>
        $(document).ready(function() {
        // var table = $('#dataTable').DataTable({
        // stateSave: true,
        // "pageLength": 25,
        // "order": [ 0, "asc" ]
        // });
        var table = $('#dataTable').DataTable( {
          stateSave: true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "dwg_serverside.php",
            dataSrc: function ( data ) {
          //  recordsTotal = data.recordsTotal;
           return data.data;
         } 
        },
        "pageLength": 25,
        drawCallback: function( settings ) {
        // var api = this.api();
        // $( api.column( 1 ).footer() ).html(
        //   'Total Records: '+recordsTotal
        //     );
        }
//         ,
//         'columnDefs': [
//   {
//       "targets": 0, // your case first column
//       "className": "text-center",
//       "width": "15%"
//  },
//      {
//           "targets": 1,
//           "className": "text-center",
//      },
//      {
//           "targets": 4,
//           "className": "text-center",
//      },
//      {
//           "targets": 6,
//           "className": "text-right",
//      }
// ]

 } );
        $('#dataTable tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) {
                            $(this).removeClass('selected');
                        }
                        else {
                            table.$('tr.selected').removeClass('selected');
                            $(this).addClass('selected');
                        }
                    });
    $('#dataTable tbody').on( 'click', '.btndelete', function () {
          var _id = this.id;
          var result = confirm("Want to delete?");
            if (result) {
              table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
              $.ajax({
               type: "POST",
               url: "ajax/dwg_delete.php",
               data:{_id:_id},
               success: function(data)
               {
                $('#alert_box').show();
                 console.log(data);
                    if(data == 'error'){
                        alert_box.className = 'alert alert-danger alert-dismissible fade show';
                        msg_head.innerHTML= 'Error !!';
                        msg_txt.innerHTML= 'พบปัญหา ไม่สามารถลบข้อมูลได้ กรูราติดต่อเจ้าหน้าที่ ที่เกี่ยวข้อง';
                    }else{
                        alert_box.className = 'alert alert-success alert-dismissible fade show';
                        msg_head.innerHTML= 'Success !!';
                        msg_txt.innerHTML= 'ลบข้อมูลสำเร็จ';
                    }
               }
             });
            }
    });
    $(function(){
        $("[data-hide]").on("click", function(){
            $(this).closest("." + $(this).attr("data-hide")).hide();
        });
    });
 });
</script>