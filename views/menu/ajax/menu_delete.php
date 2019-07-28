<?php
if (isset($_POST['_id'])) {
    //echo $pdo;
    session_start();
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "00_menu";
 $user_update = $_SESSION['user_name'];

 $date_today = date('Y-m-d H:i:s');
 try {
    $menu_id = $_POST['_id'];
    $datalist =[
        "menu_id"        =>   $menu_id,
        "menu_updated_by"        =>   $user_update,
        "menu_updated_date"        =>   $date_today
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET menu_trash = 1,
              menu_updated_by = :menu_updated_by,
              menu_updated_date = :menu_updated_date
              WHERE menu_id = :menu_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
    echo 'success';
  } catch(PDOException $error) {
    echo 'error';
  }
  $pdo = null;
}
?>