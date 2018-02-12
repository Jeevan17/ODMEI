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
?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<title><?php $uname?></title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
		<link rel='stylesheet' href='../style.css'>
		<!--Import materialize.css-->
      	<!--link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/-->
		<!--Import Google Icon Font-->
      	<!--link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    	<style type="text/css">
    		.background{
    			background: #ff6666;
    		}
    	</style!-->
    </head>
	<body>
		<!--ul id="slide-out" class="side-nav">
	        <li>
	        	<div class="user-view">
	        		<div class="background">
	            	</div>
			        <a href="#!user"><img class="circle" src="../images/jeevan.jpg"></a>
			        <a href="#!name"><span class="white-text name">Jeevan Gandla</span></a>
			        <a href="#!email"><span class="white-text email">jeevan.gandla17@gmail.com</span></a>
	        	</div>
	        </li>
	        <li>
	        	<a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a>
	        </li>
	        <li>
	        	<a href="#!">Second Link</a>
	        </li>
	        <li>
	        	<div class="divider"></div>
	        </li>
	        <li>
	        	<a class="subheader">Subheader</a>
	        </li>
	        <li>
	        	<a class="waves-effect" href="#!">Third Link With Waves</a>
	        </li>
	    </ul>
	    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a-->


	    <!--**********************************-->
		<div class='wrapper'>
    		<Sidebar Holder>
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
		
		<div class='container pt-2' >
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
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	    
	    <!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../js/materialize.min.js"></script>

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