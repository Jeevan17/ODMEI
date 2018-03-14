<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['staff'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['staff'];
	if (array_key_exists('YandS', $_POST) and array_key_exists('program', $_POST)  and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST) and array_key_exists('course', $_POST) and array_key_exists('date', $_POST))
	{
		$yands=$_POST["YandS"];
		$branch=$_POST["branch"];
		$section=$_POST["section"];
		$program = $_POST['program'];
		$course = $_POST['course'];

		$date = strtotime($_POST['date']);
		$day = date('l', $date);

		
		$cid = explode("--",$_POST['course']);

		$time_slot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');
		$data = array();
		$sql = "SELECT Timeslot FROM timetable WHERE Day='$day' AND YearandSem = '$yands' AND CourseID='$cid[0]' AND StaffID='$uname' AND timetable.BSP=(SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch='$branch' AND bsp_code.Section='$section' AND bsp_code.Program='$program')";
		$retval = mysqli_query($conn, $sql);
		if (mysqli_num_rows($retval) > 0)
		{
			while($row = mysqli_fetch_array($retval))
			{
				array_push($data, $row['Timeslot']);
			}
			echo "
				<hr>
				<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
					<thead>
						<tr>
							<th>09:40:00-10:30:00</th>
							<th>10:30:00-11:20:00</th>
							<th>11:20:00-12:10:00</th>
							<th>12:10:00-01:00:00</th>
							<th>01:35:00-02:25:00</th>
							<th>02:25:00-03:15:00</th>
							<th>03:15:00-04:05:00</th>
						</tr>
					</thead>
					<tbody>
						<tr>
					";
						$r=0;
						for ($q=0; $q < 7; $q++)
						{
							for(; $r<sizeof($data);$r++)
							{
								if ($data[$r] == $time_slot[$q])
								{
									echo "
										<th>  
											<input type='checkbox' name='Attendance' value='$time_slot[$q]'>
										</th>

									";
									break;
								}
								else
								{
									echo "
										<th>  
											<input type='checkbox' name='Attendance' value='$time_slot[$q]' disabled>
										</th>

									";
								}
							}
						}
			echo "
						</tr>
					</tbody>
				</table>
			";
			$sql="SELECT RollNumber FROM student_enroll_courses where student_enroll_courses.YearandSem='$yands' AND student_enroll_courses.CourseID='$cid[0]' AND student_enroll_courses.Timeperiod=(SELECT max(timeperiod.id) FROM timeperiod)";
			$retval = mysqli_query($conn, $sql);
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
	}
	
?>