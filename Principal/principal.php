<?php
	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');
	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
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
			  <title>Principal</title>
			  <meta charset='utf-8'>
			  <meta name='viewport' content='width=device-width, initial-scale=1'>
			  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
			  <link rel='stylesheet' href='../style.css'>
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
				  		<div class='col-sm-2 pl-5'>
				  			<a href='../index.php' class='btn btn-danger btn-sm'>Logout</a>
				  		</div>
				  	</div>
				</div>
				<br>
				<div class='container pt-3'>
					<div class='row'>
					  	<div class='col-sm-12'>
					  		<ul class='nav nav-tabs nav-justified'>
							    <li class='nav-item'>
							      <a class='nav-link active ' href='principal.php'>Student Details</a>
							    </li>
							    <li class='nav-item'>
							      <a class='nav-link ' href='placement_details.php'>Placement Details</a>
							    </li>
							    <li class='nav-item'>
							      <a class='nav-link ' href='staff_details.php'>Staff Details</a>
							    </li>
							    <!--li class='nav-item'>
							      <a class='nav-link' href='student_placement.php'>Placement Details</a>
							    </li-->
						  	</ul>
						  	<div class='tab-content'>
						  		<div class='container tab-pane active'><br>
						  		<div>

						  		</div>
	    					</div>
	    				</div>
					</div>
				</div>

				<center>
					<form action='principal.php' method='POST'>
							<label for='rno'>Enter Roll Number</label>
							<input type='text' class='form-control' id='rno' placeholder='eg:- 1601abcdefgh' name='rollno' required style=' width: 200px;     display: initial;'>
						<input type='submit' value='Search' name='submit' class='btn ml-3 btn-outline-primary btn-sm'style='display: initial;'>
					</form>
				</center>
				<br><br>
		";
	if(isset($_POST["logout"]))
	{
		//session_name('placement');
		unset($_SESSION['principal']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
	if(isset($_POST["submit"]))
	{
		if($_POST['rollno']!=null)
		{
			//session_start();
			if(!isset($_SESSION['principal'])){
				echo "<script language='javascript'>window.location='index.php';</script>";
			}
			$rno = $_POST['rollno'];
			$sql = "select * from admission where rollno='$rno'";
			$retval = mysqli_query($conn, $sql);
			if(! $retval )
			{
				echo "<script>alert('Entered RollNo does not exist!')</script>";
				die('Could not get data: ' . mysqli_error());
			}
							
			while($row = mysqli_fetch_array($retval))
			{
				echo "<h1>Admission Details:</h1>
					<table border='1'>
					<tr>
						<th rowspan='4'><img src='data:image/jpeg;base64,".base64_encode( $row['Photo'] )."' width=150px height=200px />
						</th>
						<th style='padding: 5px;font-size: 20px;'>Name</th>
						<td style='padding: 10px;font-size: 20px;'>{$row['FirstName']}"." "."{$row['LastName']}</td>
											<tr>
												<th style='padding: 5px;font-size: 20px;'>Roll number</th>
												<td style='padding: 10px;font-size: 20px;'>{$row['RollNo']}</td>
											</tr>
											<tr>
												<th style='padding: 5px;font-size: 20px;'>Admission No</th>
												<td style='padding: 10px;font-size: 20px;'>{$row['AdminNo']}</td>
											</tr>
											<tr>
												<th style='padding: 5px;font-size: 20px;'>Phone Number</th>
												<td style='padding: 10px;font-size: 20px;'>{$row['Phno']}</td>
											</tr>
										
										</tr>
										<tr>
											<th colspan='2' style='padding: 5px;font-size: 20px;'>Father Name</th>
											<td style='padding: 10px;font-size: 20px;'>{$row['FatherName']}</td>
										</tr>
										<tr>
											<th colspan='2' style='padding: 5px;font-size: 20px;'>Father Phno</th>
											<td style='padding: 10px;font-size: 20px;'>{$row['FatherPhno']}</td>
										</tr>
										<tr>
											<th colspan='2' style='padding: 5px;font-size: 20px;'>Address</th>
											<td style='padding: 10px;font-size: 20px;'>{$row['Address']}</td>
										</tr>
										<tr>	
											<th colspan='2' style='padding: 5px;font-size: 20px;'>Graduation</th>
											<td style='padding: 10px;font-size: 20px;'>{$row['Graduation']}</td>
										</tr>
										<tr>
											<th colspan='2' style='padding: 5px;font-size: 20px;'>Branch</th>
											<td style='padding: 10px;font-size: 20px;'>{$row['Branch']}</td>
										</tr>
										<tr>	
											<th colspan='2' style='padding: 5px;font-size: 20px;'>Date of Joining</th>
											<td style='padding: 10px;font-size: 20px;'>{$row['Date of Joining']}</td>
										</tr>
										<tr>
											<th colspan='2' style='padding: 5px;font-size: 20px;'>Email Id</th>
											<td style='padding: 10px;font-size: 20px;'>{$row['email']}</td>
										</tr>
									</table>";
									}
								
								
								echo "<br><br><h1>Attendance Details:<h1>";
								$sql="SELECT CourseId, Coe.Cname, Attendance from coe natural join aec where RollNo='$rno'";
								$retval = mysqli_query($conn, $sql);
								echo "
								<table border='1'>
									<tr>
										<th style='padding: 5px;font-size: 20px;'>Course Id</th>
										<th style='padding: 5px;font-size: 20px;'>Course Name</th>
										<th style='padding: 5px;font-size: 20px;'>Attendance</th>
									</tr>";
									while($row = mysqli_fetch_array($retval))
									{
										echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['CourseId']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Cname']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Attendance']}</td>
											</tr>
										";
									}
								echo"</table>";
								
								
								echo "<br><h1>Marks Details:<h1>";
								$sql="SELECT stu_coe.CourseId, Coe.Cname, Grade 
								from coe join stu_coe on coe.CourseId=stu_coe.CourseId 
								where RollNo='$rno'";
								$retval = mysqli_query($conn, $sql);
								echo "
								<table border='1'>
									<tr>
										<th style='padding: 5px;font-size: 20px;'>Course Id</th>
										<th style='padding: 5px;font-size: 20px;'>Course Name</th>
										<th style='padding: 5px;font-size: 20px;'>Grade</th>
									</tr>";
									while($row = mysqli_fetch_array($retval))
									{
										echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['CourseId']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Cname']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Grade']}</td>
											</tr>
										";
									}
								echo"</table>";
								
								
								echo "<br><h1>Library Details:<h1>";
								$sql="SELECT BookName
										from library join takesbook on library.BookId=takesbook.BookId
										where RollNo='$rno'";
								$retval = mysqli_query($conn, $sql);
								echo "
								<table border='1'>
									<tr>
										<th style='padding: 5px;font-size: 20px;'>Books Taken</th>
									</tr>";
									$count=0;
									while($row = mysqli_fetch_array($retval))
									{
										$count++;
										echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['BookName']}</td>
											</tr>
										";
									}
								echo"<tr><th>Total:$count</th></tr></table>";
								


								echo "<br><h1>Placement Details:<h1>";
								$sql="select CompanyName, Result
										from std_placement_details
										where RollNo='$rno'";
								$retval = mysqli_query($conn, $sql);
								echo "
								<table border='1'>
									<tr>
										<th style='padding: 5px;font-size: 20px;'>Company Name</th>
										<th style='padding: 5px;font-size: 20px;'>Result</th>
									</tr>";
									//$count=0;
									while($row = mysqli_fetch_array($retval))
									{
										//$count++;
										echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['CompanyName']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Result']}</td>
											</tr>
										";
									}
								echo"</table>";
								

								echo "<br><h1>Bus Details:<h1>";
								$sql="SELECT BusNo, SeatNo
										from stu_bus
										where RollNo='$rno'";
								$retval = mysqli_query($conn, $sql);
								echo "
								<table border='1'>
									<tr>
										<th style='padding: 5px;font-size: 20px;'>Bus Number</th>
										<th style='padding: 5px;font-size: 20px;'>Seat Number</th>
									</tr>";
									//$count=0;
									while($row = mysqli_fetch_array($retval))
									{
										//$count++;
										echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['BusNo']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['SeatNo']}</td>
											</tr>
										";
									}
								echo"</table>";	
							}
						}
	echo "
				</center>
				<!--a href='logout.php' class='sub_btn'>Logout</a-->
			</body>
		</html>
	"
		
?>