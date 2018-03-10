<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}

	$sql = "SELECT CourseID FROM courses";
	$retval = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_array($retval))
	{
		$data[] = $row['CourseID'];
	}
	echo json_encode($array);
?>
