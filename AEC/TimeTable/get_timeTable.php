<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	
	if (array_key_exists('year', $_POST) and array_key_exists('semester', $_POST) and array_key_exists('program', $_POST)  and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST))
	{
		$year=$_POST["year"];
		$branch=$_POST["branch"];
		$section=$_POST["section"];
		$semester=$_POST["semester"];
		$program = $_POST['program'];
		//$batch = $_POST['batch'];
		echo "<h3>Time Table for<mark>$program $year/4 Sem-$semester $branch-$section</mark></h3>
			<hr>
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
				";
				$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
				foreach ($days as $day)
				{
				?>
					<tr>
						<th><?php 
							echo "$day";
							 ?></th>
						<?php 
							$i=0;
							while ($i < 7)
							{
							?>
							<td>
							<form>
								<select class="form-control" id="staff<?php echo "$day";?>">
									<?php
									 	$sql = "SELECT staff.StaffID,staff.FullName FROM staff where staff.Department = '$branch'";
										$retval = mysqli_query($conn, $sql);

										while($row = mysqli_fetch_array($retval))
										{
											echo "<option>".$row['StaffID']."--".$row['FullName']."</option>";
										}
									?>
								</select>
								<select class="form-control" id="course<?php echo "$day";?>">
									<?php
										$sql = "SELECT courses.CourseID,courses.CourseName FROM courses
												INNER JOIN staff_teaches_courses
												ON courses.CourseID=staff_teaches_courses.CourseID
												WHERE staff_teaches_courses.YearandSem='$year/4 Sem-$semester'AND staff_teaches_courses.BSP=(SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch='$branch' AND bsp_code.Section='$section' AND bsp_code.Program='$program') AND staff_teaches_courses.Timeperiod=(SELECT max(timeperiod.id) FROM timeperiod)
												GROUP BY courses.CourseName";
										$retval = mysqli_query($conn, $sql);

										while($row = mysqli_fetch_array($retval))
										{
											echo "<option>".$row['CourseID']."--".$row['CourseName']."</option>";
										}

									?>
								</select>
								<select class="form-control" id="timeslot<?php echo "$day";?>">
									<?php
										$timeslot = array('09:40:00', '10:30:00', '11:20:00', '12:10:00', '01:35:00', '02:25:00', '03:15:00' );
										foreach ($timeslot as $time)
										{
											echo "<option>$time</option>";
										}
									?>
								</select>
							</form>
							</td>
						<?php 
							$i++;
							} 
						?>
					</tr>
				<?php	
				}
				echo "
				</tbody>
			</table>
			<center><button type='button' class='btn btn-outline-dark'>Create TimeTable</button></center>
			<br>
			<hr>";
	}		
?>