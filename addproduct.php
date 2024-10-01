<?php
include_once 'db.php';
$stmt=$conn->prepare("SELECT`c_id`,`category`FROM`category`");
$stmt->execute();
$result=$stmt->get_result();
if ($_SERVER['REQUEST_METHOD']==="POST") {
	if (isset($_POST['add'])) {

		$name=$_POST['name'];
		$quantity=$_POST['quantity'];
		$price=$_POST['price'];
		
		$imgname=$_FILES['img']['name'];
		$location=$_FILES['img']['tmp_name'];
		$destination="uploads/".$imgname ;

		if ($_POST['category']==="a") {
			$stmt1=$conn->prepare("SELECT*FROM`category`WHERE`category`=?");
			$stmt1->bind_param("s",$_POST['othercategory']);
			$stmt1->execute();
			$result1=$stmt1->get_result();

			if ($result1-> num_rows < 1) {

				$stmt1->close();
				$stmt2=$conn->prepare("INSERT INTO `category`(`category`)VALUES( ? )");
				$stmt2->bind_param("s",$_POST['othercategory']);
				$stmt2->execute();
				$stmt2->close();

				$stmt3=$conn->prepare("SELECT`c_id`FROM`category`WHERE`category`=?");
				$stmt3->bind_param("s",$_POST['othercategory']);
				$stmt3->execute();
				$resultcategory=$stmt3->get_result();
				$rowc_id=$resultcategory->fetch_assoc();
				$category=$rowc_id['c_id'];
			}else{
				echo"<script>window.alert('this category already have!')</script>";
			}
		}else{
			$category=$_POST['category'];
		}
		if (move_uploaded_file($location, $destination)) {
			$stmt4=$conn->prepare("SELECT*FROM`product`WHERE `product_name`=?");
			$stmt4->bind_param("s",$name);
			$stmt4->execute();
			$result2=$stmt4->get_result();
			if ($result2-> num_rows < 1) {
				$stmt4->close();
				$stmt5=$conn->prepare("INSERT INTO `product`(`product_img`, `product_name`, `quantity`, `category_id`, `seller_id`, `price`) VALUES (?,?,?,?,?,?)");
				$stmt5->bind_param("ssiiis",$imgname,$name,$quantity,$category,$_SESSION['id'],$price);
				$stmt5->execute();
				echo "<script>window.alert('Add product sucessfull!!');window.location.href='addproduct.php'</script>";
				exit();
			}else{
				echo"<script>window.alert('this product already have!')</script>";
			}
		}
		

	}elseif (isset($_POST['back'])) {
		header("location:sellermain.php");
		exit();
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
		<h1>Add product</h1>

		<label>Upload image</label>
		<input type="file" name="img"><br>

		<label>Product name:</label>
		<input type="text" name="name"><br>

		<label>Quantity:</label>
		<input type="number" name="quantity"><br>

		<label>Price:</label>
		<input type="text" name="price" pattern="[0-9]{9,1}.[0-9]{2}"><br>
      
		

		<select name="category" id="category" onchange="inputothercategory()">
			<option>Select Category</option>
			<?php while ($row=$result->fetch_assoc()) { ?>
				<option value="<?=$row['c_id']?>"><?=$row['category']?></option>
			<?php } ?>
			<option value="a">Other category:</option>
		</select>
		<input type="hidden" name="othercategory" id="othercategory"><br>

		<input type="submit" name="add" value="Add Product" class="input"><br>
		<input type="submit" name="back" value="back" class="input">
	</form>
</body>
</html>
<script type="text/javascript">
	function inputothercategory() {
		var category = document.getElementById('category')
		var target =document.getElementById('othercategory')
		if (category.value=="a") {
			target.removeAttribute("type")
			target.setAttribute("type","text")
		}else{
			target.removeAttribute("type")
			target.setAttribute("type","hidden")
		}
	}
</script>
<style>
	.input{
		border: 2px solid black ;
		background:yellow;
	}
</style>