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
				$days = array('1.Monday','2.Tuesday','3.Wednesday','4.Thursday','5.Friday','6.Saturday');
				?>
					<tr>
						<th>
							Day:<select class="form-control" id="day">
									<option selected="selected"></option>
									<?php
										foreach ($days as $day)
										{
											echo "<option>$day</option>";
										}
									?>
								</select>
						</th>
						<?php 
							$i = 0;
							while ($i < 7)
							{
							?>
							<td>
							<form>
								Courses:<select class="form-control" id="course<?php echo "$i";?>" onchange="loadStaff(this.value,<?php echo "'$i'"; ?>)">
									<option selected="selected">-</option>
									<?php
										$sql = "SELECT courses.CourseID,courses.CourseName FROM courses
												INNER JOIN student_enroll_courses
												WHERE student_enroll_courses.YearandSem='$year/4 Sem-$semester' AND student_enroll_courses.Timeperiod = (SELECT max(timeperiod.id) FROM timeperiod) AND student_enroll_courses.RollNumber IN (SELECT student.RollNumber FROM student WHERE student.BSP = (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch='$branch' AND bsp_code.Section = '$section' AND bsp_code.Program = '$program'))
												GROUP BY courses.CourseID";
										$retval = mysqli_query($conn, $sql);

										while($row = mysqli_fetch_array($retval))
										{
											echo "<option>".$row['CourseID']."--".$row['CourseName']."</option>";
										}

									?>
								</select>
								<div id="staff<?php echo "$i$i";?>">
									Staff:<select class="form-control" id="staff<?php echo"$i";?>">
										<option>-</option>
									</select>
								</div>
								
								Batch:<select class="form-control" id="batch<?php echo "$i";?>">
									<option selected="selected">-</option>
									<?php
										$batches = array('All (1, 2 and 3)', '1', '2', '3');
										foreach ($batches as $batch)
										{
											echo "<option>$batch</option>";
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
				echo "
				</tbody>
			</table>
			<center><button type='button' class='btn btn-outline-dark' onclick='loadInsert()'>Create TimeTable</button></center>
			<br>
			<hr>";
	}		
?>