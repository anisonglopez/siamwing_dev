<?php
if (isset($_POST['_id'])) {
  session_start();
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "00_department";
 $user_update = $_SESSION['user_name'];

 $date_today = date('Y-m-d H:i:s');
 try {
    $dep_id = $_POST['_id'];
    $datalist =[
        "dep_id"        =>   $dep_id,
        "dep_updated_by" =>  $user_update,
        "dep_updated_date" =>  $date_today
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET dep_trash = 1,
              dep_updated_by = :dep_updated_by,
              dep_updated_date = :dep_updated_date
              WHERE dep_id = :dep_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
    echo 'success';
  } catch(PDOException $error) {
    echo 'error';
  }
  $pdo = null;
}
?>