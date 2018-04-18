<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['library'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['library'];
	if (array_key_exists('bid', $_POST))
	{
		$bid=$_POST['bid'];
		$sql="SELECT `BookID` FROM `library` WHERE BookID='$bid'";
		$retval = mysqli_query($conn,$sql);
		$affected_rows = mysqli_affected_rows($conn);
		if($affected_rows>0)
		{
			//echo "<script type='text/javascript'>alert('testing');</script>";
			echo "<h4><strong>&#x274c;BookID already exists&#x274c;</font></strong></h4>";
		}
		else
		{
			echo "<h4>&#x2705;</h4>";
		}
	}
?>