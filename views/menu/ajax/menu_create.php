<?php

if (isset($_POST['menu_id'])) {
  session_start();
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "00_menu";
  $menu_id = htmlspecialchars($_POST['menu_id']);
  $menu_name = htmlspecialchars($_POST['menu_name']);
  $module_id = htmlspecialchars($_POST['module_id']);
  $user_update = $_SESSION['user_name'];
 
  $date_today = date('Y-m-d H:i:s');
    try {

      $datalist =[
        "menu_id"        => $menu_id,
        "module_id"        => $module_id,
        "menu_name"        => $menu_name,
        "menu_created_by"        => $user_update,
        "menu_created_date"        => $date_today,
        "menu_updated_by"        => $user_update,
        "menu_updated_date"        => $date_today
      ];
      $sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"$TABLE_NAME",
		implode(", ", array_keys($datalist)),
		":" . implode(", :", array_keys($datalist))
);
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
        echo "success";

    } catch(PDOException $error) {
        echo "error";
      }
   }
   else{
    echo "danger";
   }
  $pdo = null;
?>