<?php
	include('connect.php');

	session_start();
	if(!isset($_SESSION['username']))
	{
		header('Location:index.php');
	}

	
	$query ="delete from user where id = ".$_GET['id'];

	
	$result=mysqli_query($connection,$query);

	include('deleteuser.php');
	header("Location:admin.php");
?>