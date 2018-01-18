<?php

	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');
   
	session_start();
	if(isset($_SESSION['student'])) {
		unset($_SESSION['student']);
		session_destroy();
		echo "<script language='javascript'>window.location='student_login.php';</script>";
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
					<title>Student Login Portal</title>

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
								<form method='POST' action='student_login.php'>
									<div class='form-group'>
									    <label for='usr'>Roll Number</label>
									    <input type='text' class='form-control' id='usr' placeholder='Enter Roll Number' name='username' required>
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
				
				$sql="SELECT * from student_login where RollNumber='$uname' and Password='$pword';";
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
						session_start();
						$_SESSION['student'] = $uname;
						echo "<script language='javascript'>window.location='Student/student.php';</script>";
						
					}
				}	
			}
		}

	echo "
		</body>
		</html>
	"
?>