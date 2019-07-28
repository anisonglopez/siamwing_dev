<?ob_start();?>
<?php   
$title = "Change ECN";
require '../layout/header.php';
if(in_array('ECN', $role_module_chk) == FALSE) : 
  header("Location: ../base/404.php"); /* Redirect browser */
  // exit(0);
endif;

if (isset($_GET['id'])) {
    $ecn_id =  base64_decode($_GET['id']);
    try{
        $statement = $pdo->prepare("SELECT * FROM 30_ecn
         WHERE ecn_id  = '$ecn_id' AND ecn_trash = 0 ");
        $statement->execute();
        $result = $statement->fetchAll();
        //echo $result ;
        if(empty($result )){exit;}
        foreach ($result as $row) :
           $ecn_created_by = $row['ecn_created_by'];
           $created_date =date('d/m/Y' , strtotime($row['created_date']));
           $ecn_no =$row['ecn_no'];
           $buddle_code =$row['buddle_code'];
           $minor =  $row['minor'];
           $part_no_old = $row['part_no_old'];
           $part_name_old = $row['part_name_old'];
           $part_no_new =$row['part_no_new'];
           $part_name_new =$row['part_name_new'];
           $ac = $row['ac'];
           $model_concern =$row['model_concern'];
           $reason = $row['reason'];
           $wh_m = $row['wh_m'];
           $service_part_com = $row['service_part_com'];
           $prod_plan = $row['prod_plan'];
           $sn_break_condit =$row['sn_break_condit'];
           $sn_break = $row['sn_break'];
           $eff = $row['eff'];
           $eff_date =  date('d/m/Y' , strtotime($row['eff_date']));
           $ecn_status = $row['ecn_status'];
           $planing = $row['planing'];
           $warehouse = $row['warehouse'];
           $mange_stock = $row['mange_stock'];
           $serial_no = $row['serial_no'];
           $supply_date =  date('d/m/Y' , strtotime($row['supply_date']));
           $ddate =  date('d/m/Y' , strtotime($row['ddate']));
           $dwg = $row['dwg'];
           $stock_sup = $row['stock_sup'];
           $cost_sup = $row['cost_sup'];
           $qa_audit = $row['qa_audit'];
           $sp_req = $row['sp_req'];
           $buyer = $row['buyer'];
           $sup = $row['sup'];
           $first_po = $row['first_po'];
           $first_deliver =date('d/m/Y' , strtotime($row['first_deliver']));
           $remark =$row['remark'];
        endforeach;
      } 
      catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }
}else{
    die();
}
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">ECN Modification</h1>
          <!-- Page Content -->
          <hr>
