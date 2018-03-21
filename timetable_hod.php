<?php include '../../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['Hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['Hod'];

	$hod_name = explode('_', $uname);

	$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$time_slot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');

	$data = array();
	foreach ($days as $day)
	{
		foreach ($time_slot as $time)
		{
			for ($i=0; $i <4 ; $i++)
			{ 
				$data[$day][$time][$i] = '-';
			}
		}
	}

	if (array_key_exists('yands', $_POST) and array_key_exists('program', $_POST) and array_key_exists('section', $_POST))
	{
		$yands = $_POST['yands'];
		$program = $_POST['program'];
		$section = $_POST['section'];

		$sql = "SELECT timetable.Day, timetable.Timeslot, courses.CourseName, timetable.StaffID, staff.FullName, timetable.Batch FROM timetable INNER JOIN staff ON timetable.StaffID = staff.StaffID INNER JOIN courses ON courses.CourseID = timetable.CourseID WHERE timetable.YearandSem = '$yands' AND timetable.BSP = (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch='$hod_name[1]' AND bsp_code.Section='$section' AND bsp_code.Program='$program') ORDER BY Day,Timeslot";
		$retval = mysqli_query($conn, $sql);
			
		if(mysqli_num_rows($retval) > 0)
		{	while($row = mysqli_fetch_array($retval))
			{
				$data[$row['Day']][$row['Timeslot']][$row['Batch']]= array($row['CourseName'],$row['StaffID'],$row['FullName']);
			}
		?>
			<br>
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
							
							foreach ($time as $temp => $Tbatch)
							{
								echo "<td>";
								//print_r($Tbatch);
								foreach ($Tbatch as $value)
								{
									if ($value != '-')
									{
										foreach ($value as $key)
										{
											//var_dump($value);
											//var_dump($key);
											echo "<center>$key[0]<br>--------<br>";
										 	echo "$key[2]</center>";
										}
										// if ($value[2] == '0')
										// {
										// 	echo "<center>$value[0]<br>--------<br>";
										// 	echo "$value[2]</center>";
										// }
										// else
										// {
										// 	echo "<center>$value[0]<br>--------<br>";
										// 	echo "$value[2]</center>";
										// }
										
									}
									// else
									// {
									// 	echo "<center style='font-size:  20px;'>$value</center>";
									// }
									echo "</td>";
								}
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