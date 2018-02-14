<?php
	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');
	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
   
	if(! $conn )
	{
		echo "
			<div class='alert alert-danger'>
				<strong>Not connected to database." . mysqli_error();"</strong>
			</div>";
	}
?>
<?php
	if (array_key_exists('date', $_POST) and array_key_exists('timeslot', $_POST) and array_key_exists('present', $_POST) and array_key_exists('absent', $_POST) and array_key_exists('course', $_POST) and array_key_exists('year', $_POST) and array_key_exists('program', $_POST) and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST) and array_key_exists('semester', $_POST))
	{
		$present=json_decode($_POST['present']);
		$absent=json_decode($_POST['absent']);
		$timeslot=json_decode($_POST['timeslot']);
		$date=$_POST['date'];
		$course = $_POST['course'];
		// echo "<br>$date<br>";
		
		// var_dump($present);
		// echo "<br>";
		// var_dump($absent);
		// echo "<br>";
		// var_dump($timeslot);
		// echo "<br>";

		//$date = date("d-m-Y", strtotime($date));
		$sql = "SELECT courses.CourseID FROM courses WHERE courses.CourseName='$course'";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$CourseID = $row['CourseID'];
		}
		
		$sql = "SELECT id from timeperiod WHERE id=(SELECT max(id) from timeperiod)";
		$retval = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($retval))
		{
			$Timeperiod = $row['id'];
		}
		//echo "$Timeperiod";				
		foreach ($absent as $rno)
		{
			if (!is_null($rno))
			{
				for ($i=0; $i <7 ; $i++)
				{
					switch ($i)
					{
					 	case 0:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','09:40:00','Absent')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 1:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','10:30:00','Absent')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 2:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','11:20:00','Absent')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 3:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','12:10:00','Absent')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 4:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','01:35:00','Absent')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 5:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','02:25:00','Absent')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 6:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','03:15:00','Absent')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					} 
				}
			}
		}
		foreach ($present as $rno)
		{
			if (!is_null($rno))
			{
				for ($i=0; $i <7 ; $i++)
				{
					switch ($i)
					{
					 	case 0:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','09:40:00','Present')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 1:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','10:30:00','Present')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 2:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','11:20:00','Present')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 3:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','12:10:00','Present')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 4:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','01:35:00','Present')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 5:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','02:25:00','Present')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					 	case 6:
					 		if ($timeslot[$i] == 1)
					 		{
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$CourseID','$Timeperiod','$date','03:15:00','Present')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								}
								else
								{
								    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
					 		}
					 	break;
					} 
				}
			}
		}        
	}
?>