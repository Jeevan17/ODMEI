<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['COE'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['COE'];
	if (array_key_exists('id', $_POST))
	{
		echo "<hr>";
		$id = $_POST['id'];
		$sql="SELECT Timeperiod FROM `timeperiod` where id='$id'";
		$retval = mysqli_query($conn, $sql);
		if(!$retval)
		{
			die('Could not get data: ' . mysqli_error());
		}
		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod=$row['Timeperiod'];
		}
		$sql="SELECT student_enroll_courses.RollNumber, student_enroll_courses.CourseID, student_enroll_courses.SyllabusType, student_enroll_courses.YearandSem, mid_marks.Mid1, mid_marks.Mid2, sem_marks.External from student_enroll_courses natural join mid_marks natural join sem_marks WHERE student_enroll_courses.Timeperiod='$id'";
		$retval = mysqli_query($conn, $sql);
		$affected_rows = mysqli_affected_rows($conn);
		// var_dump($affected_rows);
		if($affected_rows==0)
		{
			die('No data found to release !! ' . mysqli_error());
		}
		$count=0;
		while($row = mysqli_fetch_array($retval))
		{
			$rno = $row['RollNumber'];
			$cid = $row['CourseID'];
			$syllabus = $row['SyllabusType'];
			$yands = $row['YearandSem'];
			$mid1 = $row['Mid1'];
			$mid2 = $row['Mid2'];
			$external = $row['External'];

			$count+=1;
			$sql = "INSERT INTO `student_marks`(`RollNumber`, `CourseID`, `Timeperiod`, `SyllabusType`, `YearandSem`, `MidExam1`, `MidExam2`, `External`) VALUES ('$rno','$cid','$id','$syllabus','$yands','$mid1','$mid2','$external')";
			if (mysqli_query($conn, $sql))
			{
				//echo "<h3><mark>New record inserted successfully</mark</h3>";
			}
			else
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			if($count==$affected_rows)
			{
				echo "<h3><mark>Results has been declared successfully !!</mark</h3>";
			}
		}
	}
?>