<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}							

	if (array_key_exists('year', $_POST) and array_key_exists('semester', $_POST) and array_key_exists('program', $_POST)  and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST) and array_key_exists('course', $_POST))
	{
		$year=$_POST["year"];
		$branch=$_POST["branch"];
		$section=$_POST["section"];
		$semester=$_POST["semester"];
		$program = $_POST['program'];
		$course = $_POST['course'];
		echo "<h3><mark>$course</mark></h3>";
		$sql = "SELECT courses.CourseID FROM courses WHERE courses.CourseName='$course'";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$CourseID = $row['CourseID'];
		}

		$sql="SELECT RollNumber FROM student_enroll_courses
				where student_enroll_courses.YearandSem='$year/4 Sem-$semester' AND student_enroll_courses.CourseID='$CourseID' AND student_enroll_courses.Timeperiod=(SELECT max(timeperiod.id) FROM timeperiod)";
		$retval = mysqli_query($conn, $sql);
		//echo "<input type='checkbox' onClick='toggle(this)' />Select All";
		echo "
			<hr>
			<div class='row'>
				<div class='col'>
					";
					while($row = mysqli_fetch_array($retval))
					{
						echo "
							<br><input type='checkbox' name='rollnumber' id='{$row['RollNumber']}' value='{$row['RollNumber']}'/>{$row['RollNumber']}
						";
					}
		echo "
				</div>
				<div class='row'>
					<div class='col'>
						<button type='button' class='btn btn-info' onclick='loadAdd()'>Update Attendance</button> 
					</div>
				</div>
			</div>
			";	
	}
	
?>