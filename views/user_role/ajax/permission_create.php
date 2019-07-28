<?php 
    require '../../00_config/connect.php';
    session_start();
   
    $date_today = date('Y-m-d H:i:s');
    $user_update = $_SESSION['user_name'];
    $tbl_role = '01_role';
    $tbl_role_menu = '01_role_menu';
    $msg_status = '';
    $msg_txt = '';
if (isset($_POST['role_id'])) {
    $stmt = $pdo->prepare("SELECT *  FROM $tbl_role WHERE role_id=:role_id"); 
    $stmt->bindParam("role_id", $_POST['role_id'], PDO::PARAM_STR) ;
    $stmt->execute();
    $count=$stmt->rowCount();
    if($count){
        try{
        $datalist =[
             "role_id"        => htmlspecialchars($_POST['role_id']),
            "role_name"        => htmlspecialchars($_POST['role_name']),
            "role_note"        => htmlspecialchars($_POST['role_note']),
            "role_active"        => htmlspecialchars($_POST['role_active']),
            "role_updated_by"        => $user_update,
            "role_updated_date"        => $date_today
            ];
            $role_id = htmlspecialchars($_POST['role_id']);
            $sql = "UPDATE $tbl_role 
            SET   role_id = :role_id,
            role_name = :role_name,
            role_note = :role_note,
            role_active = :role_active,
            role_updated_by = :role_updated_by,
            role_updated_date = :role_updated_date
            WHERE role_id = '$role_id' ";
              $stmt = $pdo->prepare($sql);
              $stmt->execute($datalist);
              $msg_status= 'success';
              $msg_txt= 'บันทึกข้อมูลสำเร็จ';
        }catch (PDOException $e) {
            $msg_status= 'error';
            $msg_txt=  "Error!: " . $e->getMessage();
        } // enc catch
    }else{
        try{
            $datalist =[
            "role_id"        => htmlspecialchars($_POST['role_id']),
            "role_name"        => htmlspecialchars($_POST['role_name']),
            "role_note"        => htmlspecialchars($_POST['role_note']),
            "role_active"        => htmlspecialchars($_POST['role_active']),
            "role_created_by"        => $user_update,
            "role_created_date"        => $date_today,
            "role_updated_by"        => $user_update,
            "role_updated_date"        => $date_today
            ];
            $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "$tbl_role",
                implode(", ", array_keys($datalist)),
                ":" . implode(", :", array_keys($datalist))
        );
        $stmt = $pdo->prepare($sql);
        $stmt->execute($datalist);
        $msg_status= 'success';
        $msg_txt= 'บันทึกข้อมูลสำเร็จ';
        }catch (PDOException $e) {
            $msg_status= 'error';
            $msg_txt=  "Error!: " . $e->getMessage();
        } // enc catch
    }
    $stmt = $pdo->prepare("SELECT *  FROM $tbl_role_menu WHERE role_id=:role_id"); 
    $stmt->bindParam("role_id", $_POST['role_id'], PDO::PARAM_STR) ;
    $stmt->execute();
    $count=$stmt->rowCount();
    if($count){
        $stmt = $pdo->prepare("DELETE   FROM $tbl_role_menu WHERE role_id=:role_id"); 
        $stmt->bindParam("role_id", $_POST['role_id'], PDO::PARAM_STR) ;
        $stmt->execute();
    }
}
if(!empty($_POST['chkb'])) {

foreach($_POST['chkb'] as $selected):
    try{
        $datalist =[
          "role_id"        => htmlspecialchars($_POST['role_id']),
          "menu_id"        => $selected
        ];
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "$tbl_role_menu",
            implode(", ", array_keys($datalist)),
            ":" . implode(", :", array_keys($datalist))
    );
    $stmt = $pdo->prepare($sql);
    $stmt->execute($datalist);
    $msg_status= 'success';
    $msg_txt= 'บันทึกข้อมูลสำเร็จ';
    }catch (PDOException $e) {
        $msg_status= 'error';
        $msg_txt=  "Error!: " . $e->getMessage();
    } // enc catch

endforeach;
}
$data = [ "msg_status"=> $msg_status,
"msg_txt" => $msg_txt ];
echo json_encode($data);
?>