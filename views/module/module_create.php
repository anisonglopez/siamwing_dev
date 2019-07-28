<?php   
$title = "Create Module";
require '../layout/header.php';
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Create Module</h1>
          <!-- Page Content -->
          <hr>
<form method="post">
  <!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 m-0 font-weight-bold text-primary">
          สร้างข้อมูลโมดูล
      </div>
      <div class="col-md-6 text-right">
      <button  type="reset" class="btn btn-facebook" onclick="location.href='module.php';">Back</button>
        <button type="submit" class="btn btn-success" >Save</button>
      </div>
    </div>        
  </div>
<!-- end card header -->
  <div class="card-body">
    <div class="col-md-12">
                
                <div class="form-group row">
                      <label for="m_id" class="col-sm-2 col-form-label">รหัสโมดูล  : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" name="m_id" id="m_id" value="" class="form-control" required maxlength="10">
                    </div>
                    </div>

                       <div class="form-group row">
                      <label for="m_name" class="col-sm-2 col-form-label">ชื่อโมดูล : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="text" name="m_name" id="m_name" value="" class="form-control" required autocomplete="off">
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
           url: "ajax/module_create.php",
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
                if(data == 'error'){
                    alert_box.className = 'alert alert-danger alert-dismissible fade show';
                    msg_head.innerHTML= 'Error !!';
                    msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ เนื่องจากรหัสโมดูลซ้ำกับข้อมูลที่มีอยู่แล้วในระบบ';
                }else if (data == 'success'){
                    alert_box.className = 'alert alert-success alert-dismissible fade show';
                    msg_head.innerHTML= 'Success !!';
                    msg_txt.innerHTML= 'บันทึกข้อมูลสำเร็จ';
                }
           }
         });

});
      </script>
