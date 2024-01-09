<?php
ob_start();
session_start();
$dbhost = "localhost";
$dbname = "KKTECH_Food";
$dbuser = "root";
$dbpass = "";
try{
    $dbcon = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
    $dbcon->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $dbcon->exec("set names utf8");
} catch(PDOException $e){
    echo $e->getmessage();
}
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
$title = $dbcon->prepare("SELECT * FROM webconfig");
$title->execute();
$title2 = $title->fetch();
echo"<title>";
echo $title2["title"];
echo"</title></head>";
?>
<link rel="icon" href="<?php echo $title2["icon"];?>">