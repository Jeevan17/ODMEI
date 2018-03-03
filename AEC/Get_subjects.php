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
	if (array_key_exists('year', $_POST) and array_key_exists('semester', $_POST) and array_key_exists('program', $_POST)  and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST))
	{
		$year=$_POST["year"];
		$branch=$_POST["branch"];
		$section=$_POST["section"];
		$semester=$_POST["semester"];
		$program = $_POST['program'];
		$sql = "SELECT DISTINCT CourseName from courses
				INNER JOIN staff_teaches_courses
				ON courses.CourseID=staff_teaches_courses.CourseID
				WHERE staff_teaches_courses.YearandSem='$year/4 Sem-$semester' AND staff_teaches_courses.BSP=(SELECT BSP from bsp_code where bsp_code.Branch='$branch' and bsp_code.Section='$section' and bsp_code.Program='$program')";
		$retval = mysqli_query($conn, $sql);
		echo "<select class='form-control' id='courses' onchange='loadRnum()'>";
		$courses = array();
		while($row = mysqli_fetch_array($retval))
		{
			echo "
				<option>{$row['CourseName']}</option>
			";
		}
		echo "</select>
			<br>
			<br>
			";
	}
?>