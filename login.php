<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD']==="POST") {
	if (isset($_POST['register'])) {
		header("location:register.php");
		exit();
	} else if (isset($_POST['submit'])) {
		$name=$_POST['name'];
		$pwd=$_POST['pwd'];
		if (!empty($name) && !empty($pwd)) {
			/*$sql="SELECT`password`,`s_id`FROM`buyer`WHERE`username`='".$name."'";
			$result=mysqli_query($conn,$sql);*/

			$stmt=$conn->prepare("SELECT`password`,`s_id`,`addres`FROM`buyer`WHERE`username`=?");
			$stmt->bind_param('s',$name);
			$stmt->execute();
			$result=$stmt->get_result();
			if ($result-> num_rows > 0) {
				$row=$result->fetch_assoc();
				if (password_verify($pwd,$row['password'])) {
					$_SESSION['name']=$name;
					$_SESSION['id']=$row['s_id'];
					$_SESSION['addres']=$row['addres'];
					//$result->close();
					//$stmt->close();
					header("location:main.php");
					exit();
				}else{
					echo "<script>window.alert('your username or password is wrong!!')</script>";
				}
			}else{
				echo "<script>window.alert('this account haven't been register !!')</script>";
			}
		}else{
			echo "<script>window.alert('please fill all the testbox!!')</script>";
		}
	}else if (isset($_POST['seller'])){
		header("location:sellerlogin.php");
		session_unset();
		session_destroy();
		exit();
	}elseif (isset($_POST['center'])) {
		header("location:main.php");
		session_unset();
		session_destroy();
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
	<form method="post" >
		<h1>Buyer Login </h1>
		<label>Username:</label>
		<input type="text" name="name" class="input"><br>
		<label>Password:</label>
		<input type="password" name="pwd" class="input"><br>
		<input type="submit" name="submit" class="input">
		<input type="submit" name="register" value="Register" class="input">
		<!--<input type="submit" name="seller" value="Login Seller" class="input">
		<input type="submit" name="center" value="Back center" class="input">-->
	</form>
</body>
</html>
<style type="text/css">
	label,input{
		width: 49%;
	}
	.input{
		background-color: yellow;
		border: 2px solid black ;
		margin: 2px;
	}
	form{
		border:2px solid black;
		width:50%;
	}
</style>
