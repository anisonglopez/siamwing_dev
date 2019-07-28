<?php

if (isset($_POST['m_id'])) {
  session_start();
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "00_module";
  $module_id = htmlspecialchars($_POST['m_id']);
  $module_name = htmlspecialchars($_POST['m_name']);
  $user_update = $_SESSION['user_name'];
 
  $date_today = date('Y-m-d H:i:s');
    try {

      $datalist =[
        "module_id"        => $module_id,
        "module_name"        => $module_name,
        "module_created_by"        => $user_update,
        "module_created_date"        => $date_today,
        "module_updated_by"        => $user_update,
        "module_updated_date"        => $date_today
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