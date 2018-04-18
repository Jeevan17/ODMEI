<?php include '../../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['hod'];
	$hod_name = explode('_', $uname);
	$enroll = $hod_name[1].'_feedback';
	if (array_key_exists('feedback', $_POST))
	{
		$flag = $_POST['feedback'];
		if ($flag == '1' || $flag == '0')
		{	
			$sql = "UPDATE notification SET RollNumber='$flag' WHERE Type = '$enroll'";
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