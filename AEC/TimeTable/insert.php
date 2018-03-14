<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	
	if (array_key_exists('year', $_POST) and array_key_exists('semester', $_POST) and array_key_exists('program', $_POST)  and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST) and array_key_exists('day', $_POST) and array_key_exists('batch', $_POST) and array_key_exists('staff', $_POST) and array_key_exists('subjects', $_POST))
	{
		$staff = json_decode($_POST['staff']);
		$subjects = json_decode($_POST['subjects']);
		$batch = json_decode($_POST['batch']);
		$year=$_POST["year"];
		$branch=$_POST["branch"];
		$section=$_POST["section"];
		$semester=$_POST["semester"];
		$program = $_POST['program'];
		$day = $_POST['day'];

		$sql = "SELECT BSP FROM bsp_code WHERE Branch='$branch' AND Section='$section' AND Program='$program'";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$BSP = $row['BSP'];
		}

		$timeslot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');
		$day = explode(".", $day);
		for ($i = 0; $i < 7 ; $i++)
		{
			$course = explode("--",$subjects[$i]);
			$sid = explode("--", $staff[$i]);

			if ($course[0] == '-' || $sid[0] == '-' || $batch[$i] == '-')
			{
			}
			else
			{
				if ($batch[$i] == "All (1, 2 and 3)")
				{
					$sql = "INSERT INTO timetable(StaffID, CourseID, YearandSem, BSP, Batch, Day, Timeslot) VALUES ('$sid[0]','$course[0]','$year/4 Sem-$semester','$BSP','0','$day[1]','$timeslot[$i]')";
				    if (mysqli_query($conn, $sql))
					{
						//echo "New record created successfully";
					}
					else
					{
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				}
				else
				{
					$sql = "INSERT INTO timetable(StaffID, CourseID, YearandSem, BSP, Batch, Day, Timeslot) VALUES ('$sid[0]','$course[0]','$year/4 Sem-$semester','$BSP','$batch[$i]','$day[1]','$timeslot[$i]')";
				    	if (mysqli_query($conn, $sql))
						{
							//echo "New record created successfully";
						}
						else
						{
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
				}
			}
		}	
	}
?>