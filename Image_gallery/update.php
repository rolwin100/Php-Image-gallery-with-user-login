<?php

	include("connect.php");
	
	$password	 	 = $_POST['password'];
	$email			 = $_POST['email'];
	$phone			 = $_POST['phone'];
	$id              = $_POST['id'];

 
	if($password != '')
	{
		$query = "update user set password = '".$password."' where id =".$id;
		mysqli_query($connection,$query);
	}
	if($email != '')
	{
		$query = "update user set email = '".$email."' where id =".$id;
		mysqli_query($connection,$query);
	}

	if($phone != '')
	{
		$query = "update user set phone = '".$phone."' where id =".$id;
		mysqli_query($connection,$query);
	}

	header("Location:admin.php");

?>