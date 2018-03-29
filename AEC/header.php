<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>AEC</title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0-beta.3/lux/bootstrap.min.css">
		<style type="text/css">
			table.table-bordered{
			    border:1px solid rgba(0, 0, 0, .2);//#ff0040;
			    margin-top:20px;
			}
			table.table-bordered > thead > tr > th{
			    border:1px solid rgba(0, 0, 0, .2);
			}
			table.table-bordered > tbody > tr > td{
			    border:1px solid rgba(0, 0, 0, .2);
			}
			table.table-bordered > tbody > tr > th{
			    border:1px solid rgba(0, 0, 0, .2);
			}
			select.form-control{
				padding-left: 0px;
				padding-right: 0px;
			}
		</style>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="#"><img class='img-fluid' src='../images/header.jpg'></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarColor03">
					<ul class="navbar-nav mr-auto ">
						<?php
							$urls = array(
							'Attendance' => 'AEC.php',
							'Admission Details' => 'Admission_details.php',
							'Faculty Details' => 'faculty_details.php',
							);
							//Other
							$dropdownurls = array(
								'Mid Marks' => 'Mid_marks.php',
								'Prepare Time Table' => 'timetable.php',
								'Staff Registry' => 'staff_teaches_courses.php',
								'Course Details' => 'course_details.php',
								'Add Timeperiod' => 'timeperiod.php'
							);
							foreach ($urls as $name => $url) {
								echo "<li ".(($currentPage === $name) ?"class='nav-item active' ":"class='nav-item'")."><a class='nav-link' href='$url'>$name</a></li>";
							}
							if ($currentPage == 'other')
							{
								$a = "class='nav-item dropdown active'";
							}
							else
							{
								$a = "class='nav-item dropdown'";
							}
							echo "<li $a>";
							?>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 76px;">Other</a>
						    <div class="dropdown-menu">
						    
						 <?php
							foreach ($dropdownurls as $name => $url) {
								echo "
									<div class='dropdown-divider'></div>
									<a class ='dropdown-item' href='$url'>$name</a>
									";
							}
						?>
							</div>
						</li>
						
						<li class="nav-item">
				      		<a class="nav-link btn btn-outline-success" href='../index.php'>Logout</a>
				      	</li>
				    </ul>
				</div>
			</nav>
		</header>
		<div class='tab-content'>
			<div class='container-fluid tab-pane active text-primary'><br>
		