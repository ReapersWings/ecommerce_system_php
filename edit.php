<?php
include_once 'db.php';
if (isset($_SESSION['name'])) {

	$stmt=$conn->prepare("SELECT`product_name`,`quantity`,`price`,`product_img`FROM`product`WHERE`p_id`=?");
	$stmt->bind_param("i",$_GET['id']);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();
	if ($_SERVER['REQUEST_METHOD']==="POST") {
		if (isset($_POST['back'])) {
			$stmt->close();
			header("location:sellermain.php");
			exit();
		} elseif (isset($_POST['submit'])) {
			if (isset($_GET['id'])) {

				$name=$_POST['name'];
				$price=$_POST['price'];
				$quantity=$_POST['quantity'];

				if (!empty($_FILES['image']['name'])) {
					$imgname=$_FILES['image']['name'];
					$destination="uploads/".$imgname ;
					$locationimg=$_FILES['image']['tmp_name'];
					
					if (move_uploaded_file($locationimg, $destination)) {
						$stmt1=$conn->prepare("UPDATE`product`SET `product_img`=? ,`product_name`=? ,`quantity`=?,`price`=? WHERE`p_id`=? ");
						$stmt1->bind_param("ssisi",$imgname,$name,$quantity,$price,$_GET['id']);
					}
				}else{
					$stmt1=$conn->prepare("UPDATE`product`SET `product_name`=? ,`quantity`=?,`price`=? WHERE`p_id`=? ");
					$stmt1->bind_param("sisi",$name,$quantity,$price,$_GET['id']);
				}
				$stmt1->execute();
				$stmt->close();
				$stmt1->close();
				echo"<script>window.alert('Edit data sucessfull!!');window.location.href='edit.php?id=".$_GET['id']."'</script>";
				exit();
				
			}
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
		<form method="post" enctype="multipart/form-data">
		<h1>Edit Product</h1>

		<label for="image">Upload file:</label>
		<input type="file" name="image" id="image"><br>

		<label for="name">Product_name:</label>
		<input type="text" name="name" id="name" value="<?=$row['product_name']?>"><br>

		<label for="price">Price(RM):</label>
		<input type="text" name="price" id="price" pattern="[0-9]{9,1}.[0-9]{2}" value="<?=$row['price']?>"><br>

		<label for="quantity">quantity:</label>
		<input type="number" name="quantity" id="quantity" value="<?=$row['quantity']?>"><br>

		<input type="submit" name="submit" class="input">
		<input type="submit" name="back" value="back" class="input">
	</form>
</body>
</html>
<style>
	.input{
		border: 2px solid black ;
		background:yellow;
	}
</style>
