<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	
	if (array_key_exists('year', $_POST) and array_key_exists('semester', $_POST) and array_key_exists('program', $_POST)  and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST) and array_key_exists('subject', $_POST) and array_key_exists('i', $_POST))
	{
		$year=$_POST["year"];
		$branch=$_POST["branch"];
		$section=$_POST["section"];
		$semester=$_POST["semester"];
		$program = $_POST['program'];
		$subject = $_POST['subject'];
		$i =$_POST['i'];
		$subject = explode("--",$subject);
		
		echo "
			Staff:
			<select class='form-control' id='staff$i'>
				<option selected='selected'>-</option>
		";
			$sql = "SELECT staff.StaffID,staff.FullName FROM staff WHERE staff.StaffID IN (SELECT staff_teaches_courses.StaffID FROM staff_teaches_courses WHERE staff_teaches_courses.CourseID='$subject[0]')";
			$retval = mysqli_query($conn, $sql);

			while($row = mysqli_fetch_array($retval))
			{
				echo "<option>".$row['StaffID']."--".$row['FullName']."</option>";
			}
		echo "</select>";	
	}
?>