<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['AEC'];
	if (array_key_exists('admn', $_POST))
	{
		$admn=$_POST['admn'];
		$sql="SELECT `AdmissionNumber` FROM `student` WHERE AdmissionNumber='$admn'";
		$retval = mysqli_query($conn,$sql);
		$affected_rows = mysqli_affected_rows($conn);
		if($affected_rows>0)
		{
			//echo "<script type='text/javascript'>alert('testing');</script>";
			echo "<h4>&#x274c;</h4>";
		}
		else
		{
			echo "<h4>&#x2705;</h4>";
		}
	}
?>