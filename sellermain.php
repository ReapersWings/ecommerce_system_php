<?php
include_once 'db.php';

if (isset($_SESSION['name'])) {
	echo"<h1>Welcome ! ".$_SESSION['name']."</h1>";
}else{
	echo"<script>window.alert('Please login first');window.location.href='sellerlogin.php'</script>";
}

/*if (isset($_POST['addproduct'])) {
	header("location:addproduct.php");
	exit();
}elseif (isset($_POST['logout'])) {
	session_unset();
	session_destroy();
	header("location:main.php");
	exit();
}elseif (isset($_POST['order'])) {
	header("location:sellerorder.php");
	exit();
}*/

$stmt=$conn->prepare("SELECT`product`.`p_id`,`product`.`product_img`,`product`.`product_name`,`product`.`quantity`,`product`.`price`,`category`.`category`,`seller`.`username`,`seller`.`shope_name`FROM`product`INNER JOIN `category` ON `product`.`category_id`=`category`.`c_id` INNER JOIN `seller` ON `product`.`seller_id`=`seller`.`id` WHERE `product`.`seller_id`= ? ORDER BY `product`.`p_id` DESC");
$stmt->bind_param("i",$_SESSION['id']);	
$stmt->execute();
$result=$stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href="addproduct.php"><button  class="input">add product</button></a>
	<a href="sellerorder.php"><button  class="input">Order</button></a>
	<a href="logout.php"><button  class="input">logout</button></a>
	<table>
		<tr>
			<th>Image</th>
			<th>Product name</th>
			<th>quantity</th>
			<th>price</th>
			<th>category</th>
			<th>seller</th>
			<th>Edit/delete</th>
		</tr>
		<?php while ($row=$result->fetch_assoc()) { 
			//<form method="post">
			//<input type="submit" name="addproduct" value="add product" class="input">
			//<input type="submit" name="order" value="Order" class="input">
			//<input type="submit" name="logout" value="logout" class="input">
			//</form>
			?>
			<tr>
				<td style="width:50%"><img src="uploads/<?=$row['product_img']?>"></td>
				<td><?=$row['product_name']?></td>
				<td><?=$row['quantity']?></td>
				<td><?=$row['price']?></td>
				<td><?=$row['category']?></td>
				<td><?=$row['username']?></td>
				<td>
					<a href="edit.php?id=<?=$row['p_id']?>"><button>Edit</button></a>
					<a href="delete.php?id=<?=$row['p_id']?>"><button>Delete</button></a>
				</td>
			</tr>
		<?php } ?> 
	</table>
</body>
</html>
<style type="text/css">
	.input{
		background-color: yellow;
		border: 2px solid black ;
		margin: 0px;	
	}
	table,th,td{
		border: 2px solid black;
		text-align: center;
	}
	table{
		width: 100%;
	}
	img{
		width: 100%;
	}
</style>
