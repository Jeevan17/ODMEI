<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'Attendance';
	$uname=$_SESSION['student'];

	include 'header.php';
?>
	<table class='table table-bordered table-hover table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
		<thead>
			<tr>
				<th class='text-danger'>Date</th>
				<th class='text-danger'>09:40-10:30</th>
				<th class='text-danger'>10:30-11:20</th>
				<th class='text-danger'>11:20-12:10</th>
				<th class='text-danger'>12:10-01:00</th>
				<th class='text-danger'>01:35-02:25</th>
				<th class='text-danger'>02:25-03:15</th>
				<th class='text-danger'>03:15-04:05</th>
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