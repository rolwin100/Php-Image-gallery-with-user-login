<?php
	include("config.inc.php");

	session_start();
	if(!isset($_SESSION['username']))
	{
		header('Location:../index.php');
	}

	// initialization
	$result_array = array();
	$counter = 0;

	$cid = (int)($_GET['cid']);
	$pid = (int)($_GET['pid']);

	if( $pid )
	{
		$result = mysql_query( "SELECT photo_caption,photo_filename FROM gallery_photos WHERE photo_id='".addslashes($pid)."'" );
		list($photo_caption, $photo_filename) = mysql_fetch_array( $result );
		$nr = mysql_num_rows( $result );
		mysql_free_result( $result );	

		if( empty( $nr ) )
		{
			$result_final = "\t<tr><td>No Photo found</td></tr>\n";
		}
		else
		{
			$result = mysql_query( "SELECT category_name FROM gallery_category WHERE category_id='".addslashes($cid)."'" );
			list($category_name) = mysql_fetch_array( $result );
			mysql_free_result( $result );	

			$result_final .= "<div class='row'>
						<h3><a href='../admin.php'>Categories</a> &gt; 
						<a href='index.php?category=$category_name'>$category_name</a></div></h3><hr>";

			$result_final .= "
					<img class='img-responsive' src='".$images_dir."/".$photo_filename."' border='0' alt='".$photo_caption."' />
					<h3 class='text-center' style='text-transform:uppercase'><span style='color:red'>caption:</span> $photo_caption</h3>";
		}
	}

// Final Output
echo <<<__HTML_END

<html>
<head>
	<title>Gallery View</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' >
	 
	<link rel='stylesheet' href='../css/admin.css' >
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script> 
	<!-- Latest compiled and minified JavaScript -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</head>
<body>
	<div class='container'> 
		$result_final
	</div>	
</body>
</html>

__HTML_END;
?>
