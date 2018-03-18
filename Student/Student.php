<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'Home';
	$uname=$_SESSION['student'];

	include 'header.php';										


	$sql = "SELECT * FROM student INNER JOIN bsp_code ON student.BSP = bsp_code.BSP WHERE student.RollNumber=$uname";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$photo = $row['Photo'];
		$name = $row['FirstName']." ".$row['LastName'];
		$rno = $uname;
		$phno = $row['phoneNumber'];
		$email = $row['Email'];
		$batch = $row['CBatch'];
		$program = $row['Program'];
		$branch = $row['Branch'];
		$section = $row['Section'];
		$yands = $row['CurrentYandS'];
	}
	$sql = "SELECT TotalAttended,TotalClassesHeld FROM attendance WHERE RollNumber='$rno' AND 	Timeperiod=(SELECT max(id) FROM timeperiod)";
	$retval = mysqli_query($conn, $sql);
	$attendance = 0;
	while($row = mysqli_fetch_array($retval))
	{
		$attendance = $row['TotalAttended']/$row['TotalClassesHeld'] * 100;
	}
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
?>
	<div class="row">
		<div class="col-sm-6">
			<h2><mark>Profile</mark></h2>
			<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
				<tbody>
					<tr>
						<th rowspan='7'>
							<?php 
								echo "
						        	<img src='data:image/jpeg;base64,".base64_encode( $photo )."' alt='photo' height='150' width='120'/> 
						        ";
						    ?>
						</th>
						<th scope="row">Name</th>
						<td><?php echo "$name" ?></td>
						<tr>
							<th scope="row">Roll Number</th>
							<td><?php echo "$rno" ?></td>
						</tr>
						<tr>
					      <th scope="row">Division</th>
					      <td><?php echo "$program $yands $branch-$section($batch)" ?></td>
					    </tr>
						<tr>
					      <th scope="row">Phone No</th>
					      <td><?php echo "$phno" ?></td>
					    </tr>
						<tr>
						  <th scope="row">EMAIL ID</th>
					      <td><?php echo "$email" ?></td>
					    </tr>
						<tr>
					      <th scope="row">ATTENDANCE</th>
					      <td><?php echo "$attendance" ?></td>
					    </tr>
					    <tr>
					      <th scope="row">CGPA</th>
					      <td><?php echo "--" ?></td>
					    </tr>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-6">
			<?php 
				$sql = "SELECT courses.CourseName,COUNT(dailyattendance.Attendance) as Count, dailyattendance.Attendance FROM dailyattendance INNER JOIN courses ON dailyattendance.CourseID = courses.CourseID WHERE dailyattendance.RollNumber='$uname' GROUP BY CourseName, Attendance";
				$temp = array();
				$retval = mysqli_query($conn, $sql);

				while($row = mysqli_fetch_array($retval))
				{
					$temp[$row['CourseName']][$row['Attendance']] = $row['Count'];
				}
			?>
			<h2><mark>Attendance</mark></h2>
		<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
			<thead>
				<tr>
					<th>Subject Name</th>
					<th>Attendance Percentage</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($temp as $cname => $value)
					{
						echo "
							<tr>
								<th>$cname</th>
								";
								$percent = 0;
								$total = 0;
								$test = 0;
								foreach ($value as $attend => $count)
								{
									if ($attend == 'Present')
									{
										$test = $count;
									}
									$total = $count + $total;
								}
								$percent = $test / $total * 100;	
								echo "
								<td><center>$percent%</tr>
							</tr>
						";
					}
				?>
			</tbody>
		</table>
		</div>
	</div>
	<div class="row">
		<?php
			$sql = "SELECT timetable.Day,timetable.Timeslot,timetable.StaffID,staff.FullName, timetable.CourseID, courses.CourseName FROM timetable INNER JOIN staff ON timetable.StaffID = staff.StaffID INNER JOIN courses ON timetable.CourseID = courses.CourseID WHERE timetable.YearandSem = '$yands' AND timetable.BSP = (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch='$branch' AND bsp_code.Section='$section' AND bsp_code.Program='$program') AND timetable.CourseID IN (SELECT student_enroll_courses.CourseID FROM student_enroll_courses WHERE student_enroll_courses.RollNumber='$uname') AND (timetable.Batch = '$batch' OR timetable.Batch = '0') ORDER BY Day,Timeslot";
			$retval = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($retval))
			{
				$data[$row['Day']][$row['Timeslot']] = array($row['StaffID'],$row['FullName'], $row['CourseID'], $row['CourseName']);
			}
		?>
		<h2><mark>Time Table</mark></h2>
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
								<tr class='table-dark'>
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
						
						foreach ($time as $value)
						{
							echo "<td>";
							if ($value != '-')
							{
								echo "<center>$value[3]<br>--------<br>";
								echo "$value[1]</center>";
							}
							else
							{
								echo "<center style='font-size:  20px;'>$value</center>";
							}
							echo "</td>";
						}
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>
</div>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>