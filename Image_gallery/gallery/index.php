<?php
	include("config.inc.php");
	session_start();
	if(!isset($_SESSION['username']))
	{
		header('Location:../index.php');
	}

	// initialization
	$photo_upload_fields = "";

	// default number of fields
	$number_of_fields = 1; 

// If you want more fields, then the call to this page should be like, 
// preupload.php?number_of_fields=20

	if( $_GET['number_of_fields'] )
	$number_of_fields = (int)($_GET['number_of_fields']);

	// Firstly Lets build the Category List

	$category_name = $_GET['category'];
	$username 	   = $_SESSION['username'];

// Lets build the Photo Uploading fields
	

// Final Output
echo "
<html>
<head>
	<title>$category_name</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' >
	 
	<link rel='stylesheet' href='../css/admin.css' >
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script> 
	<!-- Latest compiled and minified JavaScript -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</head>
<body>
<header>
	<div class='container' style='padding: 1%;'>
		<h3 class='custom dashboard'><span style='color: #E60211'>Dash</span><span style='color: #5C5A5A'>board</span></h3>
		<a href='../logout.php'><button class='btn-warning btn-lg btn-right custom btn-logout'>LOGOUT</button></a>
	</div>
</header>
<div class='container' style='padding-top:30px'>";

		$number_of_thumbs_in_row = 5;
		$result_array = array();
		$counter = 0;
		
		$query = "select  category_id from gallery_category where username = '".$username."' and category_name = '".$category_name."'";
				$result = mysql_query($query);

				while($row = mysql_fetch_array( $result ))
				{
					$cid = $row[0];
				}

		$result = mysql_query( "SELECT photo_id,photo_caption,photo_filename FROM gallery_photos WHERE photo_category='".addslashes($cid)."'" );
		$nr = mysql_num_rows( $result );

		if( empty( $nr ) )
		{
			$result_final = "\t<tr><td>No Category found</td></tr>\n";
		}
		else
		{
			while( $row = mysql_fetch_array( $result ) )
			{
				$result_array[] = "<a href='viewgallery.php?cid=$cid&pid=".$row[0]."'>
				<div class='col-md-2 col-sm-4 col-xm-4 card content' style='margin-right:20px'>
					<div class='row'>
						<img style='width:100%;height:150px' src='".$images_dir."/tb_".$row[2]."' border='0' alt='".$row[1]."' />
					</div>
					<div class='text-center'>
						<h5><span style='color: #E60211;'>Caption</span></h5>
						<h5>".$row[1]."</h5>
					</div>
				</div>
				</a>";

			}
			mysql_free_result( $result );	

			$result_final = "";
	
			foreach($result_array as $thumbnail_link)
			{

				$result_final .= "".$thumbnail_link."";
			}
	
			
		}

		echo "<div class='row'>
			$result_final		
			</div>
			<form enctype='multipart/form-data' action='upload.php' method='post' name='upload_form'>

					<input type='hidden' name='category' value='$category_name'>

					<input name='photo_filename[]' type='file' />
					<div class='form-group'>
				    	<input class='form-control' style='width:220px' placeholder='image caption' required name='photo_caption[]'></input>
				    </div>
				    <input class='btn btn-danger' type='submit' name='submit' value='Add Photos' />
			</form>
			</div>
			</body>
			</html>";
?>
