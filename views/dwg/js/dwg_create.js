
$( "form.dwg" ).on( "submit", function( event ) {
    var alert_box = document.getElementById("alert_box");
    var msg_head = document.getElementById("msg_head");
    var msg_txt = document.getElementById("msg_txt");
    event.preventDefault();
    var form = $(this);
    console.log( $( this ).serialize() );
  $.ajax({
           type: "POST",
           url: "ajax/dwg_create.php",
           dataType: 'json',
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
            $('#alert_box').show();
            console.log(data);
                if(data.msg_status == 'success'){
                    alert_box.className = 'alert alert-success alert-dismissible fade show';
                    msg_head.innerHTML= 'Success !!';
                    msg_txt.innerHTML= data.msg_txt;
                     if(data.create_flg == 1){
                        setTimeout(function(){
                            var dwg_id = data.dwg_encode
                            location.href = "dwg_change.php?id="+ dwg_id + "&flg=1";
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