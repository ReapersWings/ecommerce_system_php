<?php
include_once 'db.php';

if (isset($_SESSION['id'])) {
	$id=$_SESSION['id'];
	$stmt=$conn->prepare("SELECT `order_list`.`location`,`order_list`.`ol_id`,`order_list`.`order_quantity`,`order_list`.`total_price`,`seller`.`shope_name`,`seller`.`username`,`product`.`product_name` FROM`order_list`INNER JOIN `seller` ON `order_list`.`seller_id`=`seller`.`id`INNER JOIN `product` ON `order_list`.`product_id`=`product`.`p_id` WHERE `buyer_id`=? AND `status`='on_the_way' ORDER BY `order_list`.`ol_id` DESC");
	$stmt->bind_param("i",$id);
	$stmt->execute();
	$result=$stmt->get_result();
}else {
	echo "<script>window.alert('please login first!');window.location.href='login.php'</script>";
}


	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href="main.php"><button>Back</button></a>
	<h1 style="text-align: center;">Purchase list</h1>
	<table>
		<tr>
			<h5>
				<th>Product Name:</th>
				<th>order Quantity:</th>
				<th>Total Revenge</th>
				<th colspan="2">Seller data</th>
				<th>Location</th>
				<th>Check</th>
			</h5>
		</tr>
		<?php while ($row=$result->fetch_assoc()) { ?>
			<tr>
				<td><?=$row['product_name']?></td>
				<td><?=$row['order_quantity']?></td>
				<td>RM<?=$row['total_price']?></td>
				<td>shope name:<?=$row['shope_name']?></td>
				<td>Username:<?=$row['username']?></td>
				<td>Location : <?=$row['location']?></td>
				<td>
					<a href="updata.php?action=buyer&id=<?=$row['ol_id']?><"><button>complete</button></a>
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