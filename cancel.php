<?php
session_start();
error_reporting(0);
include('includes/config.php');
$oid=intval($_GET['ID']);


mysqli_query($con,"delete from orders where id = '".$oid."'");
$_SESSION['delmsg']="Equipments deleted !!";

$extra="order-history.php";
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
echo "<script>alert('Order Deleted Sucessfully');</script>";
header("location:http://$host$uri/$extra");

 ?>