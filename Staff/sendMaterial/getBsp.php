<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['staff'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['staff'];
	if (array_key_exists('courses', $_POST))
	{
		$course = explode("--",$_POST['courses']);

		if($course[0] != '-')
		{
			?>	
			<br>
			<div class='row'>
				<div class="col-sm-1 pt-2">
					Program: 
				</div>
				<div class="col-sm-4">
					<select class="form-control" id="Program" name="Program">
						<?php
							$sql = "SELECT DISTINCT bsp_code.Program FROM staff_teaches_courses INNER JOIN bsp_code ON bsp_code.BSP = staff_teaches_courses.BSP WHERE StaffID='$uname' AND CourseID='$course[0]' AND Timeperiod=(SELECT max(id) FROM timeperiod)";
							$retval = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($retval))
							{
								echo "<option>{$row['Program']}</option>";
							}
						?>
					</select>
				</div>
				<div class="col-sm-1"></div>
				<div class="col-sm-1 pt-2">
					YandS: 
				</div>
				<div class="col-sm-4">
					<select class="form-control" id="yands" name="yands">
						<?php 
							$sql = "SELECT DISTINCT staff_teaches_courses.YearandSem FROM staff_teaches_courses INNER JOIN bsp_code ON bsp_code.BSP = staff_teaches_courses.BSP WHERE StaffID='$uname' AND CourseID='$course[0]' AND Timeperiod=(SELECT max(id) FROM timeperiod)";
							$retval = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($retval))
							{
								echo "<option>{$row['YearandSem']}</option>";
							}
						?>
					</select>
				</div>
			</div>
			<br>
			<div class='row'>
				<div class="col-sm-1 pt-2">
					Branch: 
				</div>
				<div class="col-sm-4">
					<select class="form-control" id="Branch" name="Branch">
						<?php 
							$sql = "SELECT DISTINCT bsp_code.Branch FROM staff_teaches_courses INNER JOIN bsp_code ON bsp_code.BSP = staff_teaches_courses.BSP WHERE StaffID='$uname' AND CourseID='$course[0]' AND Timeperiod=(SELECT max(id) FROM timeperiod)";
							$retval = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($retval))
							{
								echo "<option>{$row['Branch']}</option>";
							}
						?>
					</select>
				</div>
				<div class="col-sm-1"></div>
				<div class="col-sm-1 pt-2">
					Section: 
				</div>
				<div class="col-sm-4">
					<select class="form-control" id="Section" name="Section">
						<?php
							$sql = "SELECT DISTINCT bsp_code.Section FROM staff_teaches_courses INNER JOIN bsp_code ON bsp_code.BSP = staff_teaches_courses.BSP WHERE StaffID='$uname' AND CourseID='$course[0]' AND Timeperiod=(SELECT max(id) FROM timeperiod)";
							$retval = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($retval))
							{
								echo "<option>{$row['Section']}</option>";
							}
						?>
					</select>
				</div>
			</div>
			<br>
			<div class='row'>
				<div class="col-sm-1 pt-2">
					Batch: 
				</div>
				<div class="col-sm-4">
					<select class="form-control" id="Batch" name="Batch">
						<?php 
							$sql = "SELECT DISTINCT staff_teaches_courses.Batch FROM staff_teaches_courses INNER JOIN bsp_code ON bsp_code.BSP = staff_teaches_courses.BSP WHERE StaffID='$uname' AND CourseID='$course[0]' AND Timeperiod=(SELECT max(id) FROM timeperiod)";
							$retval = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($retval))
							{
								if ($row['Batch'] == '0')
								{
									echo "<option>All (1, 2 and 3)</option>";
								}
								else
								{
									echo "<option>{$row['Batch']}</option>";
								}
								
							}
						?>
					</select>
				</div>
			</div>
		<?php
		}
	}
?>