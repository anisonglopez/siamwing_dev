<?php
if (isset($_POST['user_id'])) {
    if($_POST['user_password'] != $_POST['user_repassword']){
        echo "password";
        exit();
    }

    session_start();
   
    $date_today = date('Y-m-d H:i:s');
    $user_update = $_SESSION['user_name'];
    //echo $pdo;
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "01_user_profile";
 $user_id = ($_POST['user_id']);
 $hash_password= hash('sha256', $_POST['user_password']);
 $dep_id = ($_POST['dep_id']);
 $user_active = ($_POST['user_active']);
 $user_email = ($_POST['user_email']);
 $role_id = $_POST['role_id'];
 $user_lock = $_POST['user_lock'];
 $emp_name = $_POST['emp_name'];
 $emp_tel = $_POST['emp_tel'];

 try {
    $datalist =[
        "user_id"        =>   $user_id,
        "user_password"        =>   $hash_password,
        "emp_name"        =>   $emp_name,
        "emp_tel"        =>   $emp_tel,
        "dep_id"        =>   $dep_id,
        "user_active"        => $user_active,
        "user_email"        => $user_email,
        "role_id"        => $role_id,
        "user_lock"        => $user_lock,
        "user_updated_by" => $user_update,
        "user_updated_date" => $date_today
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET user_password = :user_password, 
              emp_name = :emp_name,
              emp_tel = :emp_tel,
              dep_id = :dep_id,
              user_active = :user_active,
              user_email = :user_email,
              role_id = :role_id,
              user_lock = :user_lock,
              user_updated_by = :user_updated_by,
              user_updated_date = :user_updated_date
              WHERE user_id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
    echo 'success';
  } catch(PDOException $error) {
    echo 'error';
    //echo  "Error Cannot Delete" . $sql . "<br>" . $error->getMessage();
    //   $alert_class = "alert-danger ";
    //   /echo "error";
  }
  $pdo = null;
}
?>