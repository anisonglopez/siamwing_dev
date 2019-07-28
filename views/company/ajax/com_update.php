<?php
if (isset($_POST['com_id'])) {
    //echo $pdo;
    session_start();
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "00_company";
 $com_id = $_POST['com_id'];
 $com_name = $_POST['com_name'];
 $com_address = $_POST['com_address'];
 $com_remark = $_POST['com_remark'];

 $user_update = $_SESSION['user_name'];
 $date_today = date('Y-m-d H:i:s');
 try {
    $datalist =[
        "com_id"        =>   $com_id,
        "com_name"        =>   $com_name,
        "com_address"        => $com_address,
        "com_remark"        => $com_remark,
        "com_updated_by" =>  $user_update,
        "com_updated_date" =>  $date_today
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET com_name = :com_name,
              com_address = :com_address,
              com_remark = :com_remark,
              com_updated_by = :com_updated_by,
              com_updated_date = :com_updated_date
              WHERE com_id = :com_id";
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