<?php
$host = "localhost";
$user = "root";
$pass = "beefandpork080621";
$db_name = "chat";

$con = new mysqli($host,$user,$pass,$db_name);
function formatDate($date){
    return date('g:i a',strtotime($date));
}

?>

