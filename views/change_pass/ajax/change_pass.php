<?php
if (isset($_POST['old_password'])) {
            try{
                     require '../../00_config/connect.php';//db connect
                    session_start();
                   
                    $date_today = date('Y-m-d H:i:s');
                    $user_name = $_SESSION['user_name'];
                    $user_id = $_SESSION['user_id'];
                    $old_pass = ($_POST['old_password']);
                    $new_pass = ($_POST['user_password']);
                    $re_new_pass = ($_POST['user_repassword']);
                    $hash_password= hash('sha256', $old_pass); //Password encryption
                
                    $stmt = $pdo->prepare("SELECT user_id, user_name, role_id FROM 01_user_profile WHERE user_name=:user_name AND user_password=:hash_password AND (user_active = 1) AND (user_trash = 0)"); 
                    $stmt->bindParam("user_name", $user_name,PDO::PARAM_STR) ;
                    $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
                    $stmt->execute();
                    $count=$stmt->rowCount();
                    $data=$stmt->fetch(PDO::FETCH_OBJ);
                    if($count)
                            {
                                if($new_pass != $re_new_pass){
                                    echo 'pass_not_match';
                                }else{
                                    $new_pass_hash = hash('sha256', $new_pass); //Password encryption
                                                $datalist =[
                                                    "user_password"        =>   $new_pass_hash,
                                                    "user_updated_by" => $user_name,
                                                    "user_updated_date" => $date_today
                                                ];
                                                $sql = "UPDATE 01_user_profile 
                                                        SET user_password = :user_password, 
                                                        user_updated_by = :user_updated_by,
                                                        user_updated_date = :user_updated_date
                                                        WHERE user_id = $user_id";

                                                $statement = $pdo->prepare($sql);
                                                $statement->execute($datalist);
                                                echo 'success';
                                }                          
                            }
                    else{
                        echo 'incorrect_pass';
                    }
            }catch(PDOException $error) {
                echo 'error' . $error;

            }
}
?>