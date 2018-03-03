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
				        	<a class="nav-link" href="Student.php">Home</a>
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
				      	<li class="nav-item">
				      		<a class="nav-link btn btn-outline-success" href='../index.php'>Logout</a>
				      	</li>
				    </ul>
				</div>
			</nav>
		</header>
		
		<div class='tab-content'>
			<div class='container tab-pane active text-primary'><br>
				<br>
				<center>
					<?php 
						echo "
        				<img src='data:image/jpeg;base64,".base64_encode( $photo )."' width='150px' height='150px' class='img-thumbnail' alt='photo' /> 
        			";
        			?>
				</center>
				<table class="table table-bordered table-hover table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
					<tbody>
						<tr >
					      <th scope="row"><h3>Name</h3></th>
					      <td><h4><?php echo "$name" ?></h4></td>
					    </tr>
						<tr >
					      <th scope="row"><h3><h3>Roll Number</h3></h3></th>
					      <td><h4><?php echo "$rno" ?></h4></td>
					    </tr>
						<tr >
					      <th scope="row"><h3>Phone No</h3></th>
					      <td><h4><?php echo "$phno" ?></h4></td>
					    </tr>
						<tr >
					      <th scope="row"><h3>EMAIL ID</h3></th>
					      <td><h4><?php echo "$email" ?></h4></td>
					    </tr>
						<tr >
					      <th scope="row"><h3>ATTENDANCE</h3></th>
					      <td><h4><?php echo "$name" ?></h4></td>
					    </tr>
						<tr >
					      <th scope="row"><h3>CGPA</h3></th>
					      <td><h4><?php echo "$name" ?></h4></td>
					    </tr>
					</tbody>
				</table>
			</div>
		</div>
		
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>