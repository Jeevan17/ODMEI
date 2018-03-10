<?php

	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');

	session_start();
	if(!isset($_SESSION['staff'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['staff'];
	if(! $conn )
	{
		echo "
			<div class='alert alert-danger'>
				<strong>Not connected to database." . mysqli_error();"</strong>
			</div>";
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
				    	<li class="nav-item">
				        	<a class="nav-link" href="Student.php">Home</a>
				      	</li>
				      	<li class="nav-item active">
				        	<a class="nav-link" href="Attendance.php">Add Attendance</a>
				      	</li>
				      	<li class="nav-item">
				        	<a class="nav-link" href="student_marks.php">Send Meterial</a>
				      	</li>
				      	<li class="nav-item">
				        	<a class="nav-link" href="student_admission.php">Check Feedback</a>
				      	</li>
				      	<li class="nav-item">
				      		<a class="nav-link btn btn-outline-success" href='../index.php'>Logout</a>
				      	</li>
				    </ul>
				</div>
			</nav>
		</header>
		<div class='tab-content'>
			<div class='container tab-pane active text-primary'><br>
				<form>
					<div class='row'>
						<div class="col-sm-1 pt-2">
							Date: 
						</div>
						<div class="col-sm-4">
							<input class="form-control" type="date" placeholder="" id="date" required value="<?php echo date("Y-m-d");?>">
						</div>
						<div class="col-sm-2 pt-2">
							Courses: 
						</div>
						<div class="col-sm-4">
							<?php
								$sql = "SELECT courses.CourseName 
										FROM courses
										WHERE courses.CourseID IN (SELECT staff_teaches_courses.CourseID FROM staff_teaches_courses WHERE staff_teaches_courses.StaffID='$uname')";
								$retval = mysqli_query($conn, $sql);
								echo "<select class='form-control' id='courses' onchange='loadRnum()'>";
								while($row = mysqli_fetch_array($retval))
								{
									echo "
										<option>{$row['CourseName']}</option>
									";
								}
								echo "</select>";
							?>
						</div>
					</div>
					<br>
					<div class='row'>
						<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
							<thead>
								<tr>
									<th>09:40-10:30</th>
									<th>10:30-11:20</th>
									<th>11:20-12:10</th>
									<th>12:10-01:00</th>
									<th>01:35-02:25</th>
									<th>02:25-03:15</th>
									<th>03:15-04:05</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>  
										<input type="checkbox" name="Attendance" value="09:40-10:30">
									</th>
									<th>
										<input type="checkbox" name="Attendance" value="10:30-11:20">
									</th>
									<th>
										<input type="checkbox" name="Attendance" value="11:20-12:10">
									</th>
									<th>
										<input type="checkbox" name="Attendance" value="12:10-01:00">
									</th>
									<th>
										<input type="checkbox" name="Attendance" value="01:35-02:25">
									</th>
									<th>
										<input type="checkbox" name="Attendance" value="02:25-03:15">
									</th>
									<th>
										<input type="checkbox" name="Attendance" value="03:15-04:05">
									</th>
								</tr>
							</tbody>
						</table>
					</div>
					<button type="button" class="btn btn-outline-success" onclick="loadSubjects()">Get Rollnumbers</button>
				</form>
				<br>
				<div id='subjects'>
				</div>
				<div id='rollnumber'>
				</div>
			</div>
		</div>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>