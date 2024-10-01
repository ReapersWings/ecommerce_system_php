<?php
	
session_start();
/*
$localhost="localhost";
$username="root";
$password="";
$database="test2";
*/

$localhost="server621.iseencloud.com";
$username="jomjomco";
$password="W7#02YJpcAz1#v";
$database="jomjomco_kaiyi";

$conn=mysqli_connect($localhost,$username,$password,$database);

if ($conn->connect_error) {
	die("Connect database failed :".$conn->connect_error);
}

?>