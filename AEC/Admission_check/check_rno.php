<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['AEC'];
	if (array_key_exists('rno', $_POST))
	{
		$rno=$_POST['rno'];
		$sql="SELECT `RollNumber` FROM `student` WHERE RollNumber='$rno'";
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