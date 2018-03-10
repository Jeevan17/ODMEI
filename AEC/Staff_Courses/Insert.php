<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	
	if (array_key_exists('year', $_POST) and array_key_exists('semester', $_POST) and array_key_exists('program', $_POST)  and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST) and array_key_exists('batch', $_POST) and array_key_exists('staff', $_POST) and array_key_exists('course', $_POST))
	{
		$year=$_POST["year"];
		$branch=$_POST["branch"];
		$section=$_POST["section"];
		$semester=$_POST["semester"];
		$program = $_POST['program'];
		$batch = $_POST['batch'];
		$staff_a = $_POST['staff'];
		$course_a = $_POST['course'];


		$sql = "SELECT BSP FROM bsp_code WHERE Branch='$branch' AND Section='$section' AND Program='$program'";
		$retval = mysqli_query($conn, $sql);

		while($row = mysqli_fetch_array($retval))
		{
			$BSP = $row['BSP'];
		}
		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);

		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['id'];
		}

		list($sid,$sname) = split('[-]', $staff_a);
		var_dump($sid);
		var_dump($sname);
		echo "$sid";
		echo "$sname";
	}
	else {
		echo "<h1>jeevan</h1>";
	}
?>