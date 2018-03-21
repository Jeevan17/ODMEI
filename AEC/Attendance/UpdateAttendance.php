<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	
	if (array_key_exists('date', $_POST) and array_key_exists('timeslot', $_POST) and array_key_exists('rollnum', $_POST))
	{
		$timeslot=json_decode($_POST['timeslot']);
		$date=$_POST['date'];
		$rollnum = $_POST['rollnum'];
		
		for ($i=0; $i <7 ; $i++)
		{
			switch ($i)
			{
			 	case 0:
			 		if ($timeslot[$i] == 1)
			 		{
			 			$sql = "UPDATE dailyattendance SET Attendance='Present' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='09:40:00'";
				 			if (mysqli_query($conn, $sql))
				 			{
							    //echo "New record created successfully";
							}
							else
							{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
				 	}
				 	else if ($timeslot[$i] == 0)
			 		{
			 			$sql = "UPDATE dailyattendance SET Attendance='Absent' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='09:40:00'";
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
			 			$sql = "UPDATE dailyattendance SET Attendance='Present' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='10:30:00'";
				 			if (mysqli_query($conn, $sql))
				 			{
							    //echo "New record created successfully";
							}
							else
							{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
				 	}
				 	else if ($timeslot[$i] == 0)
			 		{
			 			$sql = "UPDATE dailyattendance SET Attendance='Absent' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='10:30:00'";
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
			 			$sql = "UPDATE dailyattendance SET Attendance='Present' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='11:20:00'";
				 			if (mysqli_query($conn, $sql))
				 			{
							    //echo "New record created successfully";
							}
							else
							{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
				 	}
				 	else if ($timeslot[$i] == 0)
			 		{
			 			$sql = "UPDATE dailyattendance SET Attendance='Absent' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='11:20:00'";
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
			 			$sql = "UPDATE dailyattendance SET Attendance='Present' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='12:10:00'";
				 			if (mysqli_query($conn, $sql))
				 			{
							    //echo "New record created successfully";
							}
							else
							{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
				 	}
				 	else if ($timeslot[$i] == 0)
			 		{
			 			$sql = "UPDATE dailyattendance SET Attendance='Absent' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='12:10:00'";
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
			 			$sql = "UPDATE dailyattendance SET Attendance='Present' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='01:35:00'";
				 			if (mysqli_query($conn, $sql))
				 			{
							    //echo "New record created successfully";
							}
							else
							{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
				 	}
				 	else if ($timeslot[$i] == 0)
			 		{
			 			$sql = "UPDATE dailyattendance SET Attendance='Absent' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='01:35:00'";
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
			 			$sql = "UPDATE dailyattendance SET Attendance='Present' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='02:25:00'";
				 			if (mysqli_query($conn, $sql))
				 			{
							    //echo "New record created successfully";
							}
							else
							{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
				 	}
				 	else if ($timeslot[$i] == 0)
			 		{
			 			$sql = "UPDATE dailyattendance SET Attendance='Absent' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='02:25:00'";
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
			 			$sql = "UPDATE dailyattendance SET Attendance='Present' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='03:15:00'";
				 			if (mysqli_query($conn, $sql))
				 			{
							    //echo "New record created successfully";
							}
							else
							{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
				 	}
				 	else if ($timeslot[$i] == 0)
			 		{
			 			$sql = "UPDATE dailyattendance SET Attendance='Absent' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='03:15:00'";
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
?>