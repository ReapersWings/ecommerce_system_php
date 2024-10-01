<?php
include_once 'db.php';

$id=$_GET['id'];

switch ($_GET['action']) {
	case "seller":
		
		$status = "on_the_way";

		$stmt=$conn->prepare("UPDATE `order_list` SET `status`=? WHERE `ol_id`=?");
		$stmt->bind_param("si",$status,$id);

		if ($stmt->execute()) {
			echo"<script>window.location.href='sellerorder.php';window.alert('Start to ship!')</script>";
			$stmt->close();
			exit();
		}
		break;
	
	case "buyer":
		$status = "complete";
		
		$stmt=$conn->prepare("UPDATE `order_list` SET `status`=? WHERE `ol_id`=?");
		$stmt->bind_param("si",$status,$id);

		if ($stmt->execute()) {
			echo"<script>window.location.href='orderlist.php';window.alert('The order have been complete!!')</script>";
			$stmt->close();
			exit();
		}
		break;
}



?>