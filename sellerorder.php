<?php
include_once 'db.php';
if (isset($_SESSION['id'])) {
	$id=$_SESSION['id'];
	$stmt=$conn->prepare("SELECT `order_list`.`location`,`order_list`.`ol_id`,`order_list`.`order_quantity`,`order_list`.`total_price`,`buyer`.`first_name`,`buyer`.`last_name`,`buyer`.`username`,`product`.`product_name` FROM`order_list` INNER JOIN `buyer` ON `order_list`.`buyer_id`=`buyer`.`s_id` INNER JOIN `product` ON `order_list`.`product_id`=`product`.`p_id` WHERE `order_list`.`seller_id`=? AND `status`='order' ORDER BY `order_list`.`ol_id` DESC ");
	$stmt->bind_param("i",$id);
	$stmt->execute();
	$result=$stmt->get_result();
} else {
	header("location:main.php");
	//exit();
}


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href="sellermain.php"><button>Back</button></a>
	<h1 style="text-align: center;">Order not to ship</h1>
	<table>
		<tr>
			<h5>
				<th>Product Name:</th>
				<th>order Quantity:</th>
				<th>Total Revenge</th>
				<th colspan="4">buyer data</th>
				<th>Check</th>
			</h5>
		</tr>
		<?php while ($row=$result->fetch_assoc()) { ?>
			<tr>
				<td><?=$row['product_name']?></td>
				<td><?=$row['order_quantity']?></td>
				<td>RM<?=$row['total_price']?></td>
				<td>first_name:<?=$row['first_name']?></td>
				<td>last_name:<?=$row['last_name']?></td>
				<td>Username:<?=$row['username']?></td>
				<td>Location:<?=$row['location']?></td>
				<td>
					<a href="updata.php?action=seller&id=<?=$row['ol_id']?><"><button>on the way</button></a>
				</td>
			</tr>
		<?php } ?>
	</table>
</body>
</html>
<style type="text/css">
	table,th,td{
		border: 2px solid black;
	}
</style>