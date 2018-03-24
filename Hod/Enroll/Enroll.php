<?php include '../../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['hod'];

	$hod_name = explode('_', $uname);
	$enroll = $hod_name[1].'_Enroll';
	if (array_key_exists('enroll', $_POST))
	{
		$flag = $_POST['enroll'];
		print_r($flag);
		if ($flag == '1' || $flag == '0')
		{	
			$sql = "UPDATE `notification` SET `Rollnumber`='$flag' WHERE Type = '$enroll'";
			if (mysqli_query($conn, $sql))
			{
			    echo "<script language='javascript'>window.location='../enroll_courses.php';</script>";
			}
			else
			{
			    echo "
			    	<div class='alert alert-dismissible alert-primary'>
			    		<strong>Error Toggling</strong>
					</div>
				";
			}
		}
		else
		{
			echo "
		    	<div class='alert alert-dismissible alert-primary'>
		    		<strong>Error Toggling</strong>
				</div>
			";
		}
	}
?>