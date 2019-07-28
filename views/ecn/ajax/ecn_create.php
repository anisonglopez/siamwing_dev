<?php
require '../../00_config/connect.php';
session_start();
$msg_status = '';
$msg_txt = '';
$TABLE_NAME = '30_ecn';
date_default_timezone_set("Asia/Bangkok");
$date_today = date('Y-m-d H:i:s');

$created_date = DateTime::createFromFormat("d/m/Y" , $_POST['created_date']) ;
$eff_date = DateTime::createFromFormat("d/m/Y" , $_POST['eff_date']) ;
$first_deliver = DateTime::createFromFormat("d/m/Y" , $_POST['first_deliver']) ;
$supply_date = DateTime::createFromFormat("d/m/Y" , $_POST['supply_date']) ;
$ddate = DateTime::createFromFormat("d/m/Y" , $_POST['ddate']) ;
$user_update = $_SESSION['user_name'];
if (isset($_POST['created_date']) && empty($_POST['ecn_id'])) {
    try{
        $datalist =[
        //   "ecn_id"        =>   htmlspecialchars($_POST['ecn_id']),
          "ecn_no"        => htmlspecialchars($_POST['ecn_no']),
          "created_date"        => $created_date->format('Y-m-d'),
          "buddle_code"        => htmlspecialchars($_POST['buddle_code']),
          "minor"        => htmlspecialchars($_POST['minor']),
          "part_no_old"        => htmlspecialchars($_POST['part_no_old']),
          "part_name_old"        => htmlspecialchars($_POST['part_name_old']),
          "part_no_new"        => htmlspecialchars($_POST['part_no_new']),
          "part_name_new"        => htmlspecialchars($_POST['part_name_new']),
          "ac"        => htmlspecialchars($_POST['ac']),
          "model_concern"        => htmlspecialchars($_POST['model_concern']),
          "reason"        => htmlspecialchars($_POST['reason']),
          "service_part_com"        => htmlspecialchars($_POST['service_part_com']),
          "wh_m"        => htmlspecialchars($_POST['wh_m']),
          "prod_plan"        => htmlspecialchars($_POST['prod_plan']),
          "sn_break_condit"        => htmlspecialchars($_POST['sn_break_condit']),
          "sn_break"        => htmlspecialchars($_POST['sn_break']),
          "eff"        => htmlspecialchars($_POST['eff']),
          "eff_date"        => $eff_date->format('Y-m-d'),
          "ecn_status"        => htmlspecialchars($_POST['ecn_status']),
          "planing"        => htmlspecialchars($_POST['planing']),
          "warehouse"        => htmlspecialchars($_POST['warehouse']),
          "mange_stock"        => htmlspecialchars($_POST['mange_stock']),
          "supply_date"        => $supply_date->format('Y-m-d'),
          "serial_no"        => htmlspecialchars($_POST['serial_no']),
          "ddate"        => $ddate->format('Y-m-d'),
          "dwg"        => htmlspecialchars($_POST['dwg']),
          "stock_sup"        => htmlspecialchars($_POST['stock_sup']),
          "cost_sup"        => htmlspecialchars($_POST['cost_sup']),
          "qa_audit"        => htmlspecialchars($_POST['qa_audit']),
          "sp_req"        => htmlspecialchars($_POST['sp_req']),
          "buyer"        => htmlspecialchars($_POST['buyer']),
          "sup"        => htmlspecialchars($_POST['sup']),
          "first_po"        => htmlspecialchars($_POST['first_po']),
          "first_deliver"        => $first_deliver->format('Y-m-d'),
          "remark"        => htmlspecialchars($_POST['remark']),
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
    $ecn_id = $pdo->lastInsertId();
        $msg_status= 'success';
        $msg_txt= 'บันทึกข้อมูลสำเร็จ';
    }catch (PDOException $e) {
        $msg_status= 'error';
        $msg_txt=  "Error!: " . $e->getMessage();
    } // enc catch
    $data = [ "msg_status"=> $msg_status,
    "msg_txt" => $msg_txt,
    "id" => $ecn_id ,
    "ecn_encode" => base64_encode($ecn_id) ,
    "create_flg" => '1' ];
    echo json_encode($data);
} //end if


//update data with id
if (!empty($_POST['ecn_id'])) {
    try{
        $datalist =[
            "ecn_no"        => htmlspecialchars($_POST['ecn_no']),
            "created_date"        => $created_date->format('Y-m-d'),
            "buddle_code"        => htmlspecialchars($_POST['buddle_code']),
            "minor"        => htmlspecialchars($_POST['minor']),
            "part_no_old"        => htmlspecialchars($_POST['part_no_old']),
            "part_name_old"        => htmlspecialchars($_POST['part_name_old']),
            "part_no_new"        => htmlspecialchars($_POST['part_no_new']),
            "part_name_new"        => htmlspecialchars($_POST['part_name_new']),
            "ac"        => htmlspecialchars($_POST['ac']),
            "model_concern"        => htmlspecialchars($_POST['model_concern']),
            "reason"        => htmlspecialchars($_POST['reason']),
            "service_part_com"        => htmlspecialchars($_POST['service_part_com']),
            "wh_m"        => htmlspecialchars($_POST['wh_m']),
            "prod_plan"        => htmlspecialchars($_POST['prod_plan']),
            "sn_break_condit"        => htmlspecialchars($_POST['sn_break_condit']),
            "sn_break"        => htmlspecialchars($_POST['sn_break']),
            "eff"        => htmlspecialchars($_POST['eff']),
            "eff_date"        => $eff_date->format('Y-m-d'),
            "ecn_status"        => htmlspecialchars($_POST['ecn_status']),
            "planing"        => htmlspecialchars($_POST['planing']),
            "warehouse"        => htmlspecialchars($_POST['warehouse']),
            "mange_stock"        => htmlspecialchars($_POST['mange_stock']),
            "supply_date"        => $supply_date->format('Y-m-d'),
            "serial_no"        => htmlspecialchars($_POST['serial_no']),
            "ddate"        => $ddate->format('Y-m-d'),
            "dwg"        => htmlspecialchars($_POST['dwg']),
            "stock_sup"        => htmlspecialchars($_POST['stock_sup']),
            "cost_sup"        => htmlspecialchars($_POST['cost_sup']),
            "qa_audit"        => htmlspecialchars($_POST['qa_audit']),
            "sp_req"        => htmlspecialchars($_POST['sp_req']),
            "buyer"        => htmlspecialchars($_POST['buyer']),
            "sup"        => htmlspecialchars($_POST['sup']),
            "first_po"        => htmlspecialchars($_POST['first_po']),
            "first_deliver"        => $first_deliver->format('Y-m-d'),
            "remark"        => htmlspecialchars($_POST['remark']),
            // "ecn_created_by"        => $user_update,
            // "ecn_created_date"        => $date_today,
            "ecn_updated_by"        => $user_update,
            "ecn_updated_date"        => $date_today
          ];
            $ecn_id  =  htmlspecialchars($_POST['ecn_id']);
          $sql = "UPDATE $TABLE_NAME 
                  SET ecn_no = :ecn_no,
                  created_date = :created_date,
                  buddle_code = :buddle_code,
                  minor = :minor,
                  part_no_old = :part_no_old,
                  part_name_old = :part_name_old,
                  part_no_new = :part_no_new,
                  part_name_new = :part_name_new,
                  ac = :ac,
                  model_concern = :model_concern,
                  reason = :reason,
                  service_part_com = :service_part_com,
                  wh_m = :wh_m,
                  prod_plan = :prod_plan,
                  sn_break_condit = :sn_break_condit,
                  sn_break = :sn_break,
                  eff = :eff,
                  eff_date = :eff_date,
                  ecn_status = :ecn_status,
                  planing = :planing,
                  warehouse = :warehouse,
                  mange_stock = :mange_stock,
                  supply_date = :supply_date,
                  serial_no = :serial_no,
                  ddate = :ddate,
                  dwg = :dwg,
                  stock_sup = :stock_sup,
                  cost_sup = :cost_sup,
                  qa_audit = :qa_audit,
                  sp_req = :sp_req,            
                  buyer = :buyer,
                  sup = :sup,
                  first_po = :first_po,
                  first_deliver = :first_deliver,
                  remark = :remark,
                  wh_m = :wh_m,
                  ecn_updated_by = :ecn_updated_by,
                  ecn_updated_date = :ecn_updated_date
                  WHERE ecn_id = $ecn_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($datalist);
                    $msg_status= 'success';
                    $msg_txt= 'อัปเดตข้อมูลสำเร็จ';
    }catch (PDOException $e) {
        $msg_status= 'error';
        $msg_txt=  "Error!: " . $e->getMessage();
    }//end catch
    $data = [ "msg_status"=> $msg_status,
    "msg_txt" => $msg_txt,
    "id" => $ecn_id 
];
    echo json_encode($data);
}//end if

?>
