<?php

	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');
   
	session_start();
	
	if(! $conn )
	{
		echo "
			<div class='alert alert-danger'>
				<strong>Not connected to database." . mysqli_error();"</strong>
			</div>";
	}
?>
<!--***********************************************-->
<!--HTML Code-->
<!DOCTYPE html>
	<html lang='en'>
		<head>
			<title>CBIT MANAGEMENT SYSTEM</title>

			<!--BootStrap-->
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
  				<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
  						
 			<!--BootStrap End-->


			<!--link rel='stylesheet' href='style.css'-->
		</head>
		<body>
			<div class='container mt-5 ml-3 mr-5 pr-5'>
				<div class='row'>
					<div class='col-sm-12'>
						<h2 class='text-info'>
							Chaitanya Bharathi Institute of Technology
						</h2>
					</div>
				</div>
				<form method='POST' action='Department_login.php'>
					<div class='form-group'>
					    <label for='usr'>Username</label>
					    <input type='text' class='form-control' id='usr' placeholder='Enter Username' name='username' required>
					</div>
					<div class='form-group'>
					    <label for='pwd'>Password</label>
					    <input type='password' class='form-control' id='pwd' placeholder='Enter Password' name='password' required>
					</div>
					<input type='submit' value='Login' name='submit' class='btn btn-outline-primary btn-block'>
				</form>
			</div>
<!--***********************************************-->

<?php
	if(isset($_POST["submit"]))
	{
		if($_POST['username']!=null && $_POST['password']!=null)
		{				
			$uname = $_POST['username'];
			$pword = $_POST['password'];
				
			$sql="SELECT * from login where Username='$uname' and Password='$pword'";
			$retval = mysqli_query($conn, $sql);
			if(mysqli_affected_rows($conn)==0)
			{
				echo "
					<div class='alert alert-danger'>
							<strong>Invalid User Credentials!</strong>
						</div>
						";
			}
			else
			{
				$role=0;
				while($row = mysqli_fetch_array($retval))
				{
					$role=$row['Role'];
					if(!isset($_SESSION)) 
					{ 
						session_start(); 
					}
					$_SESSION[$role] = $uname;
					echo "<script language='javascript'>window.location='$role/$role.php';</script>"; 
				}
			}	
		}
	}

	echo "
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  			<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
 			<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>

		</body>
		</html>
	"
?>