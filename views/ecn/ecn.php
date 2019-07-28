<?ob_start();?>
<?php   
$title = "ECN";
require '../layout/header.php';
 if(in_array('ECN', $role_module_chk) == FALSE) : 
  header("Location: ../base/404.php"); /* Redirect browser */
  // exit(0);
endif;
?>
<!-- Custom css -->
<link href="css/ecn.css" rel="stylesheet"/> 
<!-- Custom css -->


          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">ECN Management</h1>
          <!-- Default Card Example -->
          <div id="alert_box" class="alert alert-success  fade " style="display: none;">
  <strong id="msg_head"></strong><p id="msg_txt"></p>
  <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-3">
      <p>
        <input type="radio" name="search_condit" id="search_date" onclick="search_con()"  value="1" checked/> ECN Create Date
      <input type="text" name="daterange"  id="daterange"  value="<?=date("d/m/Y", strtotime('-30 days')) . ' - ' . date("d/m/Y");?>" class="form-control" />
      </p>
      <p>
        <input type="radio" name="search_condit" id="search_part_no" onclick="search_con()" value="2" /> Part No
      <input type="text" name="part_no_search" id="part_no_search"  class="form-control"  />
      </p>

      <div class="col-md-10">
<div id="loading-progress" class="loading-progress" style="display: none;"></div>
</div>
      </div>
      <div class="col-md-3">
      <p>
            <input type="radio" name="search_condit" id="search_status" onclick="search_con()" value="3" /> ECN Status
            <select class="form-control" name="ecn_status" id="ecn_status"  required>
                  <?php include 'utility/ecn_status.php';?>
            </select>
      </p>
      <p>
          <button class="btn btn-info" onclick="search_submit()"> Search</button>
      </p>
      </div>

      <div class="col-md-6 text-right">

        <button class="btn btn-success"onclick="location.href='ecn_create.php';">Create new</button>
        <button class="btn btn-primary"onclick="location.href='../../file_import/ecn/ecn_import_template_updated_24072019.xlsx';">Load Template</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#import_excel_modal">Import Excel</button>
      <button class="btn btn-primary"  onclick="export_excel()" >Export Excel</button>
      <!-- <a href="ajax/ecn_export.php"  class="btn btn-info" download>Download!</a> -->

      </div>
    </div>        
  </div>
<!-- end card header -->
  <!-- <div class="card-body">
    <div class="col-md-12">
    
    </div>
  </div> -->
</div>
      <div id="detail"></div>
        
<!-- end card -->

<?php   require '../layout/footer.php';?>
<?php   require 'modal/import_excel_modal.php';?>
<?php   require 'modal/export_excel_modal.php';?>
<script src='js/ecn_table.js'></script>