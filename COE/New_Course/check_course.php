<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['COE'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['COE'];
	if (array_key_exists('cid', $_POST))
	{
		$cid=$_POST['cid'];
		$sql="SELECT `CourseID` FROM `courses` WHERE CourseID='$cid'";
		$retval = mysqli_query($conn,$sql);
		$affected_rows = mysqli_affected_rows($conn);
		if($affected_rows>0)
		{
			//echo "<script type='text/javascript'>alert('testing');</script>";
			echo "<h4><strong>&#x274c;CourseID already exists&#x274c;</font></strong></h4>";
		}
		else
		{
			echo "<h4>&#x2705;</h4>";
		}
	}
?>