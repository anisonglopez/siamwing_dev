<?php   
$title = "E-mail Configuration";
require '../layout/header.php';
try{
  $statement = $pdo->prepare("SELECT * From 00_mail_config WHERE mail_id = 'mail_cf_pk' ");
  $statement->execute();
  $result = $statement->fetchAll();
  foreach ($result as $row) :
    $mail_to = $row['mail_to'];
    $mail_from = $row['mail_from'];
    $subject = $row['subject'];
    $description = $row['description'];
    $footer = $row['footer'];
endforeach;
} //try
catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
}

?>

          <!-- Page Content -->
          <h2>E-mail Configuration</h2>
          <hr>
          <form method="post" id="dep_form">
          <div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 m-0 font-weight-bold text-primary">

      </div>
      <div class="col-md-6 text-right">
      <button type="submit" class="btn btn-success" >Update</button>
      </div>
    </div>        
  </div>
<!-- end card header -->
<div class="card-body">
    <div class="col-md-12">
                <div class="form-group row">
                      <label  class="col-sm-2 col-form-label">To : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" name="mail_to" value="<?=$mail_to?>" class="form-control" required autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group row">
                      <label  class="col-sm-2 col-form-label">From : </label>
                      <div class="col-sm-8">
                        <input type="text" name="mail_from" value="<?=$mail_from?>" class="form-control"  autocomplete="off">
                    </div>
                    </div>

                   <div class="form-group row">
                      <label  class="col-sm-2 col-form-label">Subject : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" name="subject" value="<?=$subject?>" class="form-control" required  autocomplete="off">
                    </div>
                    </div>

                   <div class="form-group row">
                      <label  class="col-sm-2 col-form-label">Description (เพิ่มเติม) : </label>
                      <div class="col-sm-8">
                      <textarea name="description" rows="5"  class="form-control"><?=$description?></textarea>
                    </div>
                    </div>

                   <div class="form-group row">
                      <label  class="col-sm-2 col-form-label">Footer : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                      <textarea name="footer" rows="5"  class="form-control"><?=$footer?></textarea>
                        
                    </div>
                    </div>
        </div>
    </div>
    </div>
    </form>
    <div id="alert_box" class="alert alert-success alert-dismissible fade "   role="alert">
  <strong id="msg_head"></strong><p id="msg_txt"></p>
</div>

<?php   require '../layout/footer.php';?>
<script src="js/mail_config.js"></script>