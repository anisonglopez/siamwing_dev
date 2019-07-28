<?php   
$title = "Change Company";
require '../layout/header.php';
if (isset($_GET['id'])) {
    $id =  base64_decode($_GET['id']);
    try{
        $statement = $pdo->prepare("SELECT * FROM 00_company WHERE com_id = '$id' ");
        $statement->execute();
        $result = $statement->fetchAll();
        //echo $result ;
        if(empty($result )){exit;}
        foreach ($result as $row) :
            $com_id = $row["com_id"];
            $com_name = $row["com_name"];
            $com_address = $row["com_address"];
            $com_remark = $row["com_remark"];
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
          <h1 class="h3 mb-4 text-gray-800">Change Company</h1>
          <!-- Page Content -->
          <hr>
          <form method="post" id="dep_form">
  <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 m-0 font-weight-bold text-primary">
          แก้ไขข้อมูลบริษัท
      </div>
      <div class="col-md-6 text-right">
      <button class="btn btn-facebook" onclick="location.href='company.php';">Back</button>
        <button class="btn btn-success" >Update</button>
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
                
                <div class="form-group row">
                      <label for="com_id" class="col-sm-2 col-form-label">com_id : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" name="com_id" id="com_id" value="<?=$com_id?>" class="form-control" required readonly>
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="com_name" class="col-sm-2 col-form-label">ชื่อบริษัท : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" name="com_name" id="com_name" value="<?=$com_name?>" class="form-control" required autocomplete="off">
                    </div>
                    </div>

                     <div class="form-group row">
                      <label for="com_address" class="col-sm-2 col-form-label">Address : </label>
                      <div class="col-sm-8">
                        <textarea name="com_address" rows="4" cols="50" class="form-control"><?=$com_address?></textarea>
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="com_remark" class="col-sm-2 col-form-label">Remark : </label>
                      <div class="col-sm-8">
                        <textarea name="com_remark" rows="4" cols="50" class="form-control"><?=$com_remark?></textarea>
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
//   console.log( $( this ).serialize() );
  $.ajax({
           type: "POST",
           url: "ajax/com_update.php",
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
                if(data == 'error'){
                    alert_box.className = 'alert alert-danger alert-dismissible fade show';
                    msg_head.innerHTML= 'Error !!';
                    msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ เนื่องจากรหัสแผนกซ้ำกับข้อมูลที่มีอยู่แล้วในระบบ';
                }else{
                    alert_box.className = 'alert alert-success alert-dismissible fade show';
                    msg_head.innerHTML= 'Success !!';
                    msg_txt.innerHTML= 'บันทึกข้อมูลสำเร็จ';
                }
           }
         });

});
      </script>
