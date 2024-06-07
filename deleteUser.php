<?php
include "conn.php";
$matric=$_GET['matric'];

$sql="DELETE FROM users WHERE matric = '$matric'";

$val= $conn->query($sql);
if($val === TRUE){
header('location: user.php');
    exit();

}
?>