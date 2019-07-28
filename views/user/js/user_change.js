
         
          $( "form" ).on( "submit", function( event ) {
            var alert_box = document.getElementById("alert_box");
            var msg_head = document.getElementById("msg_head");
            var msg_txt = document.getElementById("msg_txt");
            var user_password = document.getElementById("user_password");
            var user_repassword = document.getElementById("user_repassword");
            event.preventDefault();
            var form = $(this);
          console.log( $( this ).serialize() );
          $.ajax({
                   type: "POST",
                   url: "ajax/user_update.php",
                   data: form.serialize(), // serializes the form's elements.
                   success: function(data)
                   {
                        if(data == 'error'){
                            alert_box.className = 'alert alert-danger alert-dismissible fade show';
                            msg_head.innerHTML= 'Error !!';
                            msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
                        }else if(data == 'success'){
                            alert_box.className = 'alert alert-success alert-dismissible fade show';
                            msg_head.innerHTML= 'Success !!';
                            msg_txt.innerHTML= 'บันทึกข้อมูลสำเร็จ';
                            user_password.value = '';
                            user_repassword.value = '';
                        }else if(data == 'danger'){
                            alert_box.className = 'alert alert-danger alert-dismissible fade show';
                            msg_head.innerHTML= 'Error !!';
                            msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ เนื่องจากชื่อผู้ใช้งานซ้ำกับข้อมูลที่มีอยู่แล้วในระบบ';
                        }else if(data == 'password'){
                            alert_box.className = 'alert alert-warning alert-dismissible fade show';
                            msg_head.innerHTML= 'Error !!';
                            msg_txt.innerHTML= 'รหัสผ่านไม่ตรงกัน';
                        }
                   }
                 });
        
        });