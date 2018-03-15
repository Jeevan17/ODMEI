<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$uname=$_SESSION['student'];
	?>

<!DOCTYPE html>
<html lang='en'>
	<head>
		<title><?php echo "$uname";?></title>
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
				    	<li class="nav-item">
				        	<a class="nav-link" href="Student.php">Home</a>
				      	<li>
				      	<li class="nav-item active">
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
				      		<a class="nav-link btn btn-outline-success" href='../student_login.php'>Logout</a>
				      	</li>
				    </ul>
				</div>
			</nav>
		</header>
		
		<div class='container pt-3'>
			<div class='row'>
				<div class='col-sm-12'>
					<div class='tab-content'>
						<div class='container tab-pane active text-primary'><br>
					  		<table class='table table-bordered table-hover table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
						  		<thead>
									<tr>
										<th class='text-danger'>Date</th>
									    <th class='text-danger'>09:40-10:30</th>
									    <th class='text-danger'>10:30-11:20</th>
									    <th class='text-danger'>11:20-12:10</th>
									    <th class='text-danger'>12:10-01:00</th>
									    <th class='text-danger'>01:35-02:25</th>
									    <th class='text-danger'>02:25-03:15</th>
									    <th class='text-danger'>03:15-04:05</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql = "SELECT dailyattendance.RollNumber,dailyattendance.Date, dailyattendance.Timeslot, dailyattendance.Attendance 
											from dailyattendance 
											where RollNumber='$uname' and dailyattendance.Timeperiod=(SELECT max(timeperiod.ID) from  timeperiod)
											ORDER BY dailyattendance.Date desc,dailyattendance.Timeslot";
										$retval = mysqli_query($conn, $sql);
											
										$data = array();
										$timeslot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');
										while($row = mysqli_fetch_array($retval))
										{
											for ($i=0; $i<7 ; $i++)
											{ 
												$data[$row['Date']][$timeslot[$i]] = '-';
											}
										}
										//var_dump($data);
										$retval = mysqli_query($conn, $sql);
										while($row = mysqli_fetch_array($retval))
										{
											$data[$row['Date']][$row['Timeslot']] = $row['Attendance'];
										}
										foreach ($data as $date => $value)
										{
											echo "
												<tr>
													<td class='text-info'>".date("d-m-Y", strtotime($date))."</div>
											";
											foreach ($value as $time => $attendance)
											{
												echo "
													<td>$attendance</td>
												";	
											}
											echo "</tr>";
										}
									?>
								</tbody>
							<table>
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