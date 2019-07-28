<?php
if (isset($_POST['user_name'])) {
    //echo $pdo;
    require '../../00_config/connect.php';//db connect
    session_start();
 $TABLE_NAME = "01_user_profile";
 $user_name = htmlspecialchars($_POST['user_name']);
  $st = $pdo->prepare("SELECT user_id FROM  $TABLE_NAME WHERE user_name=:user_name");
  $st->bindParam("user_name", $user_name,PDO::PARAM_STR);
  $st->execute();
  $count=$st->rowCount();
  if($count<1)
  {
  $user_name = htmlspecialchars($_POST['user_name']);
  $hash_password= hash('sha256', $_POST['user_password']);
  $dep_id = htmlspecialchars($_POST['dep_id']);
  $user_active = htmlspecialchars($_POST['user_active']);
  $user_email = htmlspecialchars($_POST['user_email']);
  $role_id = $_POST['role_id'];
  $user_lock = $_POST['user_lock'];
  $user_update = $_SESSION['user_name'];
  $emp_name = $_POST['emp_name'];
  $emp_tel = $_POST['emp_tel'];
    try {
     
      $date_today = date('Y-m-d H:i:s');
      $datalist =[
        "user_name"        => $user_name,
        "user_password"        => $hash_password,
        "emp_name"        => $emp_name,
        "emp_tel"        => $emp_tel,
        "dep_id"        => $dep_id,
        "role_id"        => $role_id,
        "user_email"        => $user_email,
        "user_active"        => $user_active,
        "user_lock"        => $user_lock,
        "user_created_by"        => $user_update,
        "user_created_date"        => $date_today,
        "user_updated_by"        => $user_update,
        "user_updated_date"        => $date_today
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
       echo  $alert_txt = "Error Cannot Insert" . $sql . "<br>" . $error->getMessage();
        $alert_class = "alert-danger ";
        echo "error";
      }
   }
   else{
    echo "danger";
   }
  $pdo = null;
}
?>