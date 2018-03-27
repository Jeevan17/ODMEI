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
		$temp = $_POST['course'];
		if ($temp == '-')
		{
			
		}
		else
		{
			if($temp == 'Placement' || $temp == 'Sudhee' || $temp == 'Shruthi')
			{
				echo "<h3><mark>$temp</mark></h3>";
				$sql = "SELECT BSP FROM bsp_code WHERE Branch='$branch' AND Program = '$program' AND Section='$section'";
				$retval = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_array($retval))
				{
					$bsp = $row['BSP'];
				}

				$sql="SELECT RollNumber,FirstName,LastName FROM student where student.CurrentYandS='$year/4 Sem-$semester' AND BSP='$bsp'";
				$retval = mysqli_query($conn, $sql);
				echo "
					<hr>
					<div class='row'>
						<div class='col'>
							";
							while($row = mysqli_fetch_array($retval))
							{
								echo "
									<br><input type='checkbox' name='rollnumber' id='{$row['RollNumber']}' value='{$row['RollNumber']}' checked/>{$row['RollNumber']}--{$row['FirstName']} {$row['LastName']}
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
					<br>
					";
			}
			else
			{
				$Course = explode('--', $temp);

				echo "<h3><mark>$Course[1]</mark></h3>";
				$sql="SELECT student.RollNumber,FirstName,LastName FROM student_enroll_courses INNER JOIN student ON student.RollNumber = student_enroll_courses.RollNumber where student_enroll_courses.YearandSem='$year/4 Sem-$semester' AND student_enroll_courses.CourseID='$Course[0]' AND student_enroll_courses.Timeperiod=(SELECT max(timeperiod.id) FROM timeperiod)";
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
									<br><input type='checkbox' name='rollnumber' id='{$row['RollNumber']}' value='{$row['RollNumber']}' checked/>{$row['RollNumber']}--{$row['FirstName']} {$row['LastName']}
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
					<br>
					";
			}
		}	
	}
	
?>