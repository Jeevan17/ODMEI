<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['COE'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['COE'];
	if (array_key_exists('cid', $_POST) and array_key_exists('cname', $_POST) and array_key_exists('dept', $_POST) and array_key_exists('sessional', $_POST) and array_key_exists('see', $_POST) and array_key_exists('credits', $_POST))
	{
		$cid=$_POST['cid'];
		$cname=$_POST['cname'];
		$dept=$_POST['dept'];
		$sessional=$_POST['sessional'];
		$see=$_POST['see'];
		$credits=$_POST['credits'];
		$sql = "INSERT INTO `courses`(`CourseID`, `CourseName`, `Department`, `sessional`, `SEE`, `Credits`) VALUES ('$cid','$cname','$dept','$sessional','$see','$credits')";
		$retval = mysqli_query($conn,$sql);
		if(!$retval)
		{
			 die('Could not add new course!: ' . mysqli_error());
		}
		else
		{
			echo "<h3>New Course added successfully!</h3>";
		}
	}
?>