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
		
		$time_slot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');

		$sql = "SELECT CurrentYandS FROM student WHERE RollNumber='$rollnum'";
		$retval = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($retval))
		{
			$yands = $row['CurrentYandS'];
		}

		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($retval))
		{
			$Timeperiod = $row['id'];
		}

		$sql = "SELECT attendance.TotalAttended, attendance.TotalClassesHeld FROM attendance WHERE attendance.RollNumber = '$rollnum' and attendance.YearandSem='$yands' AND attendance.Timeperiod = $Timeperiod";
		global $TCH,$TCA;
		$retval = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($retval))
		{
			$TCH = $row['TotalClassesHeld'];
			$TCA = $row['TotalAttended'];
		}
		for ($i=0; $i <7 ; $i++)
		{
			if ($timeslot[$i] == 1)
	 		{
	 			$sql = "UPDATE dailyattendance SET Attendance='Present' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='$time_slot[$i]'";
	 			if (mysqli_query($conn, $sql))
	 			{
				    if (!is_null($TCH) and !is_null($TCA))
				    {
						$TCH = $TCH + 1;
				    	$TCA = $TCA + 1;
				    	$sql = "UPDATE attendance SET TotalAttended=$TCA,TotalClassesHeld=$TCH WHERE RollNumber='$rollnum' AND timeperiod='$Timeperiod' AND YearandSem='$yands'";
				    	if (mysqli_query($conn, $sql))
	 					{
				    		//echo "New record created successfully";
	 					}
	 					else
	 					{
	 						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	 					}
				    }
				}
				else
				{
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
		 	}
		 	else if ($timeslot[$i] == 0)
	 		{
	 			$sql = "UPDATE dailyattendance SET Attendance='Absent' WHERE RollNumber='$rollnum' and Date ='$date' and Timeslot='$time_slot[$i]'";
	 			if (mysqli_query($conn, $sql))
	 			{
				    if (!is_null($TCH) and !is_null($TCA))
				    {
				    	$TCH = $TCH +1;
				    	$sql = "UPDATE attendance SET TotalClassesHeld=$TCH WHERE RollNumber='$rollnum' AND timeperiod='$Timeperiod' AND YearandSem='$yands'";
				    	if (mysqli_query($conn, $sql))
	 					{
				    		//echo "New record created successfully";
	 					}
	 					else
	 					{
	 						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	 					}
				    }
				}
				else
				{
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
		 	}
		}        
	}
?>