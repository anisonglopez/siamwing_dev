<?ob_start();?>
<?php   
$title = "Effective Date";
require '../layout/header.php';
if(in_array('NTI', $role_module_chk) == FALSE) : 
  header("Location: ../base/404.php"); /* Redirect browser */
  // exit(0);
endif;
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Notification List</h1>
          <!-- Default Card Example -->
          <div id="alert_box" class="alert alert-success  fade " style="display: none;">
  <strong id="msg_head"></strong><p id="msg_txt"></p>
  <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-8">
      <p>List of ecn are up coming effective date is  <?=$eff_exp_date_int ?> day(s)</p>

      </div>
      <!-- <div class="col-md-3" และรายการ ECN Status Follow Up ทั้งหมด>
      
      </div> -->
      <div class="col-md-4 text-right">
      <button class="btn btn-success" data-toggle="modal" data-target="#send_mail_modal">Send Mail</button>
      </div>
    </div>        
  </div>
<!-- end card header -->
  <!-- <div class="card-body">
    <div class="col-md-12">
    
    </div>
  </div> -->
</div>
<?php
    $tbl_name = '30_ecn';
    $search_date_start = date("Y/m/d");
    $search_date_end = date("Y/m/d", strtotime('+'.$eff_exp_date_int.' days'));
    try{
    $statement = $pdo->prepare("SELECT *  FROM $tbl_name
    WHERE ecn_trash = 0 
    AND (eff_date  BETWEEN '$search_date_start' and '$search_date_end' 
    AND eff = 'Effective'  AND ecn_status = 'Follow_up')
    ");
    $statement->execute();
    $result_noti = $statement->fetchAll();
    } //try
    catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    }

