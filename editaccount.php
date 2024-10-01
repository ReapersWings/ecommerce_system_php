<?php
include_once "db.php";

if (isset($_SESSION['id'])) {
    $id=$_SESSION['id'];
    $stmt=$conn->prepare("SELECT`addres`,`username`,`email`,`first_name`,`last_name`,`phone_number`FROM`buyer`WHERE`s_id`=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $row=$result->fetch_assoc();
}else{
    echo"<script>window.alert('Please login first !');window.location.href='login.php'</script>";
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $addres=$_POST['addres'];
    $phone=$_POST['phone'];
    /*$stmt1=$conn->prepare("SELECT `username` FROM`buyer`WHERE`username`=? AND `s_id`=?");
    $stmt1->bind_param("si",$name,$id);
    $stmt1->execute();
    $result1=$stmt1->get_result();
    if ($result1-> num_rows === 1) {
        $stmt1->close();*/
        $stmt2=$conn->prepare("UPDATE `buyer` SET `username`=?,`addres`=?,`email`=?,`first_name`=?,`last_name`=?,`phone_number`=? WHERE `s_id`=?");
        $stmt2->bind_param("ssssssi",$name,$addres,$email,$fname,$lname,$phone,$id);
        $stmt2->execute();
        $_SESSION['name']=$name ;
        $_SESSION['addres']=$addres ;
        echo"<Script>window.alert('edit account complete !');window.location.href='main.php'</script>";
        //header("location:");
        $stmt2->close();
        exit();
    /*} else {
        
    }*/
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <h1>Edit Account:</h1>
        <label for="username">Username:</label>
        <input type="text" name="name" id="username" value="<?=$row['username']?>" required><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?=$row['email']?>" required><br>
        <label for="fname">First Name :</label>
        <input type="text" name="fname" id="fname" value="<?=$row['first_name']?>" required><br>
        <label for="lname">Last Name :</label>
        <input type="text" name="lname" id="lname" value="<?=$row['last_name']?>" required><br>
        <label for="addres">Addres :</label>
        <input type="text" name="addres" id="addres" value="<?=$row['addres']?>" required><br>
        <label for="tel">Tel :</label>
        <input type="text" name="phone" id="tel"  pattern="0[0-9]{2}-[0-9]{7,8}" value="<?=$row['phone_number']?>" required><br>
        <input type="submit" name="submit" class="input">
    </form>
    <a href="main.php"><button class="input">Back</button></a>
</body>
</html>
<style>
    .input{
        border:2px solid black ;
        background:yellow;
    }
</style>