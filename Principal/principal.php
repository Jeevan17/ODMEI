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
?>
<!--***********************************************-->
<!--HTML Code-->
<!DOCTYPE html>
<html lang='en'>
	<head>
	  <title>Principal</title>
	  <meta charset='utf-8'>
	  <meta name='viewport' content='width=device-width, initial-scale=1'>
	  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
	</head>
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
					<input type='text' class='form-control' id='rno' placeholder='eg:- 160114733313' name='rollno' required style=' width: 200px;     display: initial;'>
					<input type='submit' value='Search' name='submit' class='btn ml-3 btn-outline-primary btn-sm'style='display: initial;'>
				</form>
			</center>
<!--***********************************************-->
<?php
	if(isset($_POST["submit"]))
	{
		if($_POST['rollno']!=null)
		{
			//session_start();
			if(!isset($_SESSION['principal'])){
				echo "<script language='javascript'>window.location='index.php';</script>";
			}
			$rno = $_POST['rollno'];
			$sql = "select * from student where RollNumber='$rno'";
			$retval = mysqli_query($conn, $sql);
			if(! $retval )
			{
				echo "<script>alert('Entered RollNo does not exist!')</script>";
				die('Could not get data: ' . mysqli_error());
			}
							
			echo "
				<hr>
				<div class='container'>
					<div class='row'>
						<div class='col-sm-3'>
							<ul class='nav nav-pills flex-column' role='tablist'>
								<li class='nav-item'>
									<a class='nav-link active' data-toggle='pill' href='#admission'>Admission Details</a>
								</li>
								<li class='nav-item'>
									<a class='nav-link' data-toggle='pill' href='#Attendance'>Attendance</a>
								</li>
								<li class='nav-item'>
									<a class='nav-link' data-toggle='pill' href='#marks'>Marks</a>
								</li>
								<li class='nav-item'>
									<a class='nav-link' data-toggle='pill' href='#library'>Library</a>
								</li>
								<li class='nav-item'>
									<a class='nav-link' data-toggle='pill' href='#placement'>Placement</a>
								</li>
							<ul>
						</div>
						<div class='col-sm-8'>
							<div class='tab-content'>
								<div id='admission' class='container tab-pane active'>";
									while($row = mysqli_fetch_array($retval))
									{
										echo "<h1>Admission Details</h1>
										<table class='table'>
											<tbody>
												<tr>
													<th rowspan='5'><img src='data:image/jpeg;base64,".base64_encode( $row['Photo'] )."' width=150px height=200px /></th>
													<th style='padding: 5px;font-size: 20px;'>Name</th>
													<td style='padding: 10px;font-size: 20px;'>{$row['FirstName']}"." "."{$row['LastName']}</td>
													<tr>
														<th style='padding: 5px;font-size: 20px;'>Roll number</th>
														<td style='padding: 10px;font-size: 20px;'>{$row['RollNumber']}</td>
													</tr>
													<tr>
														<th style='padding: 5px;font-size: 20px;'>Admission No</th>
														<td style='padding: 10px;font-size: 20px;'>{$row['AdmissionNumber']}</td>
													</tr>
													<tr>
														<th style='padding: 5px;font-size: 20px;'>Phone Number</th>
														<td style='padding: 10px;font-size: 20px;'>{$row['PhoneNumber']}</td>
													</tr>
													<tr>
														<th style='padding: 5px;font-size: 20px;'>Email Id</th>
														<td style='padding: 10px;font-size: 20px;'>{$row['Email']}</td>
													</tr>
												</tr>
												
											</tbody>
										</table>";
									}
								echo "</div>
								<div id='Attendance' class='container tab-pane fade'>
								    <h1>Attendance Details<h1>";

									$sql="SELECT * from attendance where RollNumber='$rno'";
									$retval = mysqli_query($conn, $sql);
									echo "
										<table class='table'>
											<tbody>
											<tr>
												<th style='padding: 5px;font-size: 20px;'>Year and Sem</th>
												<th style='padding: 5px;font-size: 20px;'>Attendance</th>
											</tr>";
										while($row = mysqli_fetch_array($retval))
										{
											echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['YearandSem']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Attendance']}</td>
											</tr>
											";
										}
									echo"
										</tbody>
										</table>
								    </div>
								    <div id='menu2' class='container tab-pane fade'><br>
								      
								    </div>
								</div>
							</div>
						</div>
					</div>";
		}
	}
	echo "
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
			  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
			</body>
		</html>
	";
?>