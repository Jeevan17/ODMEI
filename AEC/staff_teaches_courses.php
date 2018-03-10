<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'other';

	include 'header.php';
		
	$sql = "SELECT staff.StaffID,staff.FullName FROM staff";
	$retval = mysqli_query($conn, $sql);																
?>

<form>
	<div class='row'>
		<div class="col-sm-2 pt-2">
			Staff ID and Name: 
		</div>
		<div class="col-sm-4">
			<select class="form-control" id="staff" onchange="loadCourses()">
				<option selected="selected"></option>
				<?php
					while($row = mysqli_fetch_array($retval))
					{
						echo "<option>".$row['StaffID']."-".$row['FullName']."</option>";
					}
				?>
			</select>
		</div>
	</div>
</form>
<br>
<div id="courses"></div>
</div>
<div id="courses2"></div>
</div>
</div>
	<script src="Staff_Courses/staffCourses.js"></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>