<?php
if (isset($_POST['dep_id'])) {
    //echo $pdo;
    session_start();
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "00_department";
 $dep_id = $_POST['dep_id'];
 $dep_name = $_POST['dep_name'];
 $dep_note = $_POST['dep_note'];
 $dep_active = $_POST['dep_active'];
 $user_update = $_SESSION['user_name'];

 $date_today = date('Y-m-d H:i:s');
 try {
    $datalist =[
        "dep_id"        =>   $dep_id,
        "dep_name"        =>   $dep_name,
        "dep_note"        => $dep_note,
        "dep_active"        => $dep_active,
        "dep_updated_by" =>  $user_update,
        "dep_updated_date" =>  $date_today
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET dep_name = :dep_name, 
              dep_note = :dep_note,
              dep_active = :dep_active,
              dep_updated_by = :dep_updated_by,
              dep_updated_date = :dep_updated_date
              WHERE dep_id = :dep_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
    echo 'success';
  } catch(PDOException $error) {
    echo 'error';
    //   echo  "Error Cannot Delete" . $sql . "<br>" . $error->getMessage();
    //   $alert_class = "alert-danger ";
    //   /echo "error";
  }
  $pdo = null;
}
?>