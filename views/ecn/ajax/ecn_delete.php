<?php
if (isset($_POST['_id'])) {
    require '../../00_config/connect.php';//db connect
 $TABLE_NAME = "30_ecn";
 try {
    $ecn_id = $_POST['_id'];
    $datalist =[
        "ecn_id"        =>   $ecn_id
      ];
      $sql = "UPDATE $TABLE_NAME 
              SET ecn_trash = 1
              WHERE ecn_id = :ecn_id";
    $statement = $pdo->prepare($sql);
    $statement->execute($datalist);
    echo 'success';
  } catch(PDOException $error) {
    echo 'error';
  }
  $pdo = null;
}
?>