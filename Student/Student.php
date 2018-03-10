<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$uname=$_SESSION['student'];

	$sql = "SELECT * FROM student INNER JOIN bsp_code ON student.BSP = bsp_code.BSP WHERE student.RollNumber=$uname";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$photo = $row['Photo'];
		$name = $row['FirstName']." ".$row['LastName'];
		$rno = $uname;
		$phno = $row['phoneNumber'];
		$email = $row['Email'];
		$batch = $row['CBatch'];
		$program = $row['Program'];
		$branch = $row['Branch'];
		$section = $row['Section'];
		$yands = $row['CurrentYandS'];
	}
	$sql = "SELECT TotalAttended,TotalClassesHeld FROM attendance WHERE RollNumber='$rno' AND 	Timeperiod=(SELECT max(id) FROM timeperiod)";
	$retval = mysqli_query($conn, $sql);
	$attendance = 0;
	while($row = mysqli_fetch_array($retval))
	{
		$attendance = $row['TotalAttended']/$row['TotalClassesHeld'] * 100;
	}
?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<title><?php echo "$uname";?></title>
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
				    	<li class="nav-item active">
				        	<a class="nav-link" href="Student.php">Home</a>
				      	</li>
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
				<div class="row">
					<div class="col-sm-6">
						<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
							<tbody>
								<tr>
									<th rowspan='7'>
										<?php 
											echo "
						        			<img src='data:image/jpeg;base64,".base64_encode( $photo )."' alt='photo' height='150' width='120'/> 
						        			";
						        		?>
					        		</th>
								    <th scope="row">Name</th>
								    <td><?php echo "$name" ?></td>
									<tr>
								      <th scope="row">Roll Number</th>
								      <td><?php echo "$rno" ?></td>
								    </tr>
									<tr>
								      <th scope="row">Division</th>
								      <td><?php echo "$program $yands $branch-$section($batch)" ?></td>
								    </tr>
									<tr>
								      <th scope="row">Phone No</th>
								      <td><?php echo "$phno" ?></td>
								    </tr>
									<tr>
									  <th scope="row">EMAIL ID</th>
								      <td><?php echo "$email" ?></td>
								    </tr>
									<tr>
								      <th scope="row">ATTENDANCE</th>
								      <td><?php echo "$attendance" ?></td>
								    </tr>
								    <tr>
								      <th scope="row">CGPA</th>
								      <td><?php echo "$name" ?></td>
								    </tr>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>