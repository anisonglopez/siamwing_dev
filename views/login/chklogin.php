<?php 
  session_start();
  require '../00_config/connect.php';//db connect
	try{
		$user_name = ($_POST['user_name']);
		$user_password = ($_POST['user_password']);
		$hash_password= hash('sha256', $user_password); //Password encryption
		$stmt = $pdo->prepare("SELECT user_id, user_name, role_id FROM 01_user_profile WHERE user_name=:user_name AND user_password=:hash_password AND (user_active = 1) AND (user_trash = 0)"); 
		$stmt->bindParam("user_name", $user_name,PDO::PARAM_STR) ;
		$stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
		$stmt->execute();
		$count=$stmt->rowCount();
		$data=$stmt->fetch(PDO::FETCH_OBJ);
		if($count)
				{
				$_SESSION['user_id']=$data->user_id; // Storing user session value
				$_SESSION['user_name']=$data->user_name;
				$_SESSION['role_id']=$data->role_id;

				header("location: ../../index.php");
				return true;
				}
				else
				{
					echo "<script language='javascript'>alert('ชื่อผู้ใช้งาน รหัสผ่านไม่ถูกต้อง')
	window.location = './index.php';
   </script>";
				echo "Error Cannot Insert <br>";
				return false;
				} 
				
	}
	catch(PDOException $error) {
		echo "Error Cannot Insert <br>" . $error->getMessage();
	}
	
?>