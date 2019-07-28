<?php
if (isset($_POST['mail_to'])) {
    require '../../00_config/connect.php';//db connect
    session_start();
 $TABLE_NAME = "00_mail_config";
  $mail_to = htmlspecialchars($_POST['mail_to']);
  $mail_from = htmlspecialchars($_POST['mail_from']);
  $subject = htmlspecialchars($_POST['subject']);
  $description = htmlspecialchars($_POST['description']);
  $footer = htmlspecialchars($_POST['footer']);
  $user_update = $_SESSION['user_name'];
 
  $date_today = date('Y-m-d H:i:s');
    try {
      $datalist =[
        "mail_to"        => $mail_to,
        "mail_from"        => $mail_from,
        "subject"        => $subject,
        "description"        => $description,
        "footer"        => $footer,
        "mail_updated_by"        => $user_update,
        "mail_updated_date"        => $date_today
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET mail_to = :mail_to,
              mail_from = :mail_from,
              subject = :subject,
              description = :description,
              footer = :footer,
              mail_updated_by = :mail_updated_by,
              mail_updated_date = :mail_updated_date
              WHERE mail_id = 'mail_cf_pk' ";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
        echo "success";

    } catch(PDOException $error) {
       echo  $alert_txt = "Error Cannot Insert" . $sql . "<br>" . $error->getMessage();
        $alert_class = "alert-danger ";
        echo "error";
      }
   }
   else{
    echo "danger";
   }
  $pdo = null;
?>