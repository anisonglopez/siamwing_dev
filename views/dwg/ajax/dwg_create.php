<?php
require '../../00_config/connect.php';
session_start();
$msg_status = '';
$msg_txt = '';
$TABLE_NAME = '31_dwg_control';
date_default_timezone_set("Asia/Bangkok");
$date_today = date('Y-m-d H:i:s');

$pc_recive_date = DateTime::createFromFormat("d/m/Y" , $_POST['pc_recive_date']) ;
$distribute_date = DateTime::createFromFormat("d/m/Y" , $_POST['distribute_date']) ;
$user_update = $_SESSION['user_name'];
if (isset($_POST['dwg_no'])) {
    try{
        $datalist =[
        //   "ecn_id"        =>   htmlspecialchars($_POST['ecn_id']),
          "dwg_no"        => htmlspecialchars($_POST['dwg_no']),
          "minor"        => htmlspecialchars($_POST['minor']),
          "part_name"        => htmlspecialchars($_POST['part_name']),
          "memo_part_list"        => htmlspecialchars($_POST['memo_part_list']),
          "qa_chart"        => htmlspecialchars($_POST['qa_chart']),
          "part_dwg"        => htmlspecialchars($_POST['part_dwg']),
          "gen_dwg"        => htmlspecialchars($_POST['gen_dwg']),
          "mat_dwg"        => htmlspecialchars($_POST['mat_dwg']),
          "pages"        => htmlspecialchars($_POST['pages']),
          "remark"        => htmlspecialchars($_POST['remark']),
          "pc_recive_date"        => $pc_recive_date->format('Y-m-d'),
          "distribute_date"        => $distribute_date->format('Y-m-d'),
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
    $dwg_id = $pdo->lastInsertId();
        $msg_status= 'success';
        $msg_txt= 'บันทึกข้อมูลสำเร็จ';
    }catch (PDOException $e) {
        $msg_status= 'error';
        $msg_txt=  "Error!: " . $e->getMessage();
    } // enc catch
    $data = [ "msg_status"=> $msg_status,
    "msg_txt" => $msg_txt,
    "dwg_encode" => base64_encode($dwg_id) ,
    "create_flg" => '1' ];
    echo json_encode($data);
} //end if


?>