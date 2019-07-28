<?php
  
if (isset($_POST['m_id'])) {
    require '../../00_config/connect.php';//db connect
    session_start();
 $TABLE_NAME = "00_module";
  $module_id = htmlspecialchars($_POST['m_id']);
  $module_name = htmlspecialchars($_POST['m_name']);
  $user_update = $_SESSION['user_name'];
 
  $date_today = date('Y-m-d H:i:s');
    try {
      $datalist =[
        "module_id"        => $module_id,
        "module_name"        => $module_name,
        "module_updated_by"        => $user_update,
        "module_updated_date"        => $date_today
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET module_name = :module_name,
              module_updated_by = :module_updated_by,
              module_updated_date = :module_updated_date
              WHERE module_id = :module_id";
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