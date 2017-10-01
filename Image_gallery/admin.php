<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		header('Location:index.php');
	}

	$username = $_SESSION["username"];

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo "Welcome: ".$username; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' >
 
	<!-- Optional theme -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' >
	 
	<link rel='stylesheet' href='css/admin.css' >
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	<!-- Latest compiled and minified JavaScript -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</head>
<body class='custom'>
<header>
	<div class='container' style='padding: 1%;'>
		<h3 class='custom dashboard'><span style='color: #E60211'>Dash</span><span style='color: #5C5A5A'>board</span></h3>
		<a href='logout.php'><button class='btn-warning btn-lg btn-right custom btn-logout'>LOGOUT</button></a>
	</div>
</header>
<div class='container'>

	<h3 class='text-center custom admin-text'>USER INFO</h3>
	<div class='row'>

	<?php
	include('connect.php');

	$query  = "select * from user where username = '".$username."'";
	$result = mysqli_query($connection,$query);

	while($row = mysqli_fetch_assoc($result))
	{
	echo "
	<div style='margin:0 auto;max-width:500px;'>
		<div class='card content'>
			<div class='row'>
					<img src='images/user.png' class='img-responsive center-img' style='height: 120px;width: 120px; padding:5px;'>
			</div>

			<div class='text-center'>
				<h5><span style='color: #E60211;'>Username</span> : ".$row['username']."</h5>
			</div>

			<div class='text-center'>
				<h5><span style='color: #E60211;'>Email</span> : ".$row['email']."</h5>
			</div>

			<div class='text-center'>
				<h5><span style='color: #E60211;'>Phone</span> : ".$row['phone']."</h5>
			</div>

			<div class='row'>
				<div class='col-xs-8'>
					<button href='' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#passwordModal'><span class='glyphicon glyphicon-circle-arrow-up'></span> Update UserInfo</button>
				</div>
				<div class='col-xs-4'>
					<a href='deleteuser.php?id=".$row['id']."' style='float: right; padding-right: 25px'><span class=' text-centre glyphicon glyphicon-trash'></span></a>
				</div>	
			</div>
		</div>
	</div>
	<!----------------- modal -------------------->

	<div class='modal fade' id='passwordModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		        <div class='modal-dialog'>
		            <div class='modal-content'>
		                <div class='modal-header modal-header-primary'>
		                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
		                    <h3 class='text-center'><i class='glyphicon glyphicon-thumbs-up'></i>  Change Password</h3>
		                </div>
		                <div class='modal-body'>
		                	<form class='form-horizontal' action = 'update.php' 
		                	method='post'>

		                	<input type='hidden' name='id' value='".$row['id']."' />

		                		

					            <div class='form-group'>
					              <label class='col-md-4 control-label' for='email'>Email</label>
					              <div class='col-md-8'>
					                <input  placeholder='new email' name='email' type='email' class='form-control' >
					              </div>
					            </div>

					            <div class='form-group'>
					              <label class='col-md-4 control-label' for='email'>Phone</label>
					              <div class='col-md-8'>
					                <input  placeholder='new phone' name='phone' type='text' class='form-control' >
					              </div>
					            </div>

					            <div class='form-group'>
					              <label class='col-md-4 control-label' for='newpassword'>New Password</label>
					              <div class='col-md-8'>
					                <input name='password' type='password' placeholder='***********' class='form-control'>
					              </div>
					            </div>

					            <div class='form-group'>
					              <div class='col-md-6 text-right'>
					                <button type='submit' class='btn btn-success btn-md'>Update</button>
					              </div>
					            </div>

		                	</form>
		                </div>
		            </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->

	" ;	
	}

	?>
</div>	
		    <hr>

<h3 class='text-center custom admin-text'>Gallery Category</h3>

	<div class="row">
			<button class="btn btn-danger glyphicon glyphicon-plus" data-toggle='modal' data-target='#categoryModal'> Add Category</button>
	</div>

	<div class="row" style="padding-top: 30px">

	<?php

		$query  = "select * from gallery_category where username = '$username'";
		$result = mysqli_query($connection,$query);

		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
				{
					echo "
					<a href='gallery/index.php?category=".$row['category_name']."'>
						<div class='col-md-2 card content' style='margin-right:20px'>
							<div class='row'>
									<img src='images/gallery.png' class='img-responsive center-img' style='height: 120px;width: 140px;'>
							</div>
							<div class='text-center'>
								<h5><span style='color: #E60211;'>Category</span> : ".$row['category_name']."</h5>
							</div>
						</div>
					</a>";
				}
		}

	?>

	</div>

			<div class='modal fade' id='categoryModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		        <div class='modal-dialog'>
		            <div class='modal-content'>
		                <div class='modal-header modal-header-primary'>
		                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
		                    <h3 class='text-center'><i class='glyphicon glyphicon-thumbs-up'></i>  Change Password</h3>
		                </div>
		                <div class='modal-body'>
		                	<form class='form-horizontal' action = 'category.php' 
		                	method='post'>

		                	<input type='hidden' name='username' value='<?php echo $username;?>' />

		                		<div class='form-group'>
					              <label class='col-md-4 control-label' for='currentpassword'>Category Name</label>
					              <div class='col-md-8'>
					                <input  name='category' type='text' placeholder='Category Name' class='form-control' required>
					              </div>
					            </div>

					            <div class='form-group'>
					              <div class='col-md-6 text-right'>
					                <button type='submit' class='btn btn-success btn-md'><i class="glyphicon glyphicon-plus"></i> Add</button>
					              </div>
					            </div>

		                	</form>
		                </div>
		            </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->
</div>
</body>
</html>

