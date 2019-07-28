<?ob_start();?>
<?php   
$title = "Import DWG Data";
require '../layout/header.php';
?>
<?php
try{


set_time_limit(0); 
// header('Content-Type: text/html; charset=utf-8');
 
//Connect DB
// require '../00_config/connect.php';
 
//File สำหรับ Import
$inputFileName=$_FILES["file"]["tmp_name"];		
 
/** PHPExcel */
require_once '../../vendor/phpexcel/Classes/PHPExcel.php';
 
/** PHPExcel_IOFactory - Reader */
include '../../vendor/phpexcel/Classes/PHPExcel/IOFactory.php';
 
 
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  
 
$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();
 
$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];
 
$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}
 //var_dump( $namedDataArray);

// foreach ($namedDataArray as $resx) {
 //Insert
//   $query = " INSERT INTO tbl_name (field1,field2,field3,field4,field5,field6) VALUES
//       (
//        '".$resx['field1']."',
//        '".$resx['field2']."',
//        '".$resx['field3']."',
//        '".$resx['field4']."',
//        '".$resx['field5']."',
//        '".$resx['field6']."'
//       )";
//   $res_i = $mysqli->query($query);
 //
// }
// $mysqli->close();
?>
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">ตรวจสอบข้อมูลจากไฟล์ Excel</h1>
  <label><u>กรุณาอย่า Reresh Page </u><label class="text-danger">***ระบบจะบันทึกข้อมูลซ้ำ</label> 
  <a href="dwgcontrol.php">กรุณากดกลับไปยังหน้า DWG Control ที่นี่</a></label>
          <!-- Page Content -->
          <hr>

    <div class="table-responsive">
      <table class="table table-hover table-sm table-bordered " id="dataTable">
      <thead class="bg-info text-white small">
          <tr class="text-center">
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
          </tr>
        </thead>
        <tbody>
            <?php 
         $i = 2;
        // var error flag
        $error_flag = 0;
        foreach ($namedDataArray as $row) : 
                    try{
                                     //date
                                    $pc_recive_date = $row['pc_recive_date'];
                                    $pc_recive_date = str_replace('/', '-', $pc_recive_date);
                                    $distribute_date = $row['distribute_date'];
                                    $distribute_date = str_replace('/', '-', $distribute_date);
                                    //check condition
                                // Validation Data
                                if (($timestamp = strtotime($pc_recive_date)) === false) {
                                    echo '<p class="small text-danger">Row ที่ '.$i.' Column pc_recive_date มีค่าข้อมูล ('.$pc_recive_date.') ประเภทข้อมูลไม่ถูกต้อง ..!! format = dd/mm/yyyy
                                    </p>
                                    ';
                                    $pc_recive_date = '';
                                    $error_flag = 1;
                                } 
                                if (($timestamp = strtotime($distribute_date)) === false) {
                                    echo '<p class="small text-danger">Row ที่ '.$i.' Column distribute_date มีค่าข้อมูล ('.$distribute_date.') ประเภทข้อมูลไม่ถูกต้อง ..!! format = dd/mm/yyyy
                                    </p>
                                    ';
                                    $distribute_date = '';
                                    $error_flag = 1;
                                } 
                    }              
                    catch (PDOException $e) {
                        print $e->getMessage();
                    }
        ?>
        <tr class="small">
                    <td><?php echo ($row["dwg_no"]); ?></td>
                    <td><?php echo ($row["minor"]); ?></td>
                    <td><?php echo ($row["part_name"]); ?></td>
                    <td><?php echo ($row["memo_part_list"]); ?></td>
                    <td><?php echo ($row["qa_chart"]); ?></td>
                    <td><?php echo ($row["part_dwg"]); ?></td>
                    <td><?php echo ($row["gen_dwg"]); ?></td>
                    <td><?php echo ($row["mat_dwg"]); ?></td>
                    <td><?php echo ($row["pages"]); ?></td>
                    <td><?php echo ($row["remark"]); ?></td>
                    <td><?=date('d/m/Y',strtotime($pc_recive_date))?></td>
                    <td><?=date('d/m/Y',strtotime($distribute_date))?></td>
            </tr>
                  <?php $i++; endforeach; ?>
        </tbody>
      </table>
</div>
                    <?php } //end try
                    catch (PDOException $e) {
                        print $e->getMessage();
                         }

                     if($error_flag == 0){
                                echo '<button class="btn btn-success" onclick="importData()" data-toggle="modal" data-target="#myModal">ยืนยันการนำเข้าระบบ</button>';
                    }
                    ?>
<?php   require '../layout/footer.php';?>
<script src="js/ecn_import.js"></script>
    <!-- UserProfile msgbox Modal-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">สถานะการดำเนินการ นำข้อมูลเข้าระบบ</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="post"  >
             <div class="modal-body">           
            <div id="loading-progress" class="loading-progress"></div>
          <p id="txt_status"></p>                   
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php
$inputFileName = '';
?>
<script>
$(document).ready(function() {
    var table = $('#dataTable').DataTable({
    "pageLength": 25,
    "order": [ 0, "desc" ]
    });
});
function importData(Exceldata){
    var progress = $(".loading-progress").progressTimer({
    timeLimit: 20,
    onFinish: function () {
    $('#progressTimer').hide();
    }
    });
    var Exceldata = <?= json_encode($namedDataArray);?>;
    $.ajax({
    type: "POST",
    url: "ajax/dwg_import.php",
    data: {Exceldata:Exceldata},
        beforeSend: function(jqXHR, settings) {
        $('#txt_status').html("กำลังบันทึกข้อมูล ...");  
        },
        success: function(Exceldata) {
        $('#txt_status').html(Exceldata);  
        progress.progressTimer('complete');
        //alert(Exceldata);
        },
        error: function(jqXHR, status, error) {
            progress.progressTimer('error', {
            errorText:'ERROR!',
            onFinish:function(){}
            });
        }
    });
};
</script>