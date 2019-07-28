<?php
if (isset($_POST['_id'])) {
    //echo $pdo;
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "01_user_profile";
 try {
    $user_id = $_POST['_id'];
    $datalist =[
        "user_id"        =>   $user_id
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET user_trash = 1
              WHERE user_id = :user_id";
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