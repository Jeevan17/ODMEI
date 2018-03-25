<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['AEC'];
	if (array_key_exists('tp', $_POST))
	{
		$tp = $_POST['tp'];
		if($tp==0)
		{
			echo "<h5>&#x274c;Invalid format !</h5>";
			exit();
		}
		else
		{
			echo "<h5>&#x2705;Valid format</h5>";
		}
	}
?>