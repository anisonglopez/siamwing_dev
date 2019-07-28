


      // Call the dataTables jQuery plugin
      $(document).ready(function() {
        var alert_box = document.getElementById("alert_box");
        var msg_head = document.getElementById("msg_head");
        var msg_txt = document.getElementById("msg_txt");
    
      var table = $('#dataTable').DataTable();
    $('#dataTable tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
          } );
        $('#dataTable tbody').on( 'click', '.btndelete', function () {
    
          var _id = this.id;
          var result = confirm("Want to delete?");
            if (result) {
              table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
              $.ajax({
               type: "POST",
               url: "ajax/dep_delete.php",
               data:{_id:_id},
               success: function(data)
               {
                 console.log(data);
                    if(data == 'error'){
                        alert_box.className = 'alert alert-danger alert-dismissible fade show';
                        msg_head.innerHTML= 'Error !!';
                        msg_txt.innerHTML= 'พบปัญหา ไม่สามารถลบข้อมูลได้ กรูราติดต่อเจ้าหน้าที่ ที่เกี่ยวข้อง';
                    }else{
                        alert_box.className = 'alert alert-success alert-dismissible fade show';
                        msg_head.innerHTML= 'Success !!';
                        msg_txt.innerHTML= 'ลบข้อมูล '+ _id + ' สำเร็จ';
                    }
               }
             });
            }
          
    } );
    });