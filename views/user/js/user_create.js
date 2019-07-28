    $( "form" ).on( "submit", function( event ) {
    var alert_box = document.getElementById("alert_box");
    var msg_head = document.getElementById("msg_head");
    var msg_txt = document.getElementById("msg_txt");
    event.preventDefault();
    var form = $(this);
  //console.log( $( this ).serialize() );
  $.ajax({
           type: "POST",
           url: "ajax/user_create.php",
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
                if(data == 'error'){
                    alert_box.className = 'alert alert-danger alert-dismissible fade show';
                    msg_head.innerHTML= 'Error !!';
                    msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ กรูณาติดต่อผู้ดูแลระบบ';
                }else if(data == 'success'){
                    alert_box.className = 'alert alert-success alert-dismissible fade show';
                    msg_head.innerHTML= 'Success !!';
                    msg_txt.innerHTML= 'บันทึกข้อมูลสำเร็จ';
                }else if(data == 'danger'){
                    alert_box.className = 'alert alert-danger alert-dismissible fade show';
                    msg_head.innerHTML= 'Error !!';
                    msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ เนื่องจากชื่อผู้ใช้งานซ้ำกับข้อมูลที่มีอยู่แล้วในระบบ';
                }
           }
         });

});
  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        function validateForm() {
            var user_password = document.getElementById("user_password").value;
            var user_repassword = document.getElementById("user_repassword").value;
            if (user_password == user_repassword) {
              return true;
            }
            else{
              alert("รหัสผ่านไม่ตรงกัน กรุณาระบุรหัสผ่านอีกครั้ง");
              return false;
            }
          }