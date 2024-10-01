<?php
include_once 'db.php';

if (isset($_SESSION['id'])) {
	$id =$_SESSION['id'];
	if (isset($_SESSION['addres'])) {
		$addres=$_SESSION['addres'];
	}else{
		echo "<script>window.alert('please add location!');window.location.href='editaccount.php'</script>";
	}
	
} else {
	echo "<script>window.alert('please login first!');window.location.href='login.php'</script>";
}

$stmt=$conn->prepare("SELECT `add_cart`.`ac_id`,`product`.`p_id`,`product`.`product_img`,`product`.`product_name`,`product`.`quantity`,`product`.`seller_id`,`product`.`price`FROM`add_cart`INNER JOIN `product` ON `add_cart`.`product_id`=`product`.`p_id`WHERE `add_cart`.`buyer_id`=? AND `add_cart`.`status`='addcart'ORDER BY `add_cart`.`ac_id` DESC");
$stmt->bind_param("i",$id);
$stmt->execute();
$result=$stmt->get_result();

$loop=0 ;

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post">
		<table>
			<tr>
				<th>Product image</th>
				<th>Product Info</th>
			</tr>
			<?php while ($row=$result->fetch_assoc()) { ?>
				<tr>
					<td>
						<img src="uploads/<?=$row['product_img']?>">
					</td>
					<td>
						<p>Product Name: <?=$row['product_name']?></p>
						<p>Quantity : <input type="number" name="quantity<?=$loop?>" id="quantity<?=$loop?>" min="1" max="<?=$row['quantity']?>" value="1" oninput="changeprice(<?=$row['price']?>,'quantity<?=$loop?>','price<?=$loop?>')"></p>
						<p>Price : <input type="number" name="price<?=$loop?>" id="price<?=$loop?>" value="<?=$row['price']?>" readonly></p>
						<button type="button" onclick="window.location.href='deletecart.php?id=<?=$row['ac_id']?>'"  class="input">Delete</button>
					</td>
				</tr>
			<?php
			
			$arrayquantity[]=$row['quantity'];

			$arrayproduct_id[]=$row['p_id'];
			
			$arrayseller_id[]=$row['seller_id'];
			
			$arrayorder_listid[]=$row['ac_id'];

			$loop++ ;

		} 
		?>
		</table>
		<input type="submit" name="submit" class="input"	>
	</form>
	<h3 style="mergin:0px">Location : <?=$addres?></h3>
	<a href="editaccount.php"><button class="input">Change</button></a>
	<a href="main.php"><button class="input">Back</button></a>
</body>
</html>
<?php

if ($_SERVER['REQUEST_METHOD']==="POST") {
	if (isset($_POST['submit'])) {
			for ($i=0; $i <= $loop ; $i++) { 
				$quantity=$_POST['quantity'.$i];
				$price=$_POST['price'.$i];
				$status= "order";
				$stmt1=$conn->prepare("INSERT INTO `order_list`(`seller_id`, `buyer_id`, `product_id`, `order_quantity`, `total_price`, `status`,`location`) VALUES (?,?,?,?,?,?,?)");
				$stmt1->bind_param("iiiisss",$arrayseller_id[$i],$id,$arrayproduct_id[$i],$quantity,$price,$status,$addres);			
				if ($stmt1->execute()) {
					$stmt1->close();
					$stmt2=$conn->prepare("UPDATE `add_cart` SET `status`='order' WHERE `ac_id`=?");
					$stmt2->bind_param("i",$arrayorder_listid[$i]);		
					if ($stmt2->execute()) {
							$stmt2->close();
							$nowquantity=$arrayquantity[$i] -= $quantity ;
							$stmt3=$conn->prepare("UPDATE `product` SET `quantity`=? WHERE `p_id`=?");
							$stmt3->bind_param("ii",$nowquantity,$arrayproduct_id[$i]);
							$stmt3->execute();
							$stmt3->close();
							$stmt->close();
							echo "<script>window.alert('order complete !');window.location.href='cart.php'</script>";
						}
				}
			}
			exit();
		}elseif (isset($_POST['back'])) {
			//$stmt->close();
			header("location:main.php");
			exit();
		}
}

?>
<style>
	.input{
		border: 2px solid black ;
		background:yellow;
	}
	table,th,td{
		border:2px solid black;
	}
</style>
<script type="text/javascript">
	function changeprice(price , fromvalue , target) {
		var inputvalue =document.getElementById(fromvalue)
		var resultprice = inputvalue.value * price 
		document.getElementById(target).value= resultprice 
	}
</script>