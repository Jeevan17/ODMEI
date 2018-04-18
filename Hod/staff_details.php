<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Staff Details';
	$uname=$_SESSION['hod'];

	include 'header.php';
	$hod_name = explode('_', $uname);							
?>

<div>
	<center>
		<form action='staff_details.php' method='POST'>
			<label for='rno'>Enter Staff ID : </label>
			<input type='text' class='form-control' id='sid' name='sid' placeholder="Staff ID" required style=' width: 200px;     display: initial;'>
			<input type='submit' value='Search' name='submit' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;'>
		</form>
	</center>
</div>

<?php
	if(isset($_POST["submit"]))
	{
		if($_POST['sid']!=null)
		{
			//session_start();
			if(!isset($_SESSION['hod'])){
				echo "<script language='javascript'>window.location='index.php';</script>";
			}
			$sid = $_POST['sid'];
			$sql = "SELECT * from staff where StaffID='$sid' AND Department = '$hod_name[1]'";
			$retval = mysqli_query($conn, $sql);
			if(mysqli_num_rows($retval) > 0)
			{
				while($row = mysqli_fetch_array($retval))
				{
					$photo = $row['Photo'];
					$name = $row['FullName'];
					$phno = $row['PhoneNo'];
					$email = $row['EmailID'];
					$Specialization = $row['Specialization'];
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
<br>
	<div class="row">
		<div class="col-sm-6">
			<h2><mark>Profile</mark></h2>
			<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
				<tbody>
					<tr>
						<th rowspan='5'>
							<?php 
								echo "
			        			<img src='data:image/jpeg;base64,".base64_encode( $photo )."'  alt='photo' height='150' width='120'/> 
			        			";
			        		?>
		        		</th>
					    <th scope="row">Name</th>
					    <td><?php echo "$name" ?></td>
						<tr >
					      <th scope="row">Staff ID</th>
					      <td><?php echo "$sid" ?></td>
					    </tr>
						<tr >
					      <th scope="row">Phone No</th>
					      <td><?php echo "$phno" ?></td>
					    </tr>
						<tr >
					      <th scope="row">EMAIL ID</th>
					      <td><?php echo "$email" ?></td>
					    </tr>
						<tr >
					      <th scope="row">Specialization</th>
					      <td><?php echo "$Specialization" ?></td>
					    </tr>
					</tr>
				</tbody>
			</table>
		</div>
		<?php 
			$sql = "SELECT * FROM `feedback` WHERE StaffID = '$sid'";
			$retval = mysqli_query($conn, $sql);
			$n = mysqli_affected_rows($conn);
			if($n > 0)
			{
				$n = $n * 5;
				$sql = "SELECT `CourseID`, SUM(Communication) AS Communication, SUM(Methodology) AS Methodology, SUM(controlloverclass) AS controlloverclass, SUM(Punctuality) AS Punctuality, SUM(Clarification) AS Clarification FROM `feedback` WHERE StaffID = '$sid' GROUP BY CourseID";
				$retval = mysqli_query($conn, $sql);
				$dataPoints = array();
				while($row = mysqli_fetch_array($retval))
				{
					array_push($dataPoints, array("label"=> "Communication", "y"=> (($row['Communication']/$n)*100)));
					array_push($dataPoints, array("label"=> "Methodology", "y"=> (($row['Methodology']/$n)*100)));
					array_push($dataPoints, array("label"=> "Controll Over Class", "y"=> (($row['controlloverclass']/$n)*100)));
					array_push($dataPoints, array("label"=> "Punctuality", "y"=> (($row['Punctuality']/$n)*100)));
					array_push($dataPoints, array("label"=> "Doubt Clarification", "y"=> (($row['Clarification']/$n)*100)));
				}
				
				// echo "<pre>";
				// var_dump($dataPoints);
				// echo "</pre>";
		?>
				<div class="col">
					<h2><mark>Feedback</mark></h2>
					<div id="chartContainer" style="height: 370px; width: 100%;"></div>
				</div>
		<?php
			}
		?>
	</div>
	<div class="row">
		<?php
			$sql = "SELECT timetable.Day, timetable.Timeslot, courses.CourseName, timetable.YearandSem, bsp_code.Branch, bsp_code.Section, bsp_code.Program, timetable.Batch FROM timetable INNER JOIN courses ON courses.CourseID=timetable.CourseID INNER JOIN bsp_code ON bsp_code.BSP=timetable.BSP WHERE timetable.StaffID='$sid' ORDER BY Day,Timeslot";
			$retval = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($retval))
			{
				$data[$row['Day']][$row['Timeslot']] = array($row['CourseName'],$row['Program'],$row['YearandSem'], $row['Branch'], $row['Section'],$row['Batch']);
			}
		?>
		<h2><mark>Achievements</mark></h2>
		<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
			<thead>
				<tr>
					<th>Title</th>
					<th>Description</th>
					<th>Document Name</th>
					<th>Download</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql="SELECT * FROM `staff_achievements` WHERE StaffID='$sid'";
					$retval = mysqli_query($conn, $sql);
					while($row=mysqli_fetch_array($retval))
					{
						echo "
							<tr>
								<td>{$row['Title']}</td>
								<td>{$row['Description']}</td>
								<td>{$row['DocumentName']}</td>
								<td><a href='material/download_staff_achievements.php?id={$row['id']}' class='btn btn-success'/>Download</a> </td>
							</tr>
						";
					}
				?>
			</tbody>
		</table>
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
						
						foreach ($time as $value)
						{
							echo "<td>";
							if ($value != '-')
							{
								echo "<center>$value[0]<br>--------<br>";
								if ($value[5] == '0')
								{
									echo "$value[1] $value[2] $value[3]-$value[4]</center>";
								}
								else
								{
									echo "$value[1] $value[2] $value[3]-$value[4] B($value[5])</center>";
								}
								
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
<?php 
		}
		else
		{
			echo "
				<hr>
				<div class='alert alert-danger'>
					<strong>No Data Found</strong>
				</div>
			";
		}
	}
}
?>
</div>
</div>
	<script>
		window.onload = function () {
		 
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			exportEnabled: true,
			title:{
				text: "Feedback"
			},
			// subtitles: [{
			// 	text: "Currency Used: Thai Baht (฿)"
			// }],
			data: [{
				type: "pie",
				showInLegend: "true",
				legendText: "{label}",
				indexLabelFontSize: 16,
				indexLabel: "{label} - #percent%",
				yValueFormatString: "##'%'",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
		 
		}
	</script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>