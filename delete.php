<?php
include_once 'db.php';

$id=$_GET['id'];

$stmt=$conn->prepare("DELETE FROM `product` WHERE `p_id`=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();

header("location:sellermain.php");
exit();

?>