<?php
  
if (isset($_POST['module_id'])) {
    require '../../00_config/connect.php';//db connect
    session_start();
 $TABLE_NAME = "00_menu";
  $module_id = htmlspecialchars($_POST['module_id']);
  $menu_name = htmlspecialchars($_POST['menu_name']);
  $menu_id = htmlspecialchars($_POST['menu_id']);
  $user_update = $_SESSION['user_name'];
 
  $date_today = date('Y-m-d H:i:s');
    try {
        $sql = "UPDATE $TABLE_NAME 
        SET menu_name = '$menu_name',
        module_id = '$module_id',
        menu_updated_by = '$user_update',
        menu_updated_date = '$date_today'
        WHERE menu_id = '$menu_id' ";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        echo "success";
    } catch(PDOException $error) {
        echo "error";
      }
   }
  $pdo = null;
?>