<?php
	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
   
	if(! $conn )
	{
		echo "
			<div class='alert alert-danger'>
				<strong>Not connected to database." . mysqli_error();"</strong>
			</div>";
	}
?>
<?php
	if (array_key_exists('year', $_POST) and array_key_exists('semester', $_POST) and array_key_exists('program', $_POST)  and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST)and array_key_exists('date', $_POST))
	{
		$year=$_POST["year"];
		$branch=$_POST["branch"];
		$section=$_POST["section"];
		$semester=$_POST["semester"];
		$program = $_POST['program'];
		$date = $_POST['date'];
		
		$sql="SELECT dailyattendance.RollNumber,dailyattendance.Timeslot,dailyattendance.Attendance
			  from dailyattendance
			  WHERE dailyattendance.Date='$date' AND dailyattendance.RollNumber IN (SELECT student.RollNumber from student where student.CurrentYandS='$year/4 Sem-$semester' AND student.BSP=(SELECT bsp_code.BSP from bsp_code where bsp_code.Branch = '$branch' AND  bsp_code.Section = '$section' AND bsp_code.Program = '$program' ))";
		$retval = mysqli_query($conn, $sql);
		$data = array();
		$timeslot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');
		while($row = mysqli_fetch_array($retval))
		{
			for ($i=0; $i<7 ; $i++)
			{ 
				$data[$row['RollNumber']][$timeslot[$i]] = '-';
			}
		}
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$data[$row['RollNumber']][$row['Timeslot']] = $row['Attendance'];
		}
		echo "
			<table class='table'>
				<thead>
					<tr>
						<th>RollNumber</th>
						<th>09:40-10:30</th>
						<th>10:30-11:20</th>
						<th>11:20-12:10</th>
						<th>12:10-01:00</th>
						<th>01:35-02:25</th>
						<th>02:25-03:15</th>
						<th>03:15-04:05</th>
					</tr>
				</thead>
				<tbody>
		";
		if ($data) 
		{
			foreach ($data as $rollnum => $value)
			{
				echo "
					<tr>
						<td class='text-info' name='rollnumber' value='$rollnum'>$rollnum</td>
				";
				foreach ($value as $time => $attendance)
				{
					if ($attendance=='Present')
					{
						echo "
							<td><input type='checkbox' name='$rollnum' checked></td>
						";
					} 
					elseif ($attendance == 'Absent') {
						echo "
							<td><input type='checkbox' name='$rollnum' ></td>
						";
					
					}
					else
					{
						echo "
							<td><input type='checkbox' name='$rollnum' disabled></td>
						";
					}
				}
				echo "</tr>";
			}
			echo "

				</tbody>
			</table>
			<button type='button' class='btn btn-outline-success' onclick='loadUpdate()'>Update Attendance</button>
			<br><br><br><br><br>
			";
		} 
		else {
			echo "
			<h3><mark>No Data Found</mark></h3>
			";
		}
		
		
		
	}
	
?>