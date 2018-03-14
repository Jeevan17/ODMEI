<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['staff'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['staff'];
	if (array_key_exists('courses', $_POST) and array_key_exists('date', $_POST))
	{
		$course = explode("--",$_POST['courses']);

		if($course[0] != '-')
		{

			$date = strtotime($_POST['date']);
			$day = date('l', $date);
			
			$sql = "SELECT bsp_code.Branch, bsp_code.Section, bsp_code.Program FROM bsp_code WHERE bsp_code.BSP IN (SELECT timetable.BSP FROM timetable WHERE timetable.Day='$day' AND timetable.StaffID='$uname' AND timetable.CourseID='$course[0]')";
			$retval = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($retval))
			{
			?>	<div class='row'>
					<div class="col-sm-1 pt-2">
						Branch: 
					</div>
					<div class="col-sm-4">
						<select class="form-control" id="Branch">
							<option><?php echo "{$row['Branch']}"; ?></option>
						</select>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-1 pt-2">
						Section: 
					</div>
					<div class="col-sm-4">
						<select class="form-control" id="Section">
						    <option><?php echo "{$row['Section']}"; ?></option>
						</select>
					</div>
				</div>
				<br>
				<div class='row'>
					<div class="col-sm-1 pt-2">
						Program: 
					</div>
					<div class="col-sm-4">
						<select class="form-control" id="Program">
						    <option><?php echo "{$row['Program']}"; ?></option>
						</select>
					</div>
			<?php }
				$sql = "SELECT YearandSem FROM timetable WHERE StaffID='$uname' AND CourseID='$course[0]' AND Day ='$day' GROUP BY YearandSem";
				$retval = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_array($retval))
				{
			?>

					<div class="col-sm-1"></div>
					<div class="col-sm-1 pt-2">
						YandS: 
					</div>
					<div class="col-sm-4">
						<select class="form-control" id="Semester">
						    <option><?php echo "{$row['YearandSem']}"; ?></option>
						</select>
					</div>
				</div>
			<?php
			}
			echo "<br><hr><center><button type='button' class='btn btn-outline-success' onclick='loadSubjects()'>Get Rollnumbers</button></center>";
		}
	}
?>