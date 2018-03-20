<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Principal</title>
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
							'Home' => 'Hod.php',
							'Placement' => 'placement_details.php',
							'Staff Details' => 'staff_details.php'
							);
							//Other
							$dropdownurls = array(
								'' => ''
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
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 76px;">Other</a>
						    <div class="dropdown-menu">
						    
						 <?php
							foreach ($dropdownurls as $name => $url)
							{
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
			<div class='container tab-pane active text-primary'><br>
		