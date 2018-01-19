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
					  			<ul class='nav nav-pills nav-justified'>
								    <li class='nav-item'>
								      <a class='nav-link ' href='#11'>1/4 Sem 1</a>
								    </li>
								    <li class='nav-item'>
								      <a class='nav-link ' href='#12'>1/4 Sem 2</a>
								    </li>
								    <li class='nav-item'>
								      <a class='nav-link ' href='#21'>2/4 Sem 1</a>
								    </li>
								    <li class='nav-item'>
								      <a class='nav-link ' href='#22'>2/4 Sem 2</a>
								    </li>
								    <li class='nav-item'>
								      <a class='nav-link ' href='#31'>3/4 Sem 1</a>
								    </li>
								    <li class='nav-item'>
								      <a class='nav-link ' href='#32'>3/4 Sem 2</a>
								    </li>
								    <li class='nav-item'>
								      <a class='nav-link active' href='#41'>4/4 Sem 1</a>
								    </li>
								    <li class='nav-item'>
								      <a class='nav-link ' href='#42'>4/4 Sem 2</a>
								    </li>
						  		</ul>
						  		<div class='tab-content'>
							  		<div class='container tab-pane active'><br>
							  			<div class='table-responsive'>
								  			<table class='table'>
											    <thead>
											      <tr>
											        <th>SlNo</th>
											        <th>Exam Code</th>
											        <th>Subject</th>
											        <th>Month & Year</th>
											        <th>Final Grade</th>
											        <th>Credits</th>
											        <th>Status</th>
											      </tr>
											    </thead>
											    <tbody>
											      <tr>
											        <td>1</td>
											        <td>CS411</td>
											        <td>Artificial Intelligence</td>
											        <td>NOVEMBER 2017</td>
											        <td>C</td>
											        <td>3</td>
											        <td>PASS</td>
											      </tr>
											      <tr>
											        <td>2</td>
											        <td>CS412</td>
											        <td>Distributed Computing</td>
											        <td>NOVEMBER 2017</td>
											        <td>C</td>
											        <td>3</td>
											        <td>PASS</td>
											      </tr>
											      <tr>
											        <td>3</td>
											        <td>CS413</td>
											        <td>Data Mining</td>
											        <td>NOVEMBER 2017</td>
											        <td>C</td>
											        <td>3</td>
											        <td>PASS</td>
											      </tr>
											      <tr>
											        <td>4</td>
											        <td>CS414</td>
											        <td>OOSD</td>
											        <td>NOVEMBER 2017</td>
											        <td>C</td>
											        <td>3</td>
											        <td>PASS</td>
											      </tr>
											      <tr>
											        <td>5</td>
											        <td>CS464</td>
											        <td>Open Source Technologies</td>
											        <td>NOVEMBER 2017</td>
											        <td>B</td>
											        <td>3</td>
											        <td>PASS</td>
											      </tr>
											      <tr>
											        <td>6</td>
											        <td>CS415</td>
											        <td>Data Mining Lab</td>
											        <td>NOVEMBER 2017</td>
											        <td>S</td>
											        <td>2</td>
											        <td>PASS</td>
											      </tr>
											      <tr>
											        <td>7</td>
											        <td>CS416</td>
											        <td>OOSD Lab</td>
											        <td>NOVEMBER 2017</td>
											        <td>B</td>
											        <td>2</td>
											        <td>PASS</td>
											      </tr>
											      <tr>
											        <td>8</td>
											        <td>CS417</td>
											        <td>Project Seminar</td>
											        <td>NOVEMBER 2017</td>
											        <td>B</td>
											        <td>1</td>
											        <td>PASS</td>
											      </tr>
											    </tbody>
											</table>
										</div>
		    						</div>
	    						</div>
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