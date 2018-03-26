<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['AEC'];
	if (array_key_exists('tp', $_POST))
	{
		$tp = $_POST['tp'];
		$sql="SELECT `Timeperiod` FROM `timeperiod` WHERE Timeperiod='$tp'";
		$retval = mysqli_query($conn,$sql);
		$affected_rows = mysqli_affected_rows($conn);
		if($tp=="")
		{
			echo "
					<div class='alert alert-danger'>
							<strong>Empty Timeperiod cannot be added!</strong>
						</div>
						";
						exit();
		}
		if($affected_rows>0)
		{
			//echo "<script type='text/javascript'>alert('testing');</script>";
			//echo "<h4>Timeperiod already exists !!</h4>";
			echo "
					<div class='alert alert-danger'>
							<strong>Timeperiod already exists!</strong>
						</div>
						";
						exit();
		}
		else
		{
			$sql = "INSERT INTO `timeperiod`(`Timeperiod`) VALUES ('$tp')";
			$retval = mysqli_query($conn,$sql);
			if(!retval)
			{

			}
			else
			{
				echo "
					<div class='alert alert-success'>
							<strong>New Timeperiod added successfully!</strong>
						</div>
						";
			}
		}
	}
?>