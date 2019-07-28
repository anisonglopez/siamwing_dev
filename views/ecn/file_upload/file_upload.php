<?php
// print_r($_FILES);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require '../../00_config/connect.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
$date_today = date('Y-m-d H:i:s');
$user_update = $_SESSION['user_name'];
$tbl_att = "30_ecn_attach";
    if (isset($_FILES['files'])) {
        $att_desc =  $_POST['att_desc'];
        $errors = [];
        $path = 'uploads/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        // $all_files = count($_FILES['files']['tmp_name']);
            // $file_name = $_FILES['files']['name'][$i];
            // echo $file_name;
            // $file_tmp = $_FILES['files']['tmp_name'][$i];
            // $file_type = $_FILES['files']['type'][$i];
            // $file_size = $_FILES['files']['size'][$i];
            // $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i])));
            // $file = $path . $file_name;
            // if (!in_array($file_ext, $extensions)) {
            //     $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
            // }
            // if ($file_size > 2097152) {
            //     $errors[] = 'Error ! ขนาดของไฟล์ใหญ่เกินไป: ' . $file_name . ' ' . $file_type;
            //     // ไม่ได้ใช้ no limit size
            // }
            if (empty($errors)) {
                //move_uploaded_file($file_tmp, $file);
                move_uploaded_file($_FILES['files']['tmp_name'], $path . $_FILES['files']['name']);       
                try{
                    $datalist =[
                    "ecn_id"        => htmlspecialchars($_POST['ecn_id']),
                    "file_name"        => $_FILES['files']['name'],
                    "att_desc"        => $att_desc,
                    "file_size"        => $_FILES['files']['size'],
                    "updated_date"        => $date_today,
                    "updated_by"        => $user_update
                    ];
                    $sql = sprintf(
                        "INSERT INTO %s (%s) values (%s)",
                        "$tbl_att",
                        implode(", ", array_keys($datalist)),
                        ":" . implode(", :", array_keys($datalist))
                );
                $stmt = $pdo->prepare($sql);
                $stmt->execute($datalist);
                echo "ทำการ Upload ไฟล์สำเร็จ";
                }catch (PDOException $e) {
                   echo  "Error!: " . $e->getMessage();
                } // enc catch
            }
        

        if ($errors) print_r($errors);
    }
}
?>