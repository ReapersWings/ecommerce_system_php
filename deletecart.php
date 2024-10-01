<?php
include_once 'db.php';

$stmt=$conn->prepare("UPDATE `add_cart` SET `status`='delete' WHERE `ac_id`=?");
$stmt->bind_param("i",$_GET['id']);
$stmt->execute();
$stmt->close();
header("location:cart.php");

exit();


?>