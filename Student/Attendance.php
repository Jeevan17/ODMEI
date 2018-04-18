<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'Attendance';
	$uname=$_SESSION['student'];

	include 'header.php';

	$sql = "SELECT TotalAttended,TotalClassesHeld FROM attendance WHERE RollNumber='$uname' AND 	Timeperiod=(SELECT max(id) FROM timeperiod)";
	$retval = mysqli_query($conn, $sql);
	$attendance = 0;
	while($row = mysqli_fetch_array($retval))
	{
		$attendance = round($row['TotalAttended']/$row['TotalClassesHeld'] * 100,2);
	}

	if ($attendance >= 75 and $attendance < 80 )
	{
		echo "<center>
				<h1>$attendance%</h1><br>
				<p class='text-warning'>You have adequate attendance. Improve further</p>
			</center>
			";
	}
	else if($attendance >= 80)
	{
		echo "<center>
				<h1>$attendance%</h1><br>
				<p class='text-success'>Your attendance is Good</p>
			</center>
			";
	}
	else if($attendance < 65)
	{
		echo "<center>
				<h1>$attendance%</h1><br>
				<p class='text-danger'>Your attendance is Poor. You are likely to be detained. Attend regularly and improve your attendance</p>
			</center>
			";
	}
	else if($attendance >= 65 and $attendance < 75)
	{
		echo "<center>
				<h1>$attendance%</h1><br>
				<p class='text-info'>You are likely to be detained. Attend regularly and improve your attendance</p>
			</center>
			";
	}

	
?>
	<br>
	<table class='table table-bordered table-hover table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
		<thead>
			<tr>
				<th class='text-primary'>Date</th>
				<th class='text-primary'>09:40-10:30</th>
				<th class='text-primary'>10:30-11:20</th>
				<th class='text-primary'>11:20-12:10</th>
				<th class='text-primary'>12:10-01:00</th>
				<th class='text-primary'>01:35-02:25</th>
				<th class='text-primary'>02:25-03:15</th>
				<th class='text-primary'>03:15-04:05</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql = "SELECT dailyattendance.RollNumber,dailyattendance.Date, dailyattendance.Timeslot, dailyattendance.Attendance from dailyattendance where RollNumber='$uname' and dailyattendance.Timeperiod=(SELECT max(timeperiod.ID) from  timeperiod) ORDER BY dailyattendance.Date desc,dailyattendance.Timeslot";
				$retval = mysqli_query($conn, $sql);
				$data = array();
				$timeslot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');
				while($row = mysqli_fetch_array($retval))
				{
					for ($i=0; $i<7 ; $i++)
					{ 
						$data[$row['Date']][$timeslot[$i]] = '-';
					}
				}
				$retval = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_array($retval))
				{
					$data[$row['Date']][$row['Timeslot']] = $row['Attendance'];
				}
				foreach ($data as $date => $value)
				{
					$day = date('l', strtotime($date));
					echo "
						<tr>
						<td class='text-info'><center>".date("d-m-Y", strtotime($date))."<br>$day</center></td>
					";
					foreach ($value as $time => $attendance)
					{
						if($attendance=='Absent')
						{
							echo "
								<td class='text-danger'><center>$attendance</center></td>
							";
						}
						elseif($attendance == 'Present')
						{
							echo "
								<td class='text-success'><center>$attendance</center></td>
							";
						}
						else
						{
							echo "
								<td><center>$attendance</center></td>
							";
						}
					}
						echo "</tr>";
				}
			?>
		</tbody>
	</table>
</div>
</div>
		
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>