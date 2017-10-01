<?php
	
	include('connect.php');

	$username = $_POST['username'];
	$email    = $_POST['email'];
	$phone	  = $_POST['phone'];
	$password = $_POST['password'];


	$query = "insert into user (username,email,phone,password) values('".$username."','".$email."','".$phone."','".$password."')"; 

	if(!is_null($username))
	{
		mysqli_query($connection,$query);
	}

	header("Location:admin.php");

?>