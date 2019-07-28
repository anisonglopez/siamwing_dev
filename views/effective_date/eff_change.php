<?php   

$title = "Edit Effective Date";
$tbl_eff_exp = "00_eff_exp_date";
require '../layout/header.php';

if (isset($_GET['id'])) {
    $id =  base64_decode($_GET['id']);
    try{
        $statement = $pdo->prepare("SELECT * FROM $tbl_eff_exp
         WHERE eff_exp_id  = $id ");
        $statement->execute();
        $result = $statement->fetchAll();
        // echo $result ;
        if(empty($result )){exit;}
        foreach ($result as $row) :
            $eff_exp_date_int = $row["eff_exp_date_int"];
            $eff_exp_remark = $row["eff_exp_remark"];
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
          <h1 class="h3 mb-4 text-gray-800">Edit Effective Date</h1>
          <!-- Page Content -->
          <hr>
          <form method="post">
  <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 m-0 font-weight-bold text-primary">
          แก้ไขข้อมูล Effective Date
      </div>
      <div class="col-md-6 text-right">
      <button  type="reset" class="btn btn-facebook" onclick="location.href='eff.php';">Back</button>
      <button type="submit" class="btn btn-success" >Update</button>
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
                                      <!--id-->
                    <input type="hidden" name="eff_exp_id" value="<?=$id?>"/>

                       <div class="form-group row">
                      <label for="eff_exp_date_int" class="col-sm-2 col-form-label">จำนวนวัน : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="number" name="eff_exp_date_int" id="eff_exp_date_int" value="<?=$eff_exp_date_int?>" class="form-control" required autocomplete="off" >
                    </div>
                    </div>

                        <div class="form-group row">
                      <label for="eff_exp_remark" class="col-sm-2 col-form-label">หมายเหตุ : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" name="eff_exp_remark" id="eff_exp_remark" value="<?=$eff_exp_remark?>" class="form-control" required autocomplete="off">
                    </div>
                    </div>

                    
    </div>
  </div>
</div>
</form>
<div id="alert_box" class="alert alert-success alert-dismissible fade "   role="alert">
  <strong id="msg_head"></strong><p id="msg_txt"></p>
</div>
              <!-- end card -->
<?php   require '../layout/footer.php';?>
<script>
    $( "form" ).on( "submit", function( event ) {
    var alert_box = document.getElementById("alert_box");
    var msg_head = document.getElementById("msg_head");
    var msg_txt = document.getElementById("msg_txt");
    event.preventDefault();
    var form = $(this);
   //console.log( $( this ).serialize() );
  $.ajax({
           type: "POST",
           url: "ajax/eff_update.php",
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
            // console.log(data );
                if(data == 'error'){
                    alert_box.className = 'alert alert-danger alert-dismissible fade show';
                    msg_head.innerHTML= 'Error !!';
                    msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ ';
                }else if (data == 'success'){
                    alert_box.className = 'alert alert-success alert-dismissible fade show';
                    msg_head.innerHTML= 'Success !!';
                    msg_txt.innerHTML= 'บันทึกข้อมูลสำเร็จ';
                }
           }
         });

});
      </script>
