<?php include '../../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['hod'];

	$hod_name = explode('_', $uname);

	$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$time_slot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');

	$data = array();
	foreach ($days as $day)
	{
		foreach ($time_slot as $time)
		{
			$data[$day][$time] = '-';
		}
	}

	
	if (array_key_exists('yands', $_POST) and array_key_exists('program', $_POST) and array_key_exists('section', $_POST))
	{
		$yands = $_POST['yands'];
		$program = $_POST['program'];
		$section = $_POST['section'];

		$sql = "SELECT course_yands.CourseID, Type, courses.CourseName FROM course_yands INNER JOIN courses ON courses.CourseID = course_yands.CourseID WHERE Branch='$hod_name[1]' AND YearandSem='$yands'";
		$retval = mysqli_query($conn, $sql);
		$temp = array();
		while($row = mysqli_fetch_array($retval))
		{
			$temp[$row['Type']][$row['CourseID']] = $row['CourseName'];
		}

		$sql = "SELECT timetable.Day, timetable.Timeslot, courses.CourseName, timetable.StaffID, staff.FullName, timetable.Batch, course_yands.Type FROM timetable INNER JOIN staff ON staff.StaffID = timetable.StaffID INNER JOIN courses ON courses.CourseID = timetable.CourseID INNER JOIN course_yands ON course_yands.CourseID = timetable.CourseID WHERE timetable.YearandSem = '$yands' AND timetable.BSP = (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch='$hod_name[1]' AND bsp_code.Section='$section' AND bsp_code.Program='$program') ORDER BY Day,Timeslot";
		$retval = mysqli_query($conn, $sql);
		$timetable = mysqli_fetch_all($retval,MYSQLI_ASSOC);
		$rows = mysqli_num_rows($retval);
		//print_r($timetable);
		if($rows > 0)
		{	
			for ($i=0; $i <$rows ; $i++)
			{
				if($timetable[$i]['Type'] == 'Theory')
				{
					$data[$row['Day']][$row['Timeslot']] = array($row['CourseName'],$row['StaffID'],$row['FullName'], $row['Batch']);
				}
				elseif($timetable[$i]['Type'] == 'Lab')
				{
					$lab = array();
					while($timetable[$i]['Type'] == 'Lab')
					{
						array_push($lab, array($timetable[$i]['CourseName'],$timetable[$i]['StaffID'],$timetable[$i]['FullName'], $timetable[$i]['Batch']));
						$i++;
					}
					$data[$timetable[$i]['Day']][$timetable[$i]['Timeslot']] = $lab;
				}
				elseif(substr($timetable[$i]['Type'],0, 8) == 'Elective')
				{
					$elec = array();
					while(substr($timetable[$i]['Type'],0, 8) == 'Elective')
					{
						array_push($elec, array($timetable[$i]['CourseName'],$timetable[$i]['StaffID'],$timetable[$i]['FullName'], $timetable[$i]['Batch']));
						$i++;
					}
					$data[$timetable[$i]['Day']][$timetable[$i]['Timeslot']] = $elec;
				}
			}
			print_r($data);
		?>
			<br>
			<h2>Time Table: <mark><?php echo"$program $yands $hod_name[1]-$section";?></mark></h2>
			<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
				<thead>
					<tr>
						<th></th>
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
					<?php 
						foreach ($data as $day => $time)
						{
							if ($day == date("l"))
							{
								echo "
									<tr class='table-info'>
										<th>$day</th>
								";
							}
							else
							{
								echo "
									<tr>
										<th>$day</th>
								";
							}
							
							foreach ($time as $key => $value)
							{
								//var_dump($value);
								// echo "<td>";
								// if ($value != '-')
								// {
								// 	if ($value[3] == '0')
								// 	{
								// 		echo "<center>$value[0]<br>--------<br>";
								// 		echo "$value[2]</center>";
								// 	}
								// }
								// else
								// {
								// 	echo "<center style='font-size:  20px;'>$value</center>";
								// }
								// echo "</td>";
							}
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
	<?php
		}
		else
		{
			echo "
				<br>
				<center>
					<div class='col-sm-10'>
						<div class='alert alert-danger'>
							<strong>No Data Found</strong>
						</div>
					</div>
				</center>
			";
		}
	}
?>