<div id="alert_box" class="alert alert-success  fade " style="display: none;">
  <strong id="msg_head"></strong><p id="msg_txt"></p>
  <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<form method="post" id="ecn" class="ecn">
  <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 m-0 font-weight-bold text-primary">
          <p>แก้ไขข้อมูล ECN</p>
          
      </div>
      <div class="col-md-6 text-right">

      <!-- <button   type="reset" class="btn btn-info" onclick="location.reload();" >Create New</button> -->
      <?php if (isset($_GET['flg'])) {
            $flg = $_GET['flg'];
            if($flg == 1){
        echo ' <a  href="ecn.php" class="btn btn-facebook">Back</a>';
            }
      }else{
        echo ' <button  type="reset" class="btn btn-facebook" onclick="window.history.go(-1); return false;">Back</button>';
      }

      ?>   
        <button  id='save' type="submit" class="btn btn-success">Update</button>
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
                  <!-- id -->
                  <input type="hidden" id="ecn_id" name='ecn_id'  value="<?=$ecn_id?>"/>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Create Date</label>
                        <input type="text"  name="created_date" value="<?=$created_date?>"  class="form-control"  placeholder="Create Date">
                        </div>
                        <script>
                          $('input[name="created_date"]').daterangepicker({
                            singleDatePicker: true,
                            locale: {  format: 'DD/MM/YYYY' }  
                          });
                        </script>
                        <div class="form-group col-md-6">
                        <label>ECN No.</label>
                        <input type="text" name="ecn_no" value="<?=$ecn_no?>" class="form-control"  placeholder="ECN No.">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Buddle Code</label>
                        <input type="text" name="buddle_code" value="<?=$buddle_code?>" class="form-control"  placeholder="Buddle Code">
                        </div>
                        <div class="form-group col-md-6">
                        <label>MINOR</label>
                        <input type="text" name="minor" value="<?=$minor?>" value="<?=$created_date?>" class="form-control"  placeholder="MINOR">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Part No. Old</label>
                        <input type="text" name="part_no_old" value="<?=$part_no_old?>" class="form-control"  placeholder="Part No. Old">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Part Name. Old</label>
                        <input type="text" name="part_name_old" value="<?=$part_name_old?>" class="form-control"  placeholder="Part Name. Old">
                        </div>
                    </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Part No. New</label>
                        <input type="text" name="part_no_new" value="<?=$part_no_new?>" class="form-control"  placeholder="Part No. New">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Part Name. New</label>
                        <input type="text" name="part_name_new" value="<?=$part_name_new?>" class="form-control"  placeholder="Part Name. New">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>AC</label>
                        <input type="text" name="ac" value="<?=$ac?>" class="form-control"  placeholder="AC">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Model Concern</label>
                        <textarea  name="model_concern" class="form-control" placeholder="Model Concern" rows="5"><?=$model_concern?></textarea>
                        </div>
                    </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Reason</label>
                        <textarea name="reason"  class="form-control"  placeholder="Reason" rows="5"><?=$reason?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Service part Compatibility <small>New part/Full compatible/Non</small></label>
                        <textarea name="service_part_com" class="form-control"  placeholder="Service part Compatibility" rows="5"><?=$service_part_com?></textarea>
                        

                        </div>
                    </div>

                        <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>WH Management</label>
                        <textarea name="wh_m"  class="form-control"  placeholder="WH Management" rows="5"><?=$wh_m?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Prod Plan</label>
                        <textarea name="prod_plan" class="form-control"  placeholder="Prod Plan" rows="5"><?=$prod_plan?></textarea>
                      </div>
                    </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>S/N Break ?</label> <span class="text-danger">*</span>
                        <select  class="form-control" name="sn_break_condit"  required>
                              <option value="">Select</option>
                                        <option value="Y" <?= $sn_break_condit === "Y" ? 'selected' : null; ?>>Yes</option>
                                        <option value="N" <?= $sn_break_condit === "N" ? 'selected' : null; ?>>No</option>
                              </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label>S/N Break</label>
                        <input type="text" name="sn_break" value="<?=$sn_break?>" class="form-control"  placeholder="S/N Break">
                        </div>
                    </div>

                       <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Effective </label> <span class="text-danger">*</span>
                        <select value="<?=$created_date?>" class="form-control" name="eff"  required>
                              <option value="">Select</option>
                                        <option value="Effective" <?= $eff === "Effective" ? 'selected' : null; ?>>Effective</option>
                                        <option value="No-Effective" <?= $eff === "No-Effective" ? 'selected' : null; ?>>No-Effective</option>
                              </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Effective Date</label>
                        <input type="text"  name="eff_date"  value="<?=$eff_date?>" class="form-control"  placeholder="Create Date">
                        <script>
                          $('input[name="eff_date"]').daterangepicker({
                            singleDatePicker: true,
                            locale: {  format: 'DD/MM/YYYY' }  
                          });
                        </script>
                        </div>
                    </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>ECN Status</label> <span class="text-danger">*</span>
                        <select class="form-control" name="ecn_status"  required>
                              <option value="">Select</option>
                                        <option value="Set_Meeting" <?= $ecn_status === "Set_Meeting" ? 'selected' : null; ?>>Set Meeting</option>
                                        <option value="Pending" <?= $ecn_status === "Pending" ? 'selected' : null; ?>>Pending</option>
                                        <option value="Follow_up" <?= $ecn_status === "Follow_up" ? 'selected' : null; ?>>Follow up</option>
                                        <option value="Closed" <?= $ecn_status === "Closed" ? 'selected' : null; ?>>Closed</option>
                              </select>
                        </div>
                        <div class="form-group col-md-6">
                     
                        </div>
                    </div>

                    <!-- <br>
                      <h4>Actual for risk</h4>
                      <hr>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Planing</label>-->
                        <input type="hidden" name="planing" value="<?=$planing?>" class="form-control"  placeholder="Planing">
                        <!-- </div>
                        <div class="form-group col-md-6">
                        <label>Warehouse</label> -->
                        <input type="hidden" name="warehouse" value="<?=$warehouse?>" class="form-control"  placeholder="Warehouse">
                        <!-- </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Management stock (Apros)</label> -->
                        <input type="hidden" name="mange_stock" value="<?=$mange_stock?>" class="form-control"  placeholder="Management stock (Apros)">
                        <!-- </div>
                        <div class="form-group col-md-6">
                        </div>
                    </div> --> 

                     <br>
                      <h4>Warehouse</h4>
                      <hr>
                      <div class="form-row">
                        
                        <div class="form-group col-md-6">
                        <label>Supply date</label>
                        <input type="text"  name="supply_date" value="<?=$supply_date?>" class="form-control"  >
                        <script>
                          $('input[name="supply_date"]').daterangepicker({
                            singleDatePicker: true,
                            locale: {  format: 'DD/MM/YYYY' }  
                          });
                        </script>
                        </div>
                    </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Serial No.</label>
                        <input type="text" name="serial_no" value="<?=$serial_no?>"  class="form-control"  placeholder="Serial No.">
                        </div>
                        <div class="form-group col-md-6">
                        <label>D Date</label>
                        <input type="text"  name="ddate" value="<?=$ddate?>" class="form-control"  >
                        <script>
                          $('input[name="ddate"]').daterangepicker({
                            singleDatePicker: true,
                            locale: {  format: 'DD/MM/YYYY' }  
                          });
                        </script>
                        </div>
                    </div>

                 <br>
                    <h4>Purchasing Management</h4>
                    <hr>
                  <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Buyer</label>
                        <input type="text" name="buyer" value="<?=$buyer?>" class="form-control"  placeholder="Buyer">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Supplier</label>
                        <input type="text" name="sup" value="<?=$sup?>" class="form-control"  placeholder="Supplier">
                        </div>
                    </div>

                       <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>First PO</label>
                        <input type="text" name="first_po" value="<?=$first_po?>" class="form-control"  placeholder="First PO">
                        </div>
                        <div class="form-group col-md-6">
                        <label>First Deliver</label>
                        <input type="text"  name="first_deliver" value="<?=$first_deliver?>" class="form-control"  >
                        <script>
                          $('input[name="first_deliver"]').daterangepicker({
                            singleDatePicker: true,
                            locale: {  format: 'DD/MM/YYYY' }  
                          });
                        </script>
                        </div>
                    </div>

                 <br>
                    <h4>Follow up point</h4>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>DWG</label>
                        <input type="text" name="dwg"  value="<?=$dwg?>" class="form-control"  placeholder="DWG">
                        </div>
                        <div class="form-group col-md-6">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Stock Supplier</label> 
                        <input type="text" name="stock_sup" value="<?=$stock_sup?>" class="form-control"  placeholder="Stock Supplier">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Cost Supplier</label>
                        <input type="text" name="cost_sup" value="<?=$cost_sup?>" class="form-control"  placeholder="Cost Supplier">
                        </div>
                    </div>

                       <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>QA Audit</label>
                        <input type="text" name="qa_audit" value="<?=$qa_audit?>" class="form-control"  placeholder="QA Audit">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Speacial Request</label>
                        <input type="text" name="sp_req" value="<?=$sp_req?>" class="form-control"  placeholder="Speacial Request">
                        </div>
                    </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Remark / Action</label>
                        <textarea name="remark"  class="form-control"  placeholder="Remark / Action" rows="5"><?=$remark?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                      
                        </div>
                    </div>
                    <br>
                   
                   <div class="form-row">
                        <div class="form-group col-md-6">
                        <h3>Attachment</h3>
                        
                        </div>
                        <div class="form-group col-md-6 text-right">
                        <a href="#" class="btn btn-facebook" data-toggle="modal" data-target="#file_upload_modal">Add new file</a>
                        </div>
                    </div>
                    <?php
                                $tbl_ecn_attach = '30_ecn_attach';
                                      try{
                                        $statement = $pdo->prepare("SELECT *  FROM $tbl_ecn_attach WHERE  ecn_id ='$ecn_id' ");
                                        $statement->execute();
                                        $result_att = $statement->fetchAll();
                                      } //try
                                      catch (PDOException $e) {
                                        print "Error!: " . $e->getMessage() . "<br/>";
                                      }
                                  ?>

