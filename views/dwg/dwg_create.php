<?php   
$title = "Create DWG";
require '../layout/header.php';
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Create DWG Control</h1>
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
          <p>สร้างข้อมูล DWG Control</p>
          
      </div>
      <div class="col-md-6 text-right">
      <button  type="reset" class="btn btn-facebook" onclick="location.href='dwgcontrol.php';">Back</button>
        <button  id='save' type="submit" class="btn btn-success">Save</button>
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
                  <!-- id -->
                        <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Drawing no.</label><span class="text-danger">*</span>
                        <input type="text"  name="dwg_no" value="" class="form-control"  placeholder="Drawing No." required>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Minor</label>
                        <input type="text" name="minor" class="form-control"  placeholder="Minor">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Part Name</label>
                        <input type="text" name="part_name" class="form-control"  placeholder="Part Name">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Memo Part List</label>
                        <input type="number" name="memo_part_list" class="form-control"  placeholder="Memo Part List">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>QA Chart/Std. Perf.</label>
                        <input type="number" name="qa_chart" class="form-control"  placeholder="QA Chart/Std. Perf.">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Part DWG</label>
                        <input type="number" name="part_dwg" class="form-control"  placeholder="Part DWG">
                        </div>
                    </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Gen. DWG</label>
                        <input type="number" name="gen_dwg" class="form-control"  placeholder="Gen. DWG">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Mat. DWG</label>
                        <input type="number" name="mat_dwg" class="form-control"  placeholder="Mat. DWG">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Pages</label>
                        <input type="number" name="pages" class="form-control"  placeholder="Pages">
                        </div>
                        <div class="form-group col-md-6">
                        <label>Remark</label>
                        <textarea  name="remark" class="form-control" placeholder="Remark" rows="5"></textarea>
                        </div>
                    </div>

           

                       <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>PC Received Date </label> <span class="text-danger">*</span>
                        <input type="text"  name="pc_recive_date" value="<?=date("d/m/Y")?>" class="form-control"  placeholder="PC Received Date ">
                        <script>
                          $('input[name="pc_recive_date"]').daterangepicker({
                            singleDatePicker: true,
                            locale: {  format: 'DD/MM/YYYY' }  
                          });
                        </script>
                        </div>
                        <div class="form-group col-md-6">
                        <label>Distribute Date</label> <span class="text-danger">*</span>
                        <input type="text"  name="distribute_date" value="<?=date("d/m/Y")?>" class="form-control"  placeholder="Distribute Date">
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
<script src="js/dwg_create.js"></script>
