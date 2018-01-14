<?php

	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbit');
   
	session_start();
	if(isset($_SESSION['placement'])) {
		unset($_SESSION['placement']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
	if(isset($_SESSION['principal'])) {
		unset($_SESSION['principal']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
	if(isset($_SESSION['aec'])) {
		unset($_SESSION['aec']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
	
	if(! $conn )
	{
		echo "
			<div class='alert alert-danger'>
				<strong>Not connected to database." . mysqli_error();"</strong>
			</div>";
	}
		echo "
			<!DOCTYPE html>
			<html lang='en'>
				<head>
					<title>CBIT MANAGEMENT SYSTEM</title>

					<!--BootStrap-->
						<meta charset='utf-8'>
						<meta name='viewport' content='width=device-width, initial-scale=1'>
  						<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
  						<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  						<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
 						 <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>

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
								<form method='POST' action='index.php'>
									<div class='form-group'>
									    <label for='usr'>Username</label>
									    <input type='text' class='form-control' id='usr' placeholder='Enter Username' name='username' required>
									</div>
									<div class='form-group'>
									    <label for='pwd'>Password</label>
									    <input type='password' class='form-control' id='pwd' placeholder='Enter Password' name='password' required>
									</div>

									<input type='submit' value='Login' name='submit' class='btn btn-outline-primary btn-block'></h4>
								</form>
					</div>
		";
				
		if(isset($_POST["submit"]))
		{
			if($_POST['username']!=null&&$_POST['password']!=null)
			{				
				$uname = $_POST['username'];
				$pword = $_POST['password'];
				
				//$_SESSION["username"] = $_POST['username'];
				//$_SESSION["password"]= $_POST['password'];
				
				$sql="SELECT * from login where Username='$uname' and Password=Password('$pword');";
				$retval = mysqli_query($conn, $sql);
				if(mysqli_affected_rows($conn)==0)
				{
					
					echo "
						<div class='alert alert-danger'>
							<strong>Invalid User Credentials!</strong>
						</div>
						";
					//echo "<script>alert('Invalid user credentials!! ')</script>";
				}
				else
				{
					$role=0;
					while($row = mysqli_fetch_array($retval))
					{
						//echo "<script>alert('3')</script>";
						$role=$row['Role'];
						switch($role)
						{
							case "Principal":
								session_start();
								$_SESSION['principal'] = 'principal';
								echo "<script language='javascript'>window.location='principal.php';</script>";
								break;
							case "Placement":
								session_start();
								$_SESSION['placement'] = 'placement';
								echo "<script language='javascript'>window.location='placement.php';</script>";
								break;
							case "AEC":
								session_start();
								$_SESSION['aec'] = 'aec';
								echo "<script
								language='javascript'>window.location='aec.php';</script>";
								break;
							case "COE":
								echo "<script language='javascript'>window.location='coe.php';</script>";
								break;
							case "Library":
								echo "<script language='javascript'>window.location='library.php';</script>";
								break;
							case "CSE":
								echo "<script language='javascript'>window.location='cse.php';</script>";
								break;
							case "IT":
								echo "<script language='javascript'>window.location='it.php';</script>";
								break;
						}
					}
				}	
			}
		}

	echo "
		</body>
		</html>
	"
?>