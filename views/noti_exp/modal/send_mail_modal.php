<style>
@media (min-width: 576px){
    .modal-dialog {
        max-width: 700px;
        margin: 1.75rem auto;
    }
}
label.col-form-label{
    text-align: right;
}
</style>
<!-- UserProfile msgbox Modal-->
<div class="modal fade" id="send_mail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> ส่งอีเมลแบบ Manual</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <?php
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
        <form method="post">
                <div class="modal-body">           
                        <div class="modal-body small" >

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">To : <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="mail_to" value="<?=$mail_to?>" class="form-control form-control-sm" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                      <label  class="col-sm-3 col-form-label">From : </label>
                      <div class="col-sm-9">
                        <input type="text" name="mail_from" value="<?=$mail_from?>" class="form-control form-control-sm"  autocomplete="off">
                    </div>
                    </div>

                   <div class="form-group row">
                      <label  class="col-sm-3 col-form-label">Subject : <span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        <input type="text" name="subject" value="<?=$subject?>" class="form-control form-control-sm" required  autocomplete="off">
                    </div>
                    </div>

                   <div class="form-group row">
                      <label  class="col-sm-3 col-form-label">Description (เพิ่มเติม) : </label>
                      <div class="col-sm-9">
                      <textarea name="description" rows="5"  class="form-control form-control-sm"><?=$description?></textarea>
                    </div>
                    </div>
                               <?php 
                                          try{
                                            $date_yesterday = date("Y/m/d");
                                            $date_yesterday = date("Y/m/d", strtotime('-1 days'));
                                            $statement = $pdo->prepare("SELECT ecn_no From 30_ecn WHERE created_date = '$date_yesterday' ");
                                            $statement->execute();
                                            $result_ecn_create_date = $statement->fetchAll();
                                            // รายการ ecn ที่ใกล้หมด Effective date
                                        } //try
                                        catch (PDOException $e) {
                                            print "Error!: " . $e->getMessage() . "<br/>";
                                        }
                                        ?>
                    <div class="form-group row">
                      <label  class="col-sm-3 col-form-label">Detail : </label>
                      <div class="col-sm-9">
                                <p class="col-form-label">ระบบขอแจ้งให้ทราบว่า มีรายการ ECN รายการใหม่ 
                                ของวันที่ <?=date('d/m/Y',strtotime($date_yesterday))?>
                                จำนวน <?=count($result_ecn_create_date )?>  รายการ ดังนี้</p>
                              
                                        <ul class="list-group">
                                         <?php   
                                         $i = 1;
                                         foreach ($result_ecn_create_date as $row) : 
                                            $ecn_no_yesterday= $row['ecn_no'];
                                        ?>
                                            <li class="list-group-item"><?=$i.') '.$ecn_no_yesterday?></li>
                                         <?php 
                                         $i++;
                                        endforeach; 
                                        ?>
                                        </ul>
                                        <br> 

                                        <p>รายการ ECN ที่ใกล้ถึงเวลา Effective Date ใน <?=$eff_exp_date_int?> วัน จำนวน <?=count($result_noti) ?> รายการ ดังนี้</p>
                                        <ul class="list-group">
                                        <?php 
                                        $i = 1;
                                         foreach ($result_noti as $row) : 
                                            $ecn_no_eff= $row['ecn_no'];
                                            $ecn_eff_date= $row['eff_date'];
                                            $part_no_old= $row['part_no_old'];
                                            $part_no_new= $row['part_no_new'];
                                        ?>
                                            <li class="list-group-item"><?=$i.') '.$ecn_no_eff?>,  Effective Date : <?=date('d/m/Y' , strtotime($ecn_eff_date)) ?>, Part No Old : <?=$part_no_old?>, Part No New :  <?=$part_no_new?></li>
                                         <?php 
                                         $i++;
                                        endforeach; 
                                        ?>
                                        </ul>
                                        <br> 

                                        <!-- <p>รายการ ECN ที่เลยเวลา Effective Date  ของวันที่ <?=date('d/m/Y')?> มีรายการค้างอยู่ xx รายการ ดังนี้</p> -->
                    </div>
                    </div>

                   <div class="form-group row">
                      <label  class="col-sm-3 col-form-label">Footer : <span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                      <textarea name="footer" rows="5"  class="form-control form-control-sm"><?=$footer?></textarea>
                    </div>
                    </div>

                        </div>
                </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <button class="btn btn-success" type="submit" >ส่งอีเมล</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script>
$( "form" ).on( "submit", function( event ) {
    event.preventDefault();
    var form = $(this);
    console.log( $( this ).serialize() );
    $('#send_mail_modal').modal('hide');
    $('#mail_respond').modal('show');
  $.ajax({
           type: "POST",
           url: "../mail_send/mail_send.php",
        //    dataType: 'json',
           data: form.serialize(), // serializes the form's elements.
        beforeSend: function(jqXHR, settings) {
        $('#mail_respond_txt').html("กำลังส่งเมล ...");  
        },
           success: function(data)
           {
            document.getElementById("mail_respond_txt").innerHTML = data;
            // console.log(data);
           }
        //    ,
        //    error: function (jqXHR, exception) {
        //     document.write(exception);
        //     console.log(exception);}
         });
});

  </script>

      <!-- mail respond Modal-->
      <div class="modal fade" id="mail_respond" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ผลการส่งเมล</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="post"  >
             <div class="modal-body">        
            <div class="text-center">  
            <p id="mail_respond_txt"></p>                   
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>