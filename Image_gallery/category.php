<?php
	
	function addCategory()
	{
		$username = $_POST['username'];
	    $category = $_POST['category'];

		include("connect.php");

		$query = "insert into gallery_category (username,category_name) values('".$username."','".$category."')";
		
		mysqli_query($connection,$query);

		header("Location:admin.php");
	}

	addCategory();

?>