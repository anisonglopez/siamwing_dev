<?php
echo "hello";
if (isset($_POST['file_name'])) {
    require '../../00_config/connect.php';
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $date_today = date('Y-m-d H:i:s');
    $user_update = $_SESSION['user_name'];
    $file_name = $_POST['file_name'];
    $att_id = $_POST['att_id'];
    $tbl_attach = "30_ecn_attach";
    $path = "uploads/". $file_name;
    $flgDelete = unlink("$path");
    try {
        $sql = "DELETE FROM $tbl_attach 
                WHERE att_id = $att_id";
      $statement = $pdo->prepare($sql);
      $statement->execute();
      echo 'success';
    } catch(PDOException $error) {
      echo 'error';
    }
    if($flgDelete){
        echo "File Deleted";
          $pdo = null;
    }else{
        echo "File can not delete";
    }
}

?>