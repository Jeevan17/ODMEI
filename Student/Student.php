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
		<link rel='stylesheet' href='../style.css'>
    </head>
	<body>
		<div id="mySidenav" class="sidenav">
			<div class="row">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			</div>
			<div class='row'>
				<div class="col">
					<h3>Student Profile</h3>
				</div>
				<div class="col-sm-5">
					<center>
						<a href='../student_login.php' class="btn btn-outline-dark pl-3 pr-3 pt-2 pb-2">Logout</a>
					</center>
				</div>
			</div>
        	<hr>
        	<center>
        		<?php
        			echo "
        				<img src='data:image/jpeg;base64,".base64_encode( $photo )."' width='150px' height='150px' class='rounded-circle' alt='photo' /> 
        			";
        		?>
        	</center>
        	<br>
            <table class='table'>
		  		<tbody>
					<tr>
				    	<td><h5>Name</h5></td>
				        <td><h6><?php echo "$name" ?></h6></td>
				    </tr>
				    <tr>
				    	<td><h5>RollNumber</h5></td>
				        <td><h6><?php echo "$rno" ?></h6></td>
				    </tr>
				    <tr>
				        <td><h5>Phone No</h5></td>
				        <td><h6><?php echo "$phno" ?></h6></td>
				    </tr>
				    <tr>
				        <td><h5>Email ID</h5></td>
				        <td><h6><?php echo "$email" ?></h6></td>
				    </tr>
				    <tr>
				        <td><h5>Attendance</h5></td>
				        <td><h6>75%</h6></td>
				    </tr>
				    <tr>
				        <td><h5>CGPA</h5></td>
				        <td><h6>7.66</h6></td>
				    </tr>
				    <tr>
				    </tr>
				</tbody>
			</table>
          	<!--a href="#">About</a>
		  	<a href="#">Services</a>
		  	<a href="#">Clients</a>
		  	<a href="#">Contact</a-->
		</div>

		<div id="main">
			<div class='container pt-2' >
			  	<div class='row'>
			  		<div class='col-sm-2'>
						<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
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
				  	<div class='col-sm-12'>
				  		<ul class='nav nav-tabs nav-justified'>
						    <li class='nav-item'>
						      <a class='nav-link active' href='Student.php'>Attendance</a>
						    </li>
						    <li class='nav-item'>
						      <a class='nav-link' href='student_marks.php'>Marks Details</a>
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
		
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>

		<script>
			function openNav() {
			    document.getElementById("mySidenav").style.width = "400px";
			    document.getElementById("main").style.marginLeft = "400px";
			}

			function closeNav() {
			    document.getElementById("mySidenav").style.width = "0";
			    document.getElementById("main").style.marginLeft= "0";
			}
		</script>
	</body>
</html>