<?php
include_once 'db.php';

if (isset($_SESSION['id'])) {
	$user_id=$_SESSION['id'];
	if (isset($_SESSION['addres'])) {
		$addres=$_SESSION['addres'];
	}else{
		echo"<script>window.alert('Please Add Location !');window.location.href='editaccount.php'</script>";
	}
	
}else{
	echo"<script>window.alert('Please Login First!');window.location.href='login.php'</script>";
}
$id=$_GET['id'];
$stmt=$conn->prepare("SELECT `product`.`product_img`,`product`.`product_name`,`product`.`quantity`,`product`.`price`,`product`.`seller_id`,`category`.`category` ,`seller`.`username`FROM`product` INNER JOIN `category` ON `product`.`category_id`=`category`.`c_id` INNER JOIN `seller` ON `product`.`seller_id`=`seller`.`id` WHERE `product`.`p_id`=? ");
$stmt->bind_param("i",$id);
$stmt->execute();
$result=$stmt->get_result();
$row=$result->fetch_assoc();
if ($_SERVER['REQUEST_METHOD']==="POST") {
	if (isset($_POST['back'])) {
		$stmt->close();
		header("location:main.php");
		exit();
	}elseif (isset($_POST['buy'])) {
		$quantity=$_POST['quantity'];
		$totalprice=$_POST['totalprice'];
		$updatequantity= $row['quantity'] -=$quantity ;
		$status="order";
		$stmt1=$conn->prepare("UPDATE `product` SET `quantity`=? WHERE `p_id`=?");
		$stmt1->bind_param("ii",$updatequantity,$id);
		if ($stmt1->execute()) {
			$stmt1->close();
			$sellerid=$row['seller_id'];
			$usernameid=$_SESSION['id'];
			$stmt2=$conn->prepare("INSERT INTO `order_list` (`seller_id`,`buyer_id`,`product_id`,`order_quantity`,`total_price`,`status`,`location`)VALUES (?,?,?,?,?,?,?)");
			$stmt2->bind_param("iiiisss",$sellerid,$usernameid,$id,$quantity,$totalprice,$status,$addres);
			if ($stmt2->execute()) {
				$stmt->close();
				echo "<script>window.alert('buy secussfull !');window.location.href='main.php'</script>";	
				exit();
			}
				

		}

	}elseif (isset($_POST['addcart'])) {
		$quantity=$_POST['quantity'];
		$totalprice=$_POST['totalprice'];
		$status="addcart";
		$stmt1=$conn->prepare("SELECT*FROM`add_cart`WHERE `buyer_id`=? AND `status`='addcart ' AND `product_id`=?");
		$stmt1->bind_param("ii",$user_id,$id);
		$stmt1->execute();
		$result=$stmt1->get_result();
		if ($result-> num_rows < 1) {
			$stmt2=$conn->prepare("INSERT INTO `add_cart`(`buyer_id`,`product_id`,`status`) VALUES (?,?,?)");
			$stmt2->bind_param("iis",$user_id,$id,$status);
			if ($stmt2->execute()) {
				$stmt1->close();
				$stmt2->close();
				echo"<script>window.alert('add to cart sucessfull!!');window.location.href='main.php'</script>";
				exit();
			}
		}else{
			echo "<script>window.alert('This product already at your cart!')</script>";
		}
		
		

	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post">
		<h3>Product Name :<?=$row['product_name']?></h3>
		<img src="uploads/<?=$row['product_img']?>" style='border: 2px solid black'><br>

		<label>Quantity:</label>
		<input type="number" name="quantity" id="quantity" oninput="pricehange(<?=$row['price']?>)" value="1" min="1" max="<?=$row['quantity']?>">
		<input type="text" name="totalprice" id="listprice" ><br>
		<h3 style="margin:0px">Your location : <?=$addres?></h3>
		<input type="submit" name="buy" value="Buy" class="input">
		<input type="submit" name="addcart" value="Add to cart"  class="input">
	</form>
	<a href="main.php"><button class="input">Back</button></a>
</body>
</html>
<script type="text/javascript">
	pricehange(<?=$row['price']?>);
	function pricehange(price) {
			var getvalue =document.getElementById('quantity').value 
			var coun = getvalue * price 
			document.getElementById('listprice').value = coun ; 
		}	
</script>
<style>
	.input{
		background-color: yellow;
		border: 2px solid black ;
		margin: 2px;
	}
	img{
		width:25%;
	}
</style>