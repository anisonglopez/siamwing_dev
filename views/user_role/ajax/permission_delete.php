<?php
if (isset($_POST['_id'])) {
    require '../../00_config/connect.php';//db connect
$tbl_role = "01_role";
 $tbl_role_menu = "01_role_menu";
 try {

    $_id = $_POST['_id'];
    echo $_id;
    $datalist =[
        "role_id"        =>   $_id
      ];
      $sql = "DELETE FROM $tbl_role_menu 
              WHERE role_id = :role_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);

    $sql = "DELETE FROM $tbl_role 
              WHERE role_id = :role_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
    
    echo 'success';
  } catch(PDOException $error) {
    echo 'error';
  }
  $pdo = null;
}
?>