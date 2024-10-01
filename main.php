<?php
include_once 'db.php';
if ($_SERVER['REQUEST_METHOD']==="POST") {
	if (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
		header("location:main.php");
		exit();
	}elseif (isset($_POST['LoginBuyer'])) {
		header("location:login.php");
		exit();
	}elseif (isset($_POST['Loginseller'])) {
		header("location:sellerlogin.php");
		exit();
	}elseif (isset($_POST['order_list'])) {
		header("location:orderlist.php");
		exit();
	}elseif (isset($_POST['cart'])) {
		header("location:cart.php");
		exit();
	}elseif (isset($_POST['edit'])) {
		header("location:editaccount.php");
		exit();
	}
}

$stmt=$conn->prepare("SELECT`product`.`p_id`,`product`.`product_img`,`product`.`product_name`,`product`.`quantity`,`product`.`price`,`category`.`category`,`seller`.`username`,`seller`.`shope_name`FROM`product`INNER JOIN `category` ON `product`.`category_id`=`category`.`c_id` INNER JOIN `seller` ON `product`.`seller_id`=`seller`.`id` WHERE `product`.`quantity`>'0'");
$stmt->execute();
$result=$stmt->get_result();

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post">

		<?php
		if (isset($_SESSION['name'])) {

			echo "<h1>Welcome back ! ".$_SESSION['name']."</h1>";
			echo "<input type='submit' name='logout' value='logout' class='input'>";
			
		}else{

			echo "<h1>Welcome ! GUEST </h1>";
			echo "<input type='submit' name='Loginseller' value='Login seller' class='input'> ";
			echo "<input type='submit' name='LoginBuyer' value='Login Buyer' class='input'>";

		}
		?>
		<input type="submit" name="order_list" value="Order List" class="input">
		<input type="submit" name="cart" value="cart" class="input">
		<input type="submit" name="edit" value="Edit Account" class="input">
	</form>
	<br>
	<table>
		<tr>
			<th>Image</th>
			<th>Product name</th>
			<th>quantity</th>
			<th>price</th>
			<th>category</th>
			<th>seller</th>
			<th>buy</th>
		</tr>
		<?php while ($row=$result->fetch_assoc()) { ?>
			<tr>
				<td><img src="uploads/<?=$row['product_img']?>"></td>
				<td><?=$row['product_name']?></td>
				<td><?=$row['quantity']?></td>
				<td><?=$row['price']?></td>
				<td><?=$row['category']?></td>
				<td><?=$row['username']?></td>
				<td>
					<a href="buy.php?id=<?=$row['p_id']?>"><button>buy</button></a>
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
		width: 49.8%;

	}
	table,th,td{
		border: 2px solid black;
		text-align: center;
	}
	table{
		width: 100%;
	}
	img{
		width: 25%;
	}
</style>