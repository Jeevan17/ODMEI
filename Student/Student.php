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
	$sql = "select * from student where RollNumber='$uname'";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$photo = $row['Photo'];
		$name = $row['FirstName']." ".$row['LastName'];
		$rno = $uname;
		$phno = $row['PhoneNumber'];
		$email = $row['Email'];
	}        			
?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<title><?php $uname?></title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0-beta.3/lux/bootstrap.min.css">
		<link rel='stylesheet' href='../style.css'>
    </head>
	<body>
		<header id="home">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="#"><img class='img-fluid' src='../images/header.jpg'></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarColor03">
					<ul class="navbar-nav mr-auto ">
				    	<li class="nav-item active">
				        	<a class="nav-link" href="Student.php">Home <span class="sr-only">(current)</span></a>
				      	<li>
				      	<li class="nav-item">
				        	<a class="nav-link" href="Attendance.php">Attendance</a>
				      	</li>
				      	<li class="nav-item">
				        	<a class="nav-link" href="student_marks.php">Marks Details</a>
				      	</li>
				      	<li class="nav-item">
				        	<a class="nav-link" href="student_admission.php">Admission Details</a>
				      	</li>
				      	<li class="nav-item">
				        	<a class="nav-link" href="student_placement.php">Placement Details</a>
				      	</li>
				    </ul>
				</div>
			</nav>
		</header>
		
		<table class="table table-hover">
			<thead>
		    	<tr>
			      <th scope="col">Type</th>
			      <th scope="col">Column heading</th>
			      <th scope="col">Column heading</th>
			      <th scope="col">Column heading</th>
			    </tr>
		  	</thead>
		  	<tbody>
			    <tr>
			      <th scope="row">Active</th>
			      <td>Column content</td>
			      <td>Column content</td>
			      <td>Column content</td>
			    </tr>
		  	</tbody>
		</table> 
			<div class='container pt-3'>
				<div class='row'>
				  	<div class='col-sm-12'>
				  		
					  	<div class='tab-content'>
					  		<div class='container tab-pane active'><br>
					  			<div class='table-responsive'>
						  			<table class='table table-bordered table-hover'>
						  				<thead>
									      <tr>
									        <th class='text-success'>Date</th>
									        <th class='text-success'>1<br>(09:40-10:30)</th>
									        <th class='text-success'>2<br>(10:30-11:20)</th>
									        <th class='text-success'>3<br>(11:20-12:10)</th>
									        <th class='text-success'>4<br>(12:10-01:00)</th>
									        <th class='text-success'>5<br>(01:35-02:25)</th>
									        <th class='text-success'>6<br>(02:25-03:15)</th>
									        <th class='text-success'>7<br>(03:15-04:05)</th>
									      </tr>
									    </thead>
									    <tbody>
									      
									      <tr>
									        <td>18-01-2018</td>
									        <td>Present</td>
									        <td>Present</td>
									        <td>-</td>
									        <td>-</td>
									        <td>Absent</td>
									        <td>Absent</td>
									        <td>-</td>
									      </tr>
									      <tr>
									        <td>18-01-2018</td>
									        <td>Present</td>
									        <td>-</td>
									        <td>Present</td>
									        <td>-</td>
									        <td>Absent</td>
									        <td>-</td>
									        <td>Absent</td>
									      </tr>
									      <tr>
									        <td>18-01-2018</td>
									        <td>Present</td>
									        <td>-</td>
									        <td>Present</td>
									        <td>-</td>
									        <td>Absent</td>
									        <td>Absent</td>
									        <td>-</td>
									      </tr>
									      <tr>
									        <td>18-01-2018</td>
									        <td>-</td>
									        <td>Absent</td>
									        <td>Absent</td>
									        <td>Present</td>
									        <td>Present</td>
									        <td>-</td>
									        <td>-</td>
									      </tr>
									      <tr>
									        <td>18-01-2018</td>
									        <td>-</td>
									        <td>Present</td>
									        <td>Present</td>
									        <td>-</td>
									        <td>Absent</td>
									        <td>Absent</td>
									        <td>-</td>
									      </tr>
									    </tbody>
									</table>
								</div>
							</div>
						</div>
				  	</div>
				</div>
			</div>
		</div>
		
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>

		<script>
			function openNav() {
			    document.getElementById("mySidenav").style.width = "400px";
			    document.getElementById("main").style.marginLeft = "400px";
			    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
			}

			function closeNav() {
			    document.getElementById("mySidenav").style.width = "0";
			    document.getElementById("main").style.marginLeft= "0";
			    document.body.style.backgroundColor = "white";
			}
		</script>
	</body>
</html>