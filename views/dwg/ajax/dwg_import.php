<?php 
sleep(1);
session_start();
require '../../00_config/connect.php';
$data =( $_POST['Exceldata']);
$TABLE_NAME = "31_dwg_control";
date_default_timezone_set("Asia/Bangkok");
$date_today = date('Y-m-d H:i:s');
$user_update = $_SESSION['user_name'];
try{
   foreach ($data as $rows) :
    $pc_recive_date = DateTime::createFromFormat("d/m/Y" , $rows['pc_recive_date']) ;
    $distribute_date = DateTime::createFromFormat("d/m/Y" , $rows['distribute_date']) ;
       $datalist =[
        "dwg_no"        => htmlspecialchars($rows['dwg_no']),
        "minor"        => htmlspecialchars($rows['minor']),
        "part_name"        => htmlspecialchars($rows['part_name']),
        "memo_part_list"        => htmlspecialchars($rows['memo_part_list']),
        "qa_chart"        => htmlspecialchars($rows['qa_chart']),
        "part_dwg"        => htmlspecialchars($rows['part_dwg']),
        "gen_dwg"        => htmlspecialchars($rows['gen_dwg']),
        "mat_dwg"        => htmlspecialchars($rows['mat_dwg']),
        "pages"        => htmlspecialchars($rows['pages']),
        "remark"        => htmlspecialchars($rows['remark']),
        "pc_recive_date"        => $pc_recive_date->format('Y-m-d'),
        "distribute_date"        => $distribute_date->format('Y-m-d'),
        "remark"        => htmlspecialchars($rows['remark']),
        "dwg_created_by"        => $user_update,
        "dwg_created_date"        => $date_today,
        "dwg_updated_by"        => $user_update,
        "dwg_updated_date"        => $date_today
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