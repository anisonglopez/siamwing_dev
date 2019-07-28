
         
          $( "form" ).on( "submit", function( event ) {
            var alert_box = document.getElementById("alert_box");
            var msg_head = document.getElementById("msg_head");
            var msg_txt = document.getElementById("msg_txt");
            event.preventDefault();
            var form = $(this);
          //console.log( $( this ).serialize() );
          $.ajax({
                   type: "POST",
                   url: "ajax/mail_update.php",
                   data: form.serialize(), // serializes the form's elements.
                   success: function(data)
                   {
                     //console.log(data);
                        if(data == 'error'){
                            alert_box.className = 'alert alert-danger alert-dismissible fade show';
                            msg_head.innerHTML= 'Error !!';
                            msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
                        }else if(data == 'success'){
                            alert_box.className = 'alert alert-success alert-dismissible fade show';
                            msg_head.innerHTML= 'Success !!';
                            msg_txt.innerHTML= 'บันทึกข้อมูลสำเร็จ';
                        }else if(data == 'danger'){
                            alert_box.className = 'alert alert-danger alert-dismissible fade show';
                            msg_head.innerHTML= 'Error !!';
                            msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ';
                        }
                   }
                 });
        
        });