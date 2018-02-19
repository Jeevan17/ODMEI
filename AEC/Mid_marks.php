<?php
	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');
	session_start();
	if(!isset($_SESSION['AEC'])){
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
	  <title>AEC</title>
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
			  	<div class='col-sm-12	'>
			  		<ul class='nav nav-tabs nav-justified'>
					    <li class='nav-item'>
							<a class='nav-link ' href='AEC.php'>Attendance</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link ' href='Admission_details.php'>Admission Details</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link active' href='Mid_marks.php'>Mid Marks</a>
						</li>
					</ul>
					<div class='col-sm-8'>
						<div class='tab-content'>
							<div id='Add_marks' class='container tab-pane active'>
								<form>
									<div class='row'>
										<div class="col-sm-1 pt-4">
											Date: 
										</div>
										<div class="col-sm-4 pt-3">
											<input class="form-control" type="date" placeholder="" id="date" required value="<?php echo date("Y-m-d");?>">
										</div>
										<div class="col-sm-2 pt-4">
											Program: 
										</div>
										<div class="col-sm-4 pt-3">
											<select class="form-control" id="Program">
											    <option selected="selected">BE</option>
											    <option>MBA</option>
											    <option>MCA</option>
											</select>
										</div>
									</div>
									<br>
									<div class='row'>
										<div class="col-sm-1 pt-2">
											Year: 
										</div>
										<div class="col-sm-4">
											<select class="form-control" id="Year">
											    <option>1</option>
											    <option>2</option>
											    <option>3</option>
												<option selected="selected">4</option>
											</select>
										</div>
										<div class="col-sm-2 pt-2">
											Semester: 
										</div>
										<div class="col-sm-4">
											<select class="form-control" id="Semester">
											    <option>1</option>
											    <option selected="selected">2</option>
											</select>
										</div>
										</div>
											<br>
											<div class='row'>
											<div class="col-sm-1 pt-2">
												Branch: 
											</div>
											<div class="col-sm-4">
												<select class="form-control" id="Branch">
												<option selected="selected">CSE</option>
											    <option>ECE</option>
											    <option>IT</option>
												</select>
											</div>
											<div class="col-sm-2 pt-2">
												Section: 
											</div>
											<div class="col-sm-4">
												<select class="form-control" id="Section">
												    <option>1</option>
												    <option selected="selected">2</option>
												    <option>3</option>
												</select>
											</div>
										</div>
								</form>
							</div>
						</div>
					</div>
					<br>
					<button type="button" class="btn btn-outline-success" onclick="loadDetails()">Get Details</button>
					<div id='getdet'>
					</div>
		<script>
			function loadDetails()
			{
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function()
				{
			    	if (this.readyState == 4 && this.status == 200)
			    	{
			    	  document.getElementById("getdet").innerHTML = xhttp.responseText;
              		}
				};
				var program = document.getElementById("Program").value;
				var year = document.getElementById("Year").value;
				var semester = document.getElementById("Semester").value;
				var branch = document.getElementById("Branch").value;
				var section = document.getElementById("Section").value;
				var date = document.getElementById("date").value;
				xhttp.open("POST", "get_details.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("year="+year+"&program="+program+"&branch="+branch+"&section="+section+"&semester="+semester);
			}
		</script>

		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>