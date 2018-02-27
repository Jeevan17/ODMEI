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

	  <!-- ********bootstrap code********** -->
	  <meta charset='utf-8'>
	  <meta name='viewport' content='width=device-width, initial-scale=1'>
	  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
 	  <!-- ********bootstrap code********** -->

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
							<a class='nav-link active ' href='AEC.php'>Attendance</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link ' href='Admission_details.php'>Admission Details</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link ' href='Mid_marks.php'>Mid Marks</a>
						</li>
					</ul>
					<div class='tab-content'>
						<div class='container tab-pane active'><br>
							<div class='container'>
								<div class='row'>
									<div class='col-sm-3'>
										<ul class='nav nav-pills flex-column' role='tablist'>
											<li class='nav-item'>
												<a class='nav-link active' data-toggle='pill' href='#Add_attendance'>Add Attendance</a>
											</li>
											<li class='nav-item'>
												<a class='nav-link' data-toggle='pill' href='#Update_Attendance'>Update Attendance</a>
											</li>
										</ul>
									</div>
									<div class='col-sm-8'>
										<div class='tab-content'>
											<div id='Add_attendance' class='container tab-pane active'>
												<form>
													<div class='row'>
														<div class="col-sm-1 pt-2">
															Date: 
														</div>
														<div class="col-sm-4">
															<input class="form-control" type="date" placeholder="" id="date" required value="<?php echo date("Y-m-d");?>">
														</div>
														<div class="col-sm-2 pt-2">
															Program: 
														</div>
														<div class="col-sm-4">
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
													<br>
													<div class='row'>
														<table class='table table-bordered'>
															<thead>
																<tr>
																	<th>09:40-10:30</th>
																	<th>10:30-11:20</th>
																	<th>11:20-12:10</th>
																	<th>12:10-01:00</th>
																	<th>01:35-02:25</th>
																	<th>02:25-03:15</th>
																	<th>03:15-04:05</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<th>  
																		<input type="checkbox" name="Attendance" value="09:40-10:30">
																	</th>
																	<th>
																		<input type="checkbox" name="Attendance" value="10:30-11:20">
																	</th>
																	<th>
																		<input type="checkbox" name="Attendance" value="11:20-12:10">
																	</th>
																	<th>
																		<input type="checkbox" name="Attendance" value="12:10-01:00">
																	</th>
																	<th>
																		<input type="checkbox" name="Attendance" value="01:35-02:25">
																	</th>
																	<th>
																		<input type="checkbox" name="Attendance" value="02:25-03:15">
																	</th>
																	<th>
																		<input type="checkbox" name="Attendance" value="03:15-04:05">
																	</th>
																</tr>
															</tbody>
														</table>
													</div>
													<button type="button" class="btn btn-outline-success" onclick="loadRnum()">Get Rollnumbers</button>
												</form>
												<br>
												<div id='rollnumber'>
												</div>
												<div id='test'>
												</div>
											</div>
											<div id='Update_Attendance' class='container tab-pane fade'>
												<form>
													<div class='row'>
														<div class="col-sm-1 pt-2">
															Date: 
														</div>
														<div class="col-sm-4">
															<input class="form-control" type="date" placeholder="" id="date1" required value="<?php echo date("Y-m-d");?>">
														</div>
														<div class="col-sm-2 pt-2">
															Program: 
														</div>
														<div class="col-sm-4">
															<select class="form-control" id="Program1">
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
															<select class="form-control" id="Year1">
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
															<select class="form-control" id="Semester1">
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
															<select class="form-control" id="Branch1">
															    <option selected="selected">CSE</option>
															    <option>ECE</option>
															    <option>IT</option>
															</select>
														</div>
														<div class="col-sm-2 pt-2">
															Section: 
														</div>
														<div class="col-sm-4">
															<select class="form-control" id="Section1">
															    <option>1</option>
															    <option selected="selected">2</option>
															    <option>3</option>
															</select>
														</div>
													</div>
													<br>
													<button type="button" class="btn btn-outline-success" onclick="loadAttendance()">Get Details</button>
												</form>
												<br>
												<div id="LAttendance">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
	    				</div>
	    			</div>
				</div>
			</div>
		</div>

		<script src="AEC.js"></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>