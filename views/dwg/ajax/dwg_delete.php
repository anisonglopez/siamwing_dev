<?php
if (isset($_POST['_id'])) {
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "31_dwg_control";
 try {
    $dwg_id = $_POST['_id'];
    $datalist =[
        "dwg_id"        =>   $dwg_id
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET dwg_trash = 1
              WHERE dwg_id = :dwg_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
    echo 'success';
  } catch(PDOException $error) {
    echo 'error';
  }
  $pdo = null;
}
?>