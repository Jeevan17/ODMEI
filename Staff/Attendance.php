<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['staff'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Staff';
	$uname=$_SESSION['staff'];
	
	include 'header.php';										
?>
<br>
	<form>
		<div class='row'>
			<div class="col-sm-1 pt-2">
				Date: 
			</div>
			<div class="col-sm-4">
				<input class="form-control" type="date" id="date" required value="<?php echo date("Y-m-d");?>">
			</div>
			<div class="col-sm-1"></div>
			<div class="col-sm-1 pt-2">
				Courses: 
			</div>
			<div class="col-sm-4">
				<?php
					$sql = "SELECT courses.CourseName,courses.CourseID
							FROM courses
							WHERE courses.CourseID IN (SELECT staff_teaches_courses.CourseID FROM staff_teaches_courses WHERE staff_teaches_courses.StaffID='$uname')";
					$retval = mysqli_query($conn, $sql);
					echo "<select class='form-control' id='courses' onchange='loadBSP()'>
							<option selected='selected'>-</option>
						";
					while($row = mysqli_fetch_array($retval))
					{
						echo "<option>".$row['CourseID']."--".$row['CourseName']."</option>";
					}
					echo "</select>";
				?>
			</div>
		</div>
		<br>
		<div id='getBSP'>
		</div>
		<br>
		<!-- <div class='row'>
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
		-->
	</form>
	<br>
</div>
</div>
	<script src='Attendance/staff.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>