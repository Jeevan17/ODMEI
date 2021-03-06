<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Attendance';

	include 'header.php';										
?>

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
							<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
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
						<button type="button" class="btn btn-outline-success" onclick="loadSubjects()">Get Rollnumbers</button>
					</form>
					<br>
					<div id='subjects'>
					</div>
					<div id='rollnumber'>
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
	<script src="Attendance/AEC.js"></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>