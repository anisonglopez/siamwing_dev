<?php 
require "../../vendor/phpmailer/PHPMailerAutoload.php";
include "../00_config/connect.php";
include "../layout/config.php";
sleep(1);
// Give security access
set_time_limit(MAIL_TIMEOUT);
if(isset($_POST['mail_to'])){
    $mail_to = $_POST["mail_to"];
    $mail_from = $_POST["mail_from"];
    $subject = $_POST['subject'];
    $description = $_POST["description"];
    $footer = $_POST["footer"];
}else{
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
}
        try{
            $statement = $pdo->prepare("SELECT eff_exp_date_int FROM 00_eff_exp_date ");
            $statement->execute();
            $result_eff_exp_date = $statement->fetchAll();
            foreach ($result_eff_exp_date as $row) :
                $eff_exp_date_int = $row['eff_exp_date_int'];
            endforeach;
            // Get Notification Data
            $tbl_ecn= '30_ecn';
            $search_date_start = date("Y/m/d");
            $search_date_end = date("Y/m/d", strtotime('+'.$eff_exp_date_int.' days'));

        $statement = $pdo->prepare("SELECT *  FROM $tbl_ecn
        WHERE ecn_trash = 0 
        AND (eff_date  BETWEEN '$search_date_start' and '$search_date_end' 
        AND eff = 'Effective'  AND ecn_status = 'Follow_up')
        ");
        $statement->execute();
        $result_noti = $statement->fetchAll();
        } //try
        catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        }
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
header('Content-Type: text/html; charset=utf-8');
$mail = new PHPMailer;
$mail->CharSet = MAIL_CHARSET;
$mail->isSMTP();
$mail->Host =MAIL_HOST;
$mail->Port = MAIL_PORT;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->SMTPSecure = false;
//$mail->SMTPDebug = 1; //mailDebug 
 
// ตั้งค่าอนุญาตการใช้งานได้ที่นี่ https://myaccount.google.com/lesssecureapps?pli=1
 
$sender = $mail_from; // ชื่อผู้ส่ง
$email_sender = MAIL_SENDER_ADDRESS; // เมล์ผู้ส่ง 
$email_receiver = explode(',', $mail_to); // เมล์ผู้รับ ***
$mail->Username = MAIL_USR;
$mail->Password = MAIL_PWD;
$mail->setFrom($email_sender, $sender);
foreach($email_receiver as $email)
{
   $mail->addAddress($email);
   // เพิ่ม email Address
}
$mail->Subject = $subject . ' ประจำวันที่ ' .date('d/m/Y');;
 
$email_content =' 
<!DOCTYPE html>
<style>
font-family: "Prompt", sans-serif;
</style>


<html>
    <head>
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
        <meta charset=utf-8"/>
        <title> ECN Management</title>
    </head>
    <body style="position: absolute;
    width: 700px;">
        
        <div style="padding:20px;">
        <h1 style="background: #3b434c;padding: 10px 0 20px 10px;margin-bottom:10px;font-size:30px;color:white;" >
        ECN Management
        <hr>
    </h1>
            <div>
          
                <h2>  <strong style="color:#0e0e2f;">
                <p>เรียน : ทุกท่าน</p>
                <p>จาก : ระบบแจ้งเตือนอัตโนมัติ</p>
                </strong></h2>
                <p>'.nl2br($description).'</p>
                    <p>ระบบขอแจ้งให้ทราบว่า มีรายการ ECN รายการใหม่ ของวันที่ '.date("d/m/Y" , strtotime("-1days")).' จำนวน '.count($result_ecn_create_date ).'  รายการ ดังนี้</p>
                                        <ul class="list-group">';
                                        $i = 1;
                                        foreach ($result_ecn_create_date as $row) : 
                                        $ecn_no_yesterday= $row['ecn_no'];
                                        $email_content.='     
                                                    <li class="list-group-item">'.$i.')'. $ecn_no_yesterday.'</li>
                                                ';
                                        $i++;
                                            endforeach; 
                                        $email_content.='     
                                        </ul>
                                        <br> 
                                        <p>รายการ ECN ที่ใกล้ถึงเวลา Effective Date ในอีก '.$eff_exp_date_int.' วัน จำนวน '.count($result_noti).' รายการ ดังนี้</p>
                                        <ul class="list-group">';
                                        $i = 1;
                                        foreach ($result_noti as $row) : 
                                            $ecn_no_eff= $row['ecn_no'];
                                            $ecn_eff_date= $row['eff_date'];
                                            $part_no_old= $row['part_no_old'];
                                            $part_no_new= $row['part_no_new'];
                                            $email_content.='     
                                            <li class="list-group-item">'.$i.') '.$ecn_no_eff.',  Effective Date : '.date('d/m/Y' , strtotime($ecn_eff_date)).', Part No Old : '.$part_no_old.', Part No New :'.$part_no_new.'</li>
                                                ';
                                            $i++;
                                            endforeach; 
                                        $email_content.='    
                                             </ul>
                                        <br> 

                                        <!-- <p>รายการ ECN ที่เลยเวลา Effective Date  ของวันที่ 16/05/2019 มีรายการค้างอยู่ xx รายการ ดังนี้</p> -->
                    </div>
                    </div>

                    <p>'.nl2br($footer).'</p>

                       
        <div style="background: #3b434c;color: #a2abb7;padding:10px;">
            <div style="text-align:center"> 
             <span>Copyright &copy; ECN Management '.date('Y').' | v. '.$app['version'].' | Last update '.$app['updated'].'</span>
            </div>
        </div>
    </body>
</html>
';
//  ถ้ามี email ผู้รับ
if(!empty($email_receiver)){
    $mail->msgHTML($email_content);
    if (!$mail->send()) {  // สั่งให้ส่ง email
 
        // กรณีส่ง email ไม่สำเร็จ
        echo " ไม่สามารถส่งอีเมลหาผู้รับได้ โปรดติดต่อในภายหลัง";
        echo  $mail->ErrorInfo;
    }else{
        // กรณีส่ง email สำเร็จ
        echo '<h1 class="text-primary">ส่งอีเมลสำเร็จ</h1>';
        echo" ระบบได้ส่งข้อความไปเรียบร้อย";
    }   
}else{
    echo '<h1 class="text-danger">ไม่มีทีอีเมลผู้รับ</h1>';
    echo" กรุณาระบบอีเมลผู้รับ";
}
?>
