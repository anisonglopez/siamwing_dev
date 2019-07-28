<?php
session_start();
session_destroy();
$session_uid='';
$_SESSION['user_id']=''; 
if(empty($session_uid) && empty($_SESSION['user_id']))
{
$url='index.php';
header("Location: $url");
}
?>