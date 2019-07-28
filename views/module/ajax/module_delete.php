<?php
if (isset($_POST['_id'])) {
    //echo $pdo;
    session_start();
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "00_module";
 $user_update = $_SESSION['user_name'];

 $date_today = date('Y-m-d H:i:s');
 try {
    $module_id = $_POST['_id'];
    $datalist =[
        "module_id"        =>   $module_id,
        "module_updated_by"        =>   $user_update,
        "module_updated_date"        =>   $date_today
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET module_trash = 1,
              module_updated_by = :module_updated_by,
              module_updated_date = :module_updated_date
              WHERE module_id = :module_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
    echo 'success';
  } catch(PDOException $error) {
    echo 'error';
  }
  $pdo = null;
}
?>