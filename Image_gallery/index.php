<?php
	include("connect.php");
	session_start();

			
	if(count($_POST)>0)
	{
		$query = "SELECT * FROM user WHERE username = '".$_POST["username"]."' and password = '".$_POST["password"]."'";

		$result = mysqli_query($connection,$query);

		if($result)
		{
			$row = mysqli_fetch_array($result);

			if(is_array($row))
			{
				$_SESSION["username"]=$row["username"];
				if(isset($_SESSION["username"]))
				{
					header("Location:admin.php");
				}
			}
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
	 
	<link rel="stylesheet" href="css/login.css" >

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<form class="form-signin" method="POST" action="">
        <h2 class="form-signin-heading" style="text-align: center;"><span style="color: #2B669A">User</span> Login</h2>
        <div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">@</span>
		  <input type="text" name="username" class="form-control" placeholder="Username" required>
		</div>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
</form>

<div class="form-signin">
	<button class="btn btn-md btn-success btn-block" data-toggle="modal" data-target="#myModal">Register</button>
	<p style="color: red;font-size: 10px;padding-top: 10px">once you register you can login using the username and password</p>
</div>

	<!------------------ modal ------------------>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header modal-header-primary">
		                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                    <h3 class="text-center"><i class="glyphicon glyphicon-user"></i> User Info</h3>
		                </div>
		                <div class="modal-body">
		                	<form class="form-horizontal" action = "user.php" 
		                	method="post">
		                		<div class="form-group">
					              <label class="col-md-3 control-label" for="name">Username</label>
					              <div class="col-md-9">
					                <input name="username" type="text" placeholder="Your name" class="form-control" required>
					              </div>
					            </div>

					            <div class="form-group">
					              <label class="col-md-3 control-label" for="email">email</label>
					              <div class="col-md-9">
					                <input name="email" type="text" placeholder="Your email" class="form-control" required>
					              </div>
					            </div>

					            <div class="form-group">
					              <label class="col-md-3 control-label" for="email">Phone</label>
					              <div class="col-md-9">
					                <input name="phone" type="text" placeholder="Your Phone" class="form-control" required>
					              </div>
					            </div>

					            <div class="form-group">
					              <label class="col-md-3 control-label" for="password">Password</label>
					              <div class="col-md-9">
					                <input name="password" type="password" placeholder="password" class="form-control" required>
					              </div>
					            </div>

					            <div class="form-group">
					              <div class="col-md-5 text-right">
					                <button type="submit" class="btn btn-success btn-md">Submit</button>
					              </div>
					            </div>

		                	</form>
		                </div>
		            </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->
</body>
</html>
