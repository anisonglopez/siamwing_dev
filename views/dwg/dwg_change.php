<?php   
$title = "Change DWG";
$tbl_dwg = "31_dwg_control";
require '../layout/header.php';
if (isset($_GET['id'])) {
    $dwg_id =  base64_decode($_GET['id']);
    try{
        $statement = $pdo->prepare("SELECT * FROM $tbl_dwg
         WHERE dwg_id  = '$dwg_id' AND dwg_trash = 0 ");
        $statement->execute();
        $result = $statement->fetchAll();
        //echo $result ;
        if(empty($result )){exit;}
        foreach ($result as $row) :
           $dwg_id = $row['dwg_id'];
           $dwg_no = $row['dwg_no'];
           $minor = $row['minor'];
           $part_name =$row['part_name'];
           $memo_part_list =$row['memo_part_list'];
           $qa_chart =  $row['qa_chart'];
           $part_dwg = $row['part_dwg'];
           $gen_dwg = $row['gen_dwg'];
           $mat_dwg =$row['mat_dwg'];
           $pages =$row['pages'];
           $remark = $row['remark'];
           $pc_recive_date =date('d/m/Y' , strtotime($row['pc_recive_date']));
           $distribute_date =date('d/m/Y' , strtotime($row['distribute_date']));
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
          <h1 class="h3 mb-4 text-gray-800">Change DWG Control</h1>
          <!-- Page Content -->
          <hr>
<div id="alert_box" class="alert alert-success  fade " style="display: none;">
  <strong id="msg_head"></strong><p id="msg_txt"></p>
  <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<form method="post" id="dwg" class="dwg">
  <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 m-0 font-weight-bold text-primary">
          <p>แก้ไขข้อมูล DWG Control</p>
          
      </div>
      <div class="col-md-6 text-right">
      <button  type="reset" class="btn btn-facebook" onclick="location.href='dwgcontrol.php';">Back</button>
        <button  id='save' type="submit" class="btn btn-success">Update</button>
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
                  <!-- id -->
                  <input type="hidden" name="dwg_id" value="<?=$dwg_id?>"/>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Drawing no.</label><span class="text-danger">*</span>
                        <input type="text"  name="dwg_no" value="<?=$dwg_no?>" class="form-control"  placeholder="Drawing No." required>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Minor</label>
                        <input type="text" name="minor"  value="<?=$minor?>" class="form-control"  placeholder="Minor">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Part Name</label>
                        <input type="text" name="part_name" value="<?=$part_name?>" class="form-control"  placeholder="Part Name">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Memo Part List</label>
                        <input type="number" name="memo_part_list" value="<?=$memo_part_list?>" class="form-control"  placeholder="Memo Part List">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>QA Chart/Std. Perf.</label>
                        <input type="number" name="qa_chart" value="<?=$qa_chart?>" class="form-control"  placeholder="QA Chart/Std. Perf.">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Part DWG</label>
                        <input type="number" name="part_dwg" value="<?=$part_dwg?>" class="form-control"  placeholder="Part DWG">
                        </div>
                    </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Gen. DWG</label>
                        <input type="number" name="gen_dwg" value="<?=$gen_dwg?>" class="form-control"  placeholder="Gen. DWG">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Mat. DWG</label>
                        <input type="number" name="mat_dwg" value="<?=$mat_dwg?>" class="form-control"  placeholder="Mat. DWG">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Pages</label>
                        <input type="number" name="pages" value="<?=$pages?>"  class="form-control"  placeholder="Pages">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Remark</label>
                        <textarea  name="remark" class="form-control" placeholder="Remark" rows="5"><?=$remark?></textarea>
                        </div>
                    </div>

           

                       <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>PC Received Date </label> <span class="text-danger">*</span>
                        <input type="text"  name="pc_recive_date" value="<?=$pc_recive_date?>" class="form-control"  placeholder="PC Received Date ">
                        <script>
                          $('input[name="pc_recive_date"]').daterangepicker({
                            singleDatePicker: true,
                            locale: {  format: 'DD/MM/YYYY' }  
                          });
                        </script>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Distribute Date</label> <span class="text-danger">*</span>
                        <input type="text"  name="distribute_date" value="<?=$distribute_date?>" class="form-control"  placeholder="Distribute Date">
                        <script>
                          $('input[name="distribute_date"]').daterangepicker({
                            singleDatePicker: true,
                            locale: {  format: 'DD/MM/YYYY' }  
                          });
                        </script>
                        </div>
                    </div>

                   
    </div>
  </div>
</div>
</form>
              <!-- end card -->
<?php   require '../layout/footer.php';?>
<script src="js/dwg_change.js"></script>
