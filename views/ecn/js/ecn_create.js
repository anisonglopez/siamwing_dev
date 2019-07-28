
$( "form.ecn" ).on( "submit", function( event ) {
    var alert_box = document.getElementById("alert_box");
    var msg_head = document.getElementById("msg_head");
    var msg_txt = document.getElementById("msg_txt");
    event.preventDefault();
    var form = $(this);
    // console.log( $( this ).serialize() );
  $.ajax({
           type: "POST",
           url: "ajax/ecn_create.php",
           dataType: 'json',
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
            $('#alert_box').show();
            document.getElementById("save").innerHTML = 'Update';
            console.log(data);
                if(data.msg_status == 'success'){
                    alert_box.className = 'alert alert-success alert-dismissible fade show';
                    msg_head.innerHTML= 'Success !!';
                    msg_txt.innerHTML= data.msg_txt;
                     document.getElementById("ecn_id").value = data.id;
                     if(data.create_flg == 1){
                        setTimeout(function(){
                            var ecn_id = data.ecn_encode
                            location.href = "ecn_change.php?id="+ ecn_id + "&flg=1";
                        }, 1000);     
                     }
                }else{
                    alert_box.className = 'alert alert-danger alert-dismissible fade show';
                    msg_head.innerHTML= 'Error !!';
                    msg_txt.innerHTML= 'พบปัญหา ไม่สามารถบันทึกข้อมูลได้ ' + data.msg_txt;
                }
           }
        //    ,
        //    error: function (jqXHR, exception) {
        //     document.write(exception);
        //     console.log(exception);
        // }
         });
});
$(function(){
    $("[data-hide]").on("click", function(){
        $(this).closest("." + $(this).attr("data-hide")).hide();
    });
});

$( "form.upload" ).on( "submit", function( event ) {
      event.preventDefault();
      var progress = $(".loading-progress").progressTimer({
        timeLimit: 20,
        onFinish: function () {
            $('#progressTimer').hide();
        }
    });
      var att_desc = document.getElementById("att_desc").value;
      var ecn_id = document.getElementById("ecn_id").value;
            // var form = $(this);
      // console.log( $( this ).serialize() );
      // const files = document.querySelector('[type=file]').files;
      // const url = 'file_upload/file_upload.php';
      // const formData = new FormData()
      // for (let i = 0; i < files.length; i++) {
      //   let file = files[i]
      //   formData.append('files[]', file)
      // }
      // fetch(url, {
      //   method: 'POST',
      //   body: formData,
      // }).then(response => {
      //   console.log(response)
      //   alert('response');
      // })
      var file_data = $('#file').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('files', file_data);
      form_data.append('att_desc', att_desc);
      form_data.append('ecn_id', ecn_id);                         
      $.ajax({
          url: 'file_upload/file_upload.php', // point to server-side PHP script 
          //dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data ,       
          type: 'post',
          success: function(data){
            progress.progressTimer('complete');
              //alert(data); // display response from the PHP script, if any
              $('#upload_response').html(data);      
              setTimeout(function(){
                location.reload();
            }, 1000);      
          } ,
           error: function (jqXHR, exception) {
            document.write(exception);
            console.log(exception);
            $('#upload_response').html(data); 
        }
       });
  });
  function delete_file(att_id,file_name) {
    var result = confirm("Want to delete?");
    event.preventDefault();
    if (result) {
        $.ajax({
            type: "POST",
            url: "file_upload/file_delete.php",
            // dataType: 'json',
            data: {att_id:att_id, file_name,file_name}, // serializes the form's elements.
            success: function(data)
            {
                        location.reload();
            }
            ,
            error: function (jqXHR, exception) {
             document.write(exception);
             console.log(exception);
         }
          });
    }
  }
