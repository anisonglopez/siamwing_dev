<?php   
$title = "Department";
require '../layout/header.php';
try{
  $statement = $pdo->prepare("SELECT * FROM 00_department
   WHERE dep_trash = 0");
  $statement->execute();
  $result = $statement->fetchAll();
} //try
catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
}
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Department</h1>
          <!-- Page Content -->
          <hr>
  <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 m-0 font-weight-bold text-primary">
          จัดการข้อมูลแผนก
      </div>
      <div class="col-md-6 text-right">
        <button class="btn btn-success" onclick="location.href='dep_create.php';">Create new</button>
        
      </div>
    </div>        
  </div>
<!-- end card header -->
<div class="table-responsive">
  <div class="card-body">
    <div class="col-md-12">
      <table class="table table-hover table-sm small" id="dataTable">
        <thead class="bg-info text-white">
          <tr>
            <th>Dept. Code</th>
            <th>ชื่อแผนกlasdlasd</th>
            <th>Noteกกก</th>
            <th>Status</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
              <?php foreach ($result as $row) : ?>
                  <tr id="<?php echo ($row["dep_id"]); ?>">
                    <td><?php echo ($row["dep_id"]); ?></td>
                    <td><?php echo ($row["dep_name"]); ?></td>
                    <td><?php echo ($row["dep_note"]); ?></td>
                    <td class="text-center"><?php echo  ($row["dep_active"] == 1? '<span class="fas fa-check-circle fa-fw" style="color: green;"></span>' : '<span class="fas fa-minus-circle fa-fw" style="color: red;"></span>'); ?></td>
                    <td class="text-center"><a href="dep_change.php?id=<?php echo base64_encode($row["dep_id"]); ?>" class="btn btn-outline-warning btn-sm"><span class="fas fa-edit fa-fw"></span></a> 
                    <!-- <a id="button"  href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='dep_delete.php?id=<?php echo base64_encode($row["dep_id"]);?>';}"  class="btn btn-outline-danger btn-sm"><span class="fas fa-trash fa-fw"></span></a> -->
                    <button id="<?php echo ($row["dep_id"]); ?>"    class="btn btn-outline-danger btn-sm btndelete" ><span class="fas fa-trash fa-fw"></span></button>
                  </td>
                  </tr>
                  <?php endforeach; ?>
          </tbody>
      </table>
    </div>
    </div>
  </div>
</div>
              <!-- end card -->
   <div id="alert_box" class="alert alert-success alert-dismissible fade "   role="alert">
  <strong id="msg_head"></strong><p id="msg_txt"></p>
</div>
<?php   require '../layout/footer.php';?>
<script src="dep.js"></script>