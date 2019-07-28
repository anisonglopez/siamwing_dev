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
        $dwg_id = $_POST['dwg_id'];
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
          "dwg_updated_by"        => $user_update,
          "dwg_updated_date"        => $date_today
        ];
$sql = "UPDATE $TABLE_NAME 
                  SET dwg_no = :dwg_no,
                  minor = :minor,
                  part_name = :part_name,
                  memo_part_list = :memo_part_list,
                  qa_chart = :qa_chart,
                  part_dwg = :part_dwg,
                  gen_dwg = :gen_dwg,
                  mat_dwg = :mat_dwg,
                  pages = :pages,
                  remark = :remark,
                  pc_recive_date = :pc_recive_date,
                  distribute_date = :distribute_date,
                  dwg_updated_by = :dwg_updated_by,
                  dwg_updated_date = :dwg_updated_date
                  WHERE dwg_id = $dwg_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($datalist);
                    $msg_status= 'success';
                    $msg_txt= 'อัปเดตข้อมูลสำเร็จ';
    }catch (PDOException $e) {
        $msg_status= 'error';
        $msg_txt=  "Error!: " . $e->getMessage();
    }//end catch
    $data = [ "msg_status"=> $msg_status,
    "msg_txt" => $msg_txt
];
    echo json_encode($data);
}
?>