?>
<div class="table-responsive">
      <table class="table table-hover table-sm table-bordered" id="dataTable">
        <thead class="bg-info text-white small">
          <tr class="text-center">
          <th rowspan="2"><p>Action</p></th>
          <th rowspan="2"><p>Status ECN</p></th>
          <th rowspan="2"><p>Effective</p></th>
            <th rowspan="2"><p>Eff Date</p></th>
          <!-- <th rowspan="2"><p>Last Updated By</p></th> -->
          <th rowspan="2" ><p>Create Date</p></th>
            <th rowspan="2"><p>ECN No.</p></th>
            <th rowspan="2"><p>Buddle Code</p></th>
            <!-- <th rowspan="2"><p>MINOR</p></th> -->
            <th rowspan="2"><p>Part No Old.</p></th>
            <!-- <th rowspan="2"><p>Part  Name Old</p></th> -->
            <th rowspan="2"><p>Part No. New</p></th>
            <th rowspan="2"><p>Part Name New</p></th>
            <!-- <th rowspan="2"><p>AC</p></th> -->
            <!-- <th rowspan="2" class="model_concern"><p>Model Concern</p></th> -->
            <th rowspan="2"><p>Reason</p></th>
            <!-- <th rowspan="2" ><p>New part/Full compatible/Non</p></th> -->
            <th rowspan="2"><p>WH Management</p></th>
            <th rowspan="1" colspan="1" class="bg-warning"><p>Production</p></th>


            <!-- <th rowspan="1" colspan="2"><p>Actual for risk</p></th> -->
            <!-- <th rowspan="2"><p>Management stock (Apros)</p></th> -->
            <!-- <th rowspan="1" colspan="2"><p>Warehouse</p></th> -->
            <!-- <th rowspan="2"><p>Ddate</p></th> -->
            <!-- <th rowspan="1" colspan="5"  class="bg-warning"><p>Follow Up Point</p></th> -->
            <!-- <th rowspan="2"><p>Buyer</p></th>      
            <th rowspan="2"><p>Supplier</p></th>     
            <th rowspan="2"><p>First PO</p></th>     
            <th rowspan="2"><p>First Deliver</p></th>      
            <th rowspan="2"><p>Remark/Action</p></th>       -->
          </tr>
          <tr class="text-center">
              <!-- <th><p>Prod Plan</p></th> -->
              <!-- <th><p>Serial No.Break?(Y?N)</p></th> -->
              <th><p>Serial No.Break</p></th>
              <!-- <th><p>Planing</p></th>
              <th><p>Wearhouse</p></th> -->
              <!-- <th><p>Supply date</p></th>
              <th><p>Serial No.</p></th> -->
              <!-- <th><p>DWG.</p></th>
              <th><p>Stock Supplier</p></th>
              <th><p>Cost Supplier</p></th>
              <th><p>QA Audit</p></th>
              <th><p>Special Request</p></th> -->
          </tr>
        </thead>
        <tbody>
        <?php foreach ($result_noti as $row) : ?>
        <?php
                    $eff_date = date('d/m/Y' , strtotime($row['eff_date']));
                    if(date('Y-m-d') == $row['eff_date']){
                        $eff_date = '<span class="badge badge-pill badge-danger">'.$eff_date.'</span>';
                    }
        ?>
            <tr class="small">
            <td class="text-center"><a href="../ecn/ecn_change.php?id=<?php echo base64_encode($row["ecn_id"]); ?>" class="btn btn-outline-warning btn-sm"><span class="fas fa-edit fa-fw"></span></a></td>
            <td class="text-center">
            <?php
                            if($row['ecn_status'] == 'Closed' ){
                                echo  '<span class="badge badge-pill badge-success">'.$row['ecn_status'].'</span>' ;
                            }
                           else if($row['ecn_status'] == 'Set_Meeting' ){
                                    echo  '<span class="badge badge-pill badge-primary">'.$row['ecn_status'].'</span>' ;
                           }else if($row['ecn_status'] == 'Pending' ){
                            echo  '<span class="badge badge-pill badge-warning">'.$row['ecn_status'].'</span>' ;
                           }
                           else{
                               echo  '<span class="badge badge-pill badge-danger">'.$row['ecn_status'].'</span>';
                           }
                    ?>
            </td>
              <td class="text-center"><?=$row['eff'] == 'Effective' ? 
                '<span class="badge badge-pill badge-dark">'.$row['eff'].'</span>' 
                : 
                '<span class="badge badge-pill badge-light">'.$row['eff'].'</span>' ?></td>
                <td><?=$eff_date?></td>
                <!-- <td><?=$row['ecn_updated_by']?></td> -->
                <td width="40"><?=date('d/m/Y' , strtotime($row['created_date']))?></td>
                <td><?=$row['ecn_no']?></td>
                <td><?=$row['buddle_code']?></td>
                <!-- <td><?=$row['minor']?></td> -->
                <td><?=$row['part_no_old']?></td>
                <!-- <td><?=$row['part_name_old']?></td> -->
                <td><?=$row['part_no_new']?></td>
                <td><?=$row['part_name_new']?></td>
                <!-- <td><?=$row['ac']?></td> -->
                <!-- <td><?=nl2br($row['model_concern'])?></td> -->
                <td><?=nl2br($row['reason'])?></td>
                <td><?=nl2br($row['wh_m'])?></td>
                <!-- <td class="text-center"><?=$row['sn_break_condit']?></td> -->
                <td><?=$row['sn_break']?></td>
                <!-- <td><?=$row['dwg']?></td>
                <td><?=$row['stock_sup']?></td>
                <td><?=$row['cost_sup']?></td>
                <td><?=$row['qa_audit']?></td>
                <td><?=$row['sp_req']?></td> -->
                <!-- <td><?=$row['buyer']?></td>
                <td><?=$row['sup']?></td>
                <td><?=$row['first_po']?></td>
                <td><?=date('d/m/Y' , strtotime($row['first_deliver']))?></td>
                <td><?=nl2br($row['remark'])?></td> -->

            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
<!-- end card -->
<?php   require 'modal/send_mail_modal.php';?>
<?php   require '../layout/footer.php';?>
<script>
 var table = $('#dataTable').DataTable();
</script>