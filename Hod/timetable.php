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
	$time_slot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');
	$staff = array();

	$sql = "SELECT staff.FullName, timetable.YearandSem, bsp_code.Program, bsp_code.Branch, bsp_code.Section, timetable.Day, timetable.Timeslot, courses.CourseName FROM timetable NATURAL JOIN staff NATURAL JOIN bsp_code NATURAL JOIN courses WHERE staff.Department='$hod_name[1]' GROUP BY staff.FullName ORDER BY timetable.Day,timetable.Timeslot ";
	$data = array();
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		array_push($staff, $row['FullName']);
		//array_push($days, $row['Day']);
		//$data[$row['Day']][$row['FullName']] = '-';
	}
	?>
	<pre>
	    <?php
	        print_r($staff);
	    ?>
	</pre>
	<?php
	foreach ($staff as $name)
	{
		foreach ($time_slot as $time)
		{
			$data[$name][$time] = '-';
		}
	}
	//var_dump($data);

	$sql = "SELECT staff.FullName, timetable.YearandSem, bsp_code.Program, bsp_code.Branch, bsp_code.Section, timetable.Day, timetable.Timeslot, courses.CourseName FROM timetable NATURAL JOIN staff NATURAL JOIN bsp_code NATURAL JOIN courses WHERE staff.Department='$hod_name[1]' ORDER BY timetable.Day,timetable.Timeslot";
	//$data = array();
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		// $a = array($row['CourseName'],$row['YearandSem'],$row['Program'],$row['Branch'],$row['Section']);
		// $day = $row['Day'];
		// $staff = $row['FullName'];
		// array_push($data[$day][$staff], $a);
		$data[$row['FullName']][$row['Timeslot']] = array($row['CourseName'],$row['YearandSem'],$row['Program'],$row['Branch'],$row['Section']);
	}
	echo "<br><hr>";
	?>
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
				foreach ($data as $staff => $timeslot)
				{
					
					echo "
						<tr>
							<th>$staff</th>
					";
				
					
					foreach ($timeslot as $time => $value)
					{
						echo "<h1>$staff</h1><pre>";
						        var_dump($value);
						echo "</pre>";
						echo "<td>";
						if ($value != '-')
						{
							echo "$value[0]<hr>
								$value[2] $value[1] $value[3]-$value[4]
							";
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
		<script src='timetable/timetable.js'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>