<!-- end card header -->
<div class="table-responsive">
  <div class="card-body">
    <div class="col-md-12">
      <table class="table table-hover table-sm small" id="dataTable">
        <thead class="bg-info text-white">
          <tr>
          <th>File name</th>
          <th>Description</th>
          <th>File size</th>
          <th>Upload date</th>
          <th>Upload by</th>
          <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($result_att as $row) : 
              $att_id = $row["att_id"];
              $file_name = $row["file_name"];
          ?>
                                        <tr id="<?=$att_id;?>">
                                        <td><a href="file_upload/uploads/<?=$file_name;?>"><?=$file_name;?></a></td>
                                        <td><?php echo ($row["att_desc"]); ?></td>
                                          <td><?php echo ($row["file_size"]); ?> bytes</td>
                                          <td><?php echo date("d/m/Y H:i:s", strtotime($row["updated_date"])); ?></td>
                                          <td><?php echo ($row["updated_by"]); ?></td>
                                          <td class="text-center">
                                          <button  type="button" onclick="delete_file('<?=$att_id?>','<?=$file_name?>')"  class="btn btn-outline-danger btn-sm btndelete" ><span class="fas fa-trash fa-fw"></span></button> 
                                        </td>
                                        </tr>
                                <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    </div>
  </div>

    </div>
  </div>
</div>
</form>


              <!-- end card -->
<?php   require 'modal/file_upload_modal.php';?>

<?php   require '../layout/footer.php';?>
<script src="js/ecn_create.js"></script>
<script>
  $(document).ready(function() {
    var table = $('#dataTable').DataTable();
  });

</script>

