<?php
$ServerName =  $_SERVER['HTTP_HOST'];

if($ServerName == 'localhost:82'){
    //Enviroment Dev
    $serverName_1 = "localhost";
    $userName_1 = "root";
    $userPassword_1 = "";
    $dbName_1 = "enc";
    // MAIL CONFIGURATION
define("MAIL_USR", "anisongduck@gmail.com");
define("MAIL_PWD", "Anisong12");
define("MAIL_SENDER_ADDRESS", "anisongduck@gmail.com");
//define("MAIL_SENDER_NAME", "Test");
//define("MAIL_SUBJECT", "[Phonebook] ข้อความจากระบบ phonebook");
define("MAIL_CHARSET", "utf-8");
define("MAIL_HOST", "smtp.gmail.com");
define("MAIL_PORT", 587);
define("MAIL_TIMEOUT", 5);

}else if ($ServerName == 'ecn.cheetahsolution.com'){
       //Enviroment PRD
    $serverName_1 = "localhost";
    $userName_1 = "cheetahs_ecnuser";
    $userPassword_1 = "P@ssw0rdEcn@";
    $dbName_1 = "cheetahs_ecn";
        // MAIL CONFIGURATION
        define("MAIL_USR", "anisongduck@gmail.com");
        define("MAIL_PWD", "Anisong12");
        define("MAIL_SENDER_ADDRESS", "anisongduck@gmail.com");
        //define("MAIL_SENDER_NAME", "Test");
        //define("MAIL_SUBJECT", "[Phonebook] ข้อความจากระบบ phonebook");
        define("MAIL_CHARSET", "utf-8");
        define("MAIL_HOST", "74.125.68.109");
        define("MAIL_PORT", 587);
        define("MAIL_TIMEOUT", 20); 
}else{
    echo 'Error ..! Please Contact Support';
    die();
}

$charSet_1 = "charset=utf8mb4";
try {

 $pdo = new PDO("mysql:host=$serverName_1;dbname=$dbName_1;$charSet_1", $userName_1, $userPassword_1);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $pdo->exec("set names utf8mb4");
 date_default_timezone_set("Asia/Bangkok");
    //echo "Connected!: ". "<br/>";
//insert
} catch (PDOException $e) {
    print "Error!: Cannot connection to database " . $e->getMessage() . "<br/>";
    die();
}
// $command = escapeshellcmd('open . ');
// $command = escapeshellcmd('ping -t 2 smtp.gmail.com');
// $output = shell_exec($command);
// echo "<pre>".$output."</pre>";
// exit();
// echo "<pre>$output</pre>";
?>