<?php
if (isset($_POST['_id'])) {
  session_start();
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "00_company";
 $user_update = $_SESSION['user_name'];

 $date_today = date('Y-m-d H:i:s');
 try {
    $dep_id = $_POST['_id'];
    $datalist =[
        "com_id"        =>   $com_id,
        "com_updated_by" =>  $user_update,
        "com_updated_date" =>  $date_today
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET com_trash = 1,
              com_updated_by = :com_updated_by,
              com_updated_date = :com_updated_date
              WHERE com_id = :com_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
    echo 'success';
  } catch(PDOException $error) {
    echo 'error';
  }
  $pdo = null;
}
?>