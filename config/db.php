 <?PHP error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>
<?php 
   mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$host ="127.0.0.1";
$user ="root";
$pass ="";
$db   ="kreasin3_dbelearning";

$con = new mysqli($host,$user,$pass,$db) or die(mysqli_error($con));

date_default_timezone_set('Asia/Jakarta'); 
 ?>
