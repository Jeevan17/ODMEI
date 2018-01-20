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
			  <link rel='stylesheet' href='style.css'>
			</head>
			";
	echo "
			<body>
				<div class='wrapper'>
            		<!-- Sidebar Holder -->
            		<nav id='sidebar'>
                		<div id='dismiss'>
                    		<h4>X</h4>
                		</div>
		                <div class='sidebar-header'>
                    		<h3>Student Profile</h3>
                		</div>
                		<div class='pl-5 ml-5'>
	                		<img src='../images/jeevan.jpg' class='rounded-circle' alt='photo' width='150px' height='150px'>
	                    </div>
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
						        <td><h5>Phone No</h5></td>
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
            
		                <ul class='list-unstyled CTAs'>
		                    <li><a href='../student_login.php' class='article'>Logout</a></li>
		                </ul>
		            </nav>
				</div>
		        <div class='overlay'></div>
				
			
				<div class='container pt-2'>
				  	<div class='row'>
				  		<div class='col-sm-2'>
				  			<button type='button' id='sidebarCollapse' class='btn btn-light btn-sm'>
		                		Profile
		                	</button>
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
						      <a class='nav-link ' href='Student.php'>Attendance</a>
						    </li>
						    <li class='nav-item'>
						      <a class='nav-link ' href='student_marks.php'>Marks Details</a>
						    </li>
						    <li class='nav-item'>
						      <a class='nav-link active' href='student_admission.php'>Admission Details</a>
						    </li>
						    <li class='nav-item'>
						      <a class='nav-link' href='student_placement.php'>Placement Details</a>
						    </li>
					  	</ul>
					  	<div class='tab-content'>
					  		<div class='container tab-pane active'><br>
					  			<div class='display-3'><mark>Admission Details</mark></div>
    						</div>
    					</div>
				  	</div>
				</div>
			";
	echo "
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
			  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>

				<!-- jQuery CDN -->
		        <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
		        <!-- Bootstrap Js CDN -->
		        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
		        <!-- jQuery Custom Scroller CDN -->
		        <script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js'></script>

		        <script type='text/javascript'>
		            $(document).ready(function () {
		                $('#sidebar').mCustomScrollbar({
		                    theme: 'minimal'
		                });

		                $('#dismiss, .overlay').on('click', function () {
		                    $('#sidebar').removeClass('active');
		                    $('.overlay').fadeOut();
		                });

		                $('#sidebarCollapse').on('click', function () {
		                    $('#sidebar').addClass('active');
		                    $('.overlay').fadeIn();
		                    $('.collapse.in').toggleClass('in');
		                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
		                });
		            });
		        </script>
			</body>
	</html>
	";
?>