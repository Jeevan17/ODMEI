<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['hod'];

	include 'header.php';
	$hod_name = explode('_', $uname);

	$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$staff = array();

	$sql = "SELECT staff.FullName, timetable.YearandSem, bsp_code.Program, bsp_code.Branch, bsp_code.Section, timetable.Day, timetable.Timeslot, courses.CourseName FROM timetable NATURAL JOIN staff NATURAL JOIN bsp_code NATURAL JOIN courses WHERE staff.Department='$hod_name[1]' ORDER BY timetable.Day,timetable.Timeslot";
	$data = array();
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		array_push($staff, $row['FullName']);
	}

	foreach ($days as $day)
	{
		foreach ($staff as $name)
		{
			$data[$day][$name] = '-';
		}
	}
	var_dump($data);

	$sql = "SELECT staff.FullName, timetable.YearandSem, bsp_code.Program, bsp_code.Branch, bsp_code.Section, timetable.Day, timetable.Timeslot, courses.CourseName FROM timetable NATURAL JOIN staff NATURAL JOIN bsp_code NATURAL JOIN courses WHERE staff.Department='$hod_name[1]' ORDER BY timetable.Day,timetable.Timeslot";
	$data = array();
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		array_push($data[$row['Day']][$row['FullName']], array($row['CourseName'],$row['YearandSem'],$row['Program'],$row['Branch'],$row['Section']));
	}
	echo "<br><hr>";
	var_dump($data);	
?>


</div>
</div>
		<script src='timetable/timetable.js'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>