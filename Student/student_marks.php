<?php

	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$uname=$_SESSION['student'];
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
			  <title>$uname</title>
			  <meta charset='utf-8'>
			  <meta name='viewport' content='width=device-width, initial-scale=1'>
			  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
			  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
			  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
			</head>
			";
	echo "
			<body>
			
				<div class='container pt-2'>
				  	<div class='row'>
				  		<div class='col-sm-2'>
				  		</div>
				  		<div class='col-sm-8'>
				  			<center>
				  			<!--h5 class='text-primary'> Chaitanya Bharathi Institute of Technology(Autonomous)<br>
				  			<small class='text-info'>Accredited by NBA & NAAC, Approved by A.I.C.T.E., New Delhi, Affliated to Osmania University<br> Chaityana Bharathi(PO),Kokapeta(village), Gandipet, Hyderabad -500075, Telangana, India</small></h5-->
				  			<img class='img-fluid' src='../images/header.jpg'>
				  			</center>
				  		</div>
				  		<div class='col-sm-2'>
				  		</div>
				  	</div>
				</div>
				<br>
				<div class='container pt-3'>
					<div class='row'>
				  	<div class='col-sm-8'>
				  		<ul class='nav nav-tabs nav-justified'>
						    <li class='nav-item'>
						      <a class='nav-link ' href='Student.php'>Attendance</a>
						    </li>
						    <li class='nav-item'>
						      <a class='nav-link active' href='student_marks.php'>Marks Details</a>
						    </li>
						    <li class='nav-item'>
						      <a class='nav-link' href='student_admission.php'>Admission Details</a>
						    </li>
						    <li class='nav-item'>
						      <a class='nav-link' href='student_placement.php'>Placement Details</a>
						    </li>
					  	</ul>
					  	<div class='tab-content'>
					  		<div class='container tab-pane active'><br>
					  			
    						</div>
    					</div>
				  	</div>
				  	<div class='col-sm-4 border border-primary border-right-0 border-bottom-0 border-top-0'>
				  		<div class='row'>
				  			<div class='col-sm-4'>
				  			</div>
			  				<img src='../images/jeevan.jpg' class='rounded' alt='photo' width='150px' height='200px'>
				  			<div class='col-sm-4'>
				  			</div>
				  		</div>
				  		<br>
				  		<table class='table'>
				  			<tbody>
						      <tr>
						        <td><h5>Name</h5></td>
						        <td><h6>Jeevan Gandla</h6></td>
						      </tr>
						        <tr>
						        <td><h5>RollNumber</h5></td>
						        <td><h6>160114733313</h6></td>
						      </tr>
						      <tr>
						        <td><h5>Phone Number</h5></td>
						        <td><h6>9000583295</h6></td>
						      </tr>
						      <tr>
						        <td><h5>Email ID</h5></td>
						        <td><h6>jeevan.gandla17@gmail.com</h6></td>
						      </tr>
						      <tr>
						        <td><h5>Attendance</h5></td>
						        <td><h6>75%</h6></td>
						      </tr>
						      <tr>
						        <td><h5>CGPA</h5></td>
						        <td><h6>7.66</h6></td>
						      </tr>
						    </tbody>
					  </table>
				  	</div>
				</div>
			";
	echo "
			</body>
	</html>
	";
?>