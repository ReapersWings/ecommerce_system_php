<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD']==="POST") {
	if (isset($_POST['login'])) {
		header("location:login.php");
		exit();
	} else if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$pwdhasd=password_hash($_POST['pwd'],PASSWORD_DEFAULT);
		$email=$_POST['email'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$phone=$_POST['phonenumber'];
		$addres=$_POST['addres'];
		if (!empty($name) && !empty($_POST['pwd']) && !empty($email) && !empty($fname) && !empty($lname) && !empty($phone) && !empty($addres)) {
			$stmt=$conn->prepare("SELECT*FROM`buyer`WHERE`username`=?");
			$stmt->bind_param("s",$name);
			$stmt->execute();
			$result=$stmt->get_result();
			if ($result-> num_rows < 1) {
				$stmt1=$conn->prepare("INSERT INTO `buyer`(`username`,`password`,`email`,`first_name`,`last_name`,`phone_number`,`addres`)VALUES(?,?,?,?,?,?,?)");
				$stmt1->bind_param("sssssss",$name,$pwdhasd,$email,$fname,$lname,$phone,$addres);
				$stmt1->execute();
				header("location:login.php");
				$stmt->close();
				$stmt1->close();
				exit();
			} else {
				echo "<script>window.alert('This account have been used!!')</script>";
			}
			
		} else {
			echo "<script>window.alert('please fill all the testbox!!')</script>";
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
		<h1>Register</h1>
		<label>Username:</label>
		<input type="text" name="name" class="input"><br>
		<label>Password:</label>
		<input type="password" name="pwd" class="input"><br>
		<label>Email:</label>
		<input type="email" name="email" class="input"><br>
		<label>First name:</label>
		<input type="text" name="fname" class="input"><br>
		<label>Last name:</label>
		<input type="text" name="lname" class="input"><br>
		<label>Phone number:</label>
		<input type="text" pattern="0[0-9]{2}-[0-9]{7,8}" name="phonenumber" class="input"><br>
		<label>Addres :</label>
        <input type="text" name="addres" class="input"><br>
		<input type="submit" name="submit" class="input">
		<input type="submit" name="login" value="Login" class="input">
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