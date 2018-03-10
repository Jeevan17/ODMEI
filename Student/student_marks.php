<?php
include '../dataConnections.php'
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
				      	<li class="nav-item">
				        	<a class="nav-link" href="Attendance.php">Attendance</a>
				      	</li>
				      	<li class="nav-item active">
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
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>