<?php
if (isset($_POST['com_name'])) {
  session_start();
    //echo $pdo;
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "00_company";
 $com_name = $_POST['com_name'];
 $com_address = $_POST['com_address'];
 $com_remark = $_POST['com_remark'];

 $user_update = $_SESSION['user_name'];

 $date_today = date('Y-m-d H:i:s');
 try {
    $datalist =[
      "com_name"        =>  $com_name,
      "com_address" => $com_address,
      "com_remark" => $com_remark,
      "com_created_by" =>  $user_update,
      "com_created_date" =>  $date_today,
      "com_updated_by" =>  $user_update,
      "com_updated_date" =>  $date_today
    ];
    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "$TABLE_NAME",
      implode(", ", array_keys($datalist)),
      ":" . implode(", :", array_keys($datalist))
);
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