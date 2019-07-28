<?ob_start();?>
<?php   
$title = "Import ECN Data";
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
  <a href="ecn.php">กรุณากดกลับไปยังหน้า ECN ที่นี่</a></label>
          <!-- Page Content -->
          <hr>

    <div class="table-responsive">
      <table class="table table-hover table-sm table-bordered " id="dataTable">
      <thead class="bg-info text-white small">
          <tr class="text-center">
          <th rowspan="2" ><p>Create Date</p></th>
            <th rowspan="2" ><p>ECN No.</p></th>
            <th rowspan="2"><p>Buddle Code</p></th>
            <th rowspan="2"><p>MINOR</p></th>
            <th rowspan="2"><p>Part No Old.</p></th>
            <th rowspan="2"><p>Part  Name Old</p></th>
            <th rowspan="2"><p>Part No. New</p></th>
            <th rowspan="2"><p>Part Name New</p></th>
            <th rowspan="2"><p>AC</p></th>
            <th rowspan="2"><p>Model Concern</p></th>
            <th rowspan="2"><p>Reason</p></th>
            <!-- <th rowspan="2" ><p>New part/Full compatible/Non</p></th> -->
            <th rowspan="2"><p>WH Management</p></th>
            <th rowspan="1" colspan="2" class="bg-warning"><p>Production</p></th>
            <th rowspan="2"><p>Effective</p></th>
            <th rowspan="2"><p>Eff Date</p></th>
            <th rowspan="2"><p>Status ECN</p></th>
            <!-- <th rowspan="1" colspan="2"><p>Actual for risk</p></th> -->
            <!-- <th rowspan="2"><p>Management stock (Apros)</p></th> -->
            <!-- <th rowspan="1" colspan="2"><p>Warehouse</p></th> -->
            <!-- <th rowspan="2"><p>Ddate</p></th> -->
            <th rowspan="1" colspan="5"  class="bg-warning"><p>Follow Up Point</p></th>
            <th rowspan="2"><p>Buyer</p></th>      
            <th rowspan="2"><p>Supplier</p></th>     
            <th rowspan="2"><p>First PO</p></th>     
            <th rowspan="2"><p>First Deliver</p></th>      
            <th rowspan="2"><p>Remark/Action</p></th>      
          </tr>
          <tr class="text-center">
              <!-- <th><p>Prod Plan</p></th> -->
              <th><p>Serial No.Break?(Y?N)</p></th>
              <th><p>Serial No.Break</p></th>
              <!-- <th><p>Planing</p></th>
              <th><p>Wearhouse</p></th> -->
              <!-- <th><p>Supply date</p></th>
              <th><p>Serial No.</p></th> -->
              <th><p>DWG.</p></th>
              <th><p>Stock Supplier</p></th>
              <th><p>Cost Supplier</p></th>
              <th><p>QA Audit</p></th>
              <th><p>Special Request</p></th>
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
                                    $created_date = $row['created_date'];
                                    $created_date = str_replace('/', '-', $created_date);
                                    $eff_date = $row['eff_date'];
                                    $eff_date = str_replace('/', '-', $eff_date);
                                    $first_deliver = $row['first_deliver'];
                                    $first_deliver = str_replace('/', '-', $first_deliver);
                                    //check condition
                                    $sn_break_condit = $row['sn_break_condit'];
                                    $eff = $row['eff'];
                                    $ecn_status = $row['ecn_status'];
                                // Validation Data
                                if (($timestamp = strtotime($created_date)) === false) {
                                    echo '<p class="small text-danger">Row ที่ '.$i.' Column created_date มีค่าข้อมูล ('.$created_date.') ประเภทข้อมูลไม่ถูกต้อง ..!! format = dd/mm/yyyy
                                    </p>
                                    ';
                                    $created_date = '';
                                    $error_flag = 1;
                                } 
                                if ($sn_break_condit !== 'Y'  && $sn_break_condit !== 'N' ) {
                                    echo '<p class="small text-danger">Row ที่ '.$i.' Column sn_break_condit มีค่าข้อมูล ('.$sn_break_condit.') ประเภทข้อมูลไม่ถูกต้อง ..!! format = Y หรือ N
                                    </p>
                                    ';
                                    $error_flag = 1;
                                }
                                if ($eff !== 'Effective'  && $sn_break_condit !== 'No-Effective' ) {
                                    echo '<p class="small text-danger">Row ที่ '.$i.' Column Effective มีค่าข้อมูล ('.$eff.') ประเภทข้อมูลไม่ถูกต้อง ..!! format = Effective หรือ No-Effective
                                    </p>
                                    ';
                                    $error_flag = 1;
                                }
                                if (($timestamp = strtotime($eff_date)) === false) {
                                    echo '<p class="small text-danger">Row ที่ '.$i.' Column eff_date มีค่าข้อมูล ('.$eff_date.') ประเภทข้อมูลไม่ถูกต้อง ..!! format = dd/mm/yyyy
                                    </p>
                                    ';
                                    $eff_date = '';
                                    $error_flag = 1;
                                } 
                                if ($ecn_status !== 'Closed'  && $ecn_status !== 'Follow_up' && $ecn_status !== 'Set_Meeting' && $ecn_status !== 'Pending' ) {
                                    echo '<p class="small text-danger">Row ที่ '.$i.' Column ecn_status มีค่าข้อมูล ('.$ecn_status.') ประเภทข้อมูลไม่ถูกต้อง ..!! format = Closed, Follow_up, Set_Meeting, Pending
                                    </p>
                                    ';
                                    $error_flag = 1;
                                }
                                if (($timestamp = strtotime($first_deliver)) === false) {
                                   // echo '<p class="small text-danger">Row ที่ '.$i.' Column first_deliver มีค่าข้อมูล ('.$first_deliver.') ประเภทข้อมูลไม่ถูกต้อง ..!! format = dd/mm/yyyy
                                    // </p>
                                    // ';
                                    $first_deliver = '01/01/1970';
                                    //$error_flag = 1;
                                } 
                    }              
                    catch (PDOException $e) {
                        print $e->getMessage();
                    }
        ?>
        <tr class="small">
                <td><?=date('d/m/Y',strtotime($created_date))?></td>
                <td><?=$row['ecn_no']?></td>
                <td><?=$row['buddle_code']?></td>
                <td><?=$row['minor']?></td>
                <td><?=$row['part_no_old']?></td>
                <td><?=$row['part_name_old']?></td>
                <td><?=$row['part_no_new']?></td>
                <td><?=$row['part_name_new']?></td>
                <td><?=$row['ac']?></td>
                <td><?=$row['model_concern']?></td>
                <td><?=$row['reason']?></td>
                <td><?=$row['wh_m']?></td>
                <td><?=$row['sn_break_condit']?></td>
                <td><?=$row['sn_break']?></td>
                <td><?=$row['eff']?></td>
                <td><?=date('d/m/Y',strtotime($eff_date))?></td>
                <td><?=$row['ecn_status']?></td>
                <td><?=$row['dwg']?></td>
                <td><?=$row['stock_sup']?></td>
                <td><?=$row['cost_sup']?></td>
                <td><?=$row['qa_audit']?></td>
                <td><?=$row['sp_req']?></td>
                <td><?=$row['buyer']?></td>
                <td><?=$row['sup']?></td>
                <td><?=$row['first_po']?></td>
                <td><?=date('d/m/Y',strtotime($first_deliver))?></td>
                <td><?=$row['remark']?></td>
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
    "order": [ 2, "desc" ]
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
    url: "ajax/ecn_import.php",
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