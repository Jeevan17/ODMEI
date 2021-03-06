<?php 
	$material_count = null;
	$sql = "SELECT * FROM notification WHERE Rollnumber = '$uname' AND Type='Material'";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$material_count = mysqli_num_rows($retval);
	}
	
	$news_count = null;
	$sql = "SELECT * FROM notification WHERE Rollnumber = '$uname' AND Type='News'";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$news_count = mysqli_num_rows($retval);
	}

	$enroll_count = null;
	$sql = "SELECT * FROM notification WHERE Rollnumber = '$uname' AND Type='Enroll'";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$enroll_count = mysqli_num_rows($retval);
	}

	$feedback_count = null;
	$sql = "SELECT * FROM notification WHERE Rollnumber = '$uname' AND Type='Feedback'";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$feedback_count = mysqli_num_rows($retval);
	}

	$count = (int)$material_count + (int)$news_count + (int)$enroll_count + (int)$feedback_count;
	if ($count == 0)
	{
		$count = null;
	}
?>

<!DOCTYPE html>
<html lang='en'>
	<head>
		<title><?php echo "$uname";?></title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/lux/bootstrap.min.css">
		<style type="text/css">
			table.table-bordered{
			    border:1px solid rgba(0, 0, 0, .1);//#ff0040;
			    margin-top:20px;
			}
			table.table-bordered > thead > tr > th{
			    border:1px solid rgba(0, 0, 0, .1);
			}
			table.table-bordered > tbody > tr > td{
			    border:1px solid rgba(0, 0, 0, .1);
			}
			table.table-bordered > tbody > tr > th{
			    border:1px solid rgba(0, 0, 0, .1);
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
							'Home' => 'Student.php',
							'Attendance' => 'Attendance.php',
							'Marks Details' => 'student_marks.php'
							);
							//Other
							$dropdownurls = array(
								'Admission Details' => 'student_admission.php',
								'Placement Details' => 'placement.php',
								'Material' => 'material.php',
								'News' => 'news.php',
								'Enroll Courses' => 'Enroll_Courses.php',
								'Achievements' => 'student_achievements.php',
								'Feedback' => 'feedback.php'
							);
							foreach ($urls as $name => $url) {
								echo "<li ".(($currentPage === $name) ?"class='nav-item active' ":"class='nav-item'")."><a class='nav-link' href='$url'>$name</a></li>";
							}
							if ($currentPage == 'other')
							{
								$a = "class='nav-item dropdown active '";
							}
							else
							{
								$a = "class='nav-item dropdown'";
							}
							echo "<li $a>";
							?>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 76px;">Other <span class='badge badge-pill badge-danger'><?php echo "$count";?></span></a>
						    <div class="dropdown-menu">
						    
						 <?php
							foreach ($dropdownurls as $name => $url)
							{
								if($name == 'Material' && $material_count > 0)
								{
									echo "
										<div class='dropdown-divider'></div>
										<a class ='dropdown-item' href='$url'>$name <span class='badge badge-pill badge-danger'>$material_count</span></a>
									";
								}
								elseif ($name == 'News' && $news_count > 0)
								{
									echo "
										<div class='dropdown-divider'></div>
										<a class ='dropdown-item' href='$url'>$name <span class='badge badge-pill badge-danger'>$news_count</span></a>
									";
								}
								elseif ($name == 'Enroll Courses' && $enroll_count > 0)
								{
									echo "
										<div class='dropdown-divider'></div>
										<a class ='dropdown-item' href='$url'>$name <span class='badge badge-pill badge-danger'>$enroll_count</span></a>
									";
								}
								elseif ($name == 'Feedback' && $feedback_count > 0)
								{
									echo "
										<div class='dropdown-divider'></div>
										<a class ='dropdown-item' href='$url'>$name <span class='badge badge-pill badge-danger'>$feedback_count</span></a>
									";
								}
								else
								{
									echo "
										<div class='dropdown-divider'></div>
										<a class ='dropdown-item' href='$url'>$name</a>
									";
								}
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
			<div class='container tab-pane active text-primary'><br>
		