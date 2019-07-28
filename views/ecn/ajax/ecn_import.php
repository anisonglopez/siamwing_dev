<?php 
sleep(1);
session_start();
require '../../00_config/connect.php';
$data =( $_POST['Exceldata']);
$TABLE_NAME = "30_ecn";
date_default_timezone_set("Asia/Bangkok");
$date_today = date('Y-m-d H:i:s');
$user_update = $_SESSION['user_name'];
try{
   foreach ($data as $rows) :
    $created_date = DateTime::createFromFormat("d/m/Y" , $rows['created_date']) ;
    $eff_date = DateTime::createFromFormat("d/m/Y" , $rows['eff_date']) ;
    $first_deliver = empty($_POST['first_deliver']) ? '01/01/1970' : $_POST['first_deliver'];
    $first_deliver = DateTime::createFromFormat("d/m/Y" , $first_deliver);
       $datalist =[
        "ecn_no"        => htmlspecialchars($rows['ecn_no']),
        "created_date"        => $created_date->format('Y-m-d'),
        "buddle_code"        => htmlspecialchars($rows['buddle_code']),
        "minor"        => htmlspecialchars($rows['minor']),
        "part_no_old"        => htmlspecialchars($rows['part_no_old']),
        "part_name_old"        => htmlspecialchars($rows['part_name_old']),
        "part_no_new"        => htmlspecialchars($rows['part_no_new']),
        "part_name_new"        => htmlspecialchars($rows['part_name_new']),
        "ac"        => htmlspecialchars($rows['ac']),
        "model_concern"        => htmlspecialchars($rows['model_concern']),
        "reason"        => htmlspecialchars($rows['reason']),
        "wh_m"        => htmlspecialchars($rows['wh_m']),
        "sn_break_condit"        => htmlspecialchars($rows['sn_break_condit']),
        "sn_break"        => htmlspecialchars($rows['sn_break']),
        "eff"        => htmlspecialchars($rows['eff']),
        "eff_date"        => $eff_date->format('Y-m-d'),
        "ecn_status"        => htmlspecialchars($rows['ecn_status']),
        "dwg"        => htmlspecialchars($rows['dwg']),
        "stock_sup"        => htmlspecialchars($rows['stock_sup']),
        "cost_sup"        => htmlspecialchars($rows['cost_sup']),
        "qa_audit"        => htmlspecialchars($rows['qa_audit']),
        "sp_req"        => htmlspecialchars($rows['sp_req']),
        "buyer"        => htmlspecialchars($rows['buyer']),
        "sup"        => htmlspecialchars($rows['sup']),
        "first_po"        => htmlspecialchars($rows['first_po']),
        "first_deliver"        => $first_deliver->format('Y-m-d'),
        "remark"        => htmlspecialchars($rows['remark']),
        "ecn_created_by"        => $user_update,
        "ecn_created_date"        => $date_today,
        "ecn_updated_by"        => $user_update,
        "ecn_updated_date"        => $date_today
      ];
      $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        "$TABLE_NAME",
        implode(", ", array_keys($datalist)),
        ":" . implode(", :", array_keys($datalist))
);
      $stmt = $pdo->prepare($sql);
      $stmt->execute($datalist);
endforeach;
   echo 'บันทึกข้อมูลสำเร็จ';
}
catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
}
$pdo = null;
?>