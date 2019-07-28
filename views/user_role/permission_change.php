<?php   
$title = "Change ECN";
require '../layout/header.php';
$tbl_module = '00_module';
$tbl_menu = '00_menu';
$tbl_role = '01_role';
$tbl_role_menu = '01_role_menu';
if (isset($_GET['id'])) {
    $role_id =  base64_decode($_GET['id']);
    try{
        $statement = $pdo->prepare("SELECT * FROM $tbl_role
         WHERE role_id  = '$role_id' AND role_trash = 0 ");
        $statement->execute();
        $result = $statement->fetchAll();
        //echo $result ;
        if(empty($result )){exit;}
        foreach ($result as $row) :
           $role_id = $row['role_id'];
           $role_name =$row['role_name'];
           $role_note =$row['role_note'];
           $role_active =$row['role_active'];
        endforeach;

        $statement = $pdo->prepare("SELECT $tbl_module.* , $tbl_menu.*  FROM $tbl_module
        JOIN $tbl_menu ON $tbl_module.module_id = $tbl_menu.module_id
        WHERE module_trash = 0 AND menu_trash = 0");
       $statement->execute();
       $result = $statement->fetchAll();

       $statement = $pdo->prepare("SELECT 01_role_menu.*, 00_menu.module_id  FROM 01_role_menu 
       LEFT JOIN 00_menu ON 00_menu.menu_id = 01_role_menu.menu_id 
       WHERE role_id = '$role_id' ");
      $statement->execute();
      $result_role_chk = $statement->fetchAll();
      $role_menu_chk = array();
      foreach ($result_role_chk as $row) :
        $role_menu_chk[] = $row['menu_id'];
     endforeach;
    //  var_dump($role_menu_chk);
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
         <h1 class="h3 mb-4 text-gray-800">Create Permission</h1>
          <!-- Page Content -->
          <hr>
          
   <div id="alert_box" class="alert alert-success  fade " style="display: none;">
  <strong id="msg_head"></strong><p id="msg_txt"></p>
  <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<form method="post">
  <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 m-0 font-weight-bold text-primary">
          สร้างข้อมูลสิทธิ์การใช้งาน
      </div>
      <div class="col-md-6 text-right">
      <button  type="reset" class="btn btn-facebook" onclick="location.href='permission.php';">Back</button>
          <button  id='save' type="submit" class="btn btn-success">Save</button>
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
                
                <div class="form-group row">
                      <label for="role_id" class="col-sm-2 col-form-label">Group Code  : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                      <input type="text" name="role_id" id="role_id"  value="<?= $role_id?>" readonly class="form-control" required autocomplete="off" maxlength="10">
                    </div>
                    </div>

                       <div class="form-group row">
                      <label for="role_name" class="col-sm-2 col-form-label">Group Name : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" name="role_name" id="role_name" value="<?= $role_name?>" class="form-control" required autocomplete="off" >
                    </div>
                    </div>

                        <div class="form-group row">
                      <label for="menu_name" class="col-sm-2 col-form-label">Note : </label>
                      <div class="col-sm-8">
                      <textarea name="role_note" rows="4" cols="50" class="form-control"><?= $role_note?></textarea>
                    </div>
                    </div>

                      <div class="form-group row">
                      <label for="menu_name" class="col-sm-2 col-form-label">Active : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                      <select class="form-control" name="role_active" id="role_active" required>
                              <option value="">Select</option>
                                        <option value="1" <?= $role_active === "1" ? 'selected' : null; ?>>Active</option>
                                        <option value="0" <?= $role_active === "0" ? 'selected' : null; ?>>Unactive</option>
                              </select>
                    </div>
                    </div>

<div class="table-responsive">
                      <div class="form-group row">
                            <table class="table small">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>Select</th>
                                    <th>Module Id</th>
                                    <th>Module Name</th>
                                    <th>Menu Id</th>
                                    <th>Menu Name</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($result as $row) : ?>
                                    <tr id="<?php echo ($row["menu_id"]); ?>">
                                        <td><input type="checkbox" name="chkb[]" value="<?= $row['menu_id']?>" <?= (in_array($row['menu_id'], $role_menu_chk)) ? 'checked' : null; ?>/></td>
                                        <td><?php echo ($row["module_id"]); ?></td>
                                        <td><?php echo ($row["module_name"]); ?></td>
                                        <td><?php echo ($row["menu_id"]); ?></td>
                                        <td><?php echo ($row["menu_name"]); ?></td>
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
</form>
              <!-- end card -->
<?php   require '../layout/footer.php';?>
<script src="js/permission_create.js"></script>
