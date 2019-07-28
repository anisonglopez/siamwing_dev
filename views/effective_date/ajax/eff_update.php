<?php
if (isset($_POST['eff_exp_id'])) {
    require '../../00_config/connect.php';//db connect
    session_start();
 $TABLE_NAME = "00_eff_exp_date";
  $eff_exp_id = htmlspecialchars($_POST['eff_exp_id']);
  $eff_exp_date_int = htmlspecialchars($_POST['eff_exp_date_int']);
  $eff_exp_remark = htmlspecialchars($_POST['eff_exp_remark']);
  $user_update = $_SESSION['user_name'];
 
  $date_today = date('Y-m-d H:i:s');
    try {
        $sql = "UPDATE $TABLE_NAME 
        SET eff_exp_date_int = '$eff_exp_date_int',
        eff_exp_remark = '$eff_exp_remark',
        eff_updated_by = '$user_update',
        eff_updated_date = '$date_today'
        WHERE eff_exp_id = '$eff_exp_id' ";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        echo "success";
    } catch(PDOException $error) {
        echo "error";
      }
   }
  $pdo = null;
?>