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
?>			
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
					<div id='admission' class='container tab-pane active'>
						
						<?php
						while($row = mysqli_fetch_array($retval))
						{ ?>
						
							<h1>Admission Details</h1>
							<table class='table'>
								<tbody>
									<tr>
										<?php echo"
										<th rowspan='5'><img src='data:image/jpeg;base64,".base64_encode( $row['Photo'] )."' width=150px height=200px /></th>";
										?>
										<th style='padding: 5px;font-size: 20px;'>Name</th>
										<td style='padding: 10px;font-size: 20px;'>
											<?php echo "{$row['FirstName']}"." "."{$row['LastName']}" ?>
										</td>
										
										<tr>
											<th style='padding: 5px;font-size: 20px;'>Roll number</th>
											<td style='padding: 10px;font-size: 20px;'>
												<?php echo "{$row['RollNumber']}";?>
											</td>
										</tr>
										<tr>
											<th style='padding: 5px;font-size: 20px;'>Admission No</th>
											<td style='padding: 10px;font-size: 20px;'>

												<?php echo "{$row['AdmissionNumber']}"; ?>
											</td>
										</tr>
										<tr>
											<th style='padding: 5px;font-size: 20px;'>Phone Number</th>
											<td style='padding: 10px;font-size: 20px;'>
												<?php echo "{$row['PhoneNumber']}"; ?>	
											</td>
										</tr>
										<tr>
											<th style='padding: 5px;font-size: 20px;'>Email Id</th>
											<td style='padding: 10px;font-size: 20px;'>
												<?php echo "{$row['Email']}"; ?>
											</td>
										</tr>
									</tr>
								</tbody>
							</table>
				  	<?php 
				  		} 
				  	?>
					</div>
					<div id='Attendance' class='container tab-pane fade'>
					    <h1>Attendance Details<h1>
						<?php 
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
											$Attendance=round(($row['TotalAttended']/$row['TotalClassesHeld'])*100);
											echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['YearandSem']}</td>
												<td style='padding: 10px;font-size: 20px;'>$Attendance</td>
											</tr>
											";
										}
								echo"
									</tbody>
								</table>
					</div>";
					?>
					<div id='marks' class='container tab-pane fade'>
						<?php
							$sql="SELECT * FROM `student_marks_grade` WHERE RollNumber='$rno' ORDER by YearandSem";
							$retval = mysqli_query($conn, $sql);
							echo "
								<table class='table'>
									<tbody>
										<tr>
											<th style='padding: 5px;font-size: 20px;'>Year and Sem</th>
											<th style='padding: 5px;font-size: 20px;'>SGPA</th>
										</tr>";
										$CGPA =0;
										$count=0;
										while($row = mysqli_fetch_array($retval))
										{
											$CGPA = $row['SGPA'] + $CGPA;
											$count++;
											echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['YearandSem']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['SGPA']}</td>
											</tr>
											";
										}
										$CGPA=$CGPA/$count;
								echo"
										<tr>
											<th style='font-size: 20px;' class='text-muted'>CGPA</th>
											<td style='font-size: 20px;' class='text-primary'>$CGPA</td>
										</tr>
									</tbody>
								</table>
							";
						?>
					</div>
					<div id='marks' class='container tab-pane fade'>
						<?php
							$sql="SELECT * FROM `student_marks_grade` WHERE RollNumber='$rno' ORDER by YearandSem";
							$retval = mysqli_query($conn, $sql);
							echo "
								<table class='table'>
									<tbody>
										<tr>
											<th style='padding: 5px;font-size: 20px;'>Year and Sem</th>
											<th style='padding: 5px;font-size: 20px;'>SGPA</th>
										</tr>";
										$CGPA =0;
										$count=0;
										while($row = mysqli_fetch_array($retval))
										{
											$CGPA = $row['SGPA'] + $CGPA;
											$count++;
											echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['YearandSem']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['SGPA']}</td>
											</tr>
											";
										}
										$CGPA=$CGPA/$count;
								echo"
										<tr>
											<th style='font-size: 20px;' class='text-muted'>CGPA</th>
											<td style='font-size: 20px;' class='text-primary'>$CGPA</td>
										</tr>
									</tbody>
								</table>
							";
						?>
					</div>
					<div id='library' class='container tab-pane fade'>
						<?php
							$sql="SELECT library.Title,CheckedOutDate FROM `student_takes_books`, library where RollNumber='$rno' and library.BookID=student_takes_books.BookID";
							$retval = mysqli_query($conn, $sql);
							echo "
								<table class='table'>
									<tbody>
										<tr>
											<th style='padding: 5px;font-size: 20px;'>Books</th>
											<th style='padding: 5px;font-size: 20px;'>Date</th>
										</tr>";
										$count=0;
										while($row = mysqli_fetch_array($retval))
										{
											$count++;
											echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['Title']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['CheckedOutDate']}</td>
											</tr>
											";
										}
								echo"
										<tr>
											<th style='font-size: 20px;' class='text-muted'>Total</th>
											<td style='font-size: 20px;' class='text-primary'>$count</td>
										</tr>
									</tbody>
								</table>
							";
						?>
					</div>
					<div id='placement' class='container tab-pane fade'>
						<?php
							$sql="SELECT * FROM `student_attend_placements` where RollNumber='$rno'";
							$retval = mysqli_query($conn, $sql);
							echo "
								<table class='table'>
									<tbody>
										<tr>
											<th style='padding: 5px;font-size: 20px;'>Company Name</th>
											<th style='padding: 5px;font-size: 20px;'>Result</th>
										</tr>";
										while($row = mysqli_fetch_array($retval))
										{
											echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['CompanyName']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Result']}</td>
											</tr>
											";
										}
								echo"
									</tbody>
								</table>
							";
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
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