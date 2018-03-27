<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	
	if (array_key_exists('date', $_POST) and array_key_exists('timeslot', $_POST) and array_key_exists('present', $_POST) and array_key_exists('absent', $_POST) and array_key_exists('course', $_POST) and array_key_exists('year', $_POST) and array_key_exists('program', $_POST) and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST) and array_key_exists('semester', $_POST))
	{
		$present=json_decode($_POST['present']);
		$absent=json_decode($_POST['absent']);
		$timeslot=json_decode($_POST['timeslot']);
		$date=$_POST['date'];
		$temp = $_POST['course'];
		$year = $_POST['year'];
		$semester = $_POST['semester'];

		$time_slot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');

		if($temp == 'Placement' || $temp == 'Sudhee' || $temp == 'Shruthi')
		{
			$sql = "SELECT date FROM dailyattendance WHERE Date='$date' and CourseID='$temp'";
			$retval = mysqli_query($conn, $sql);
			if(mysqli_num_rows($retval) > 0)
			{
				echo "
				<div class='alert alert-danger'>
					<strong>Cannot Add Attendance(Date Already used)</strong>
				</div>";
			}
			else
			{
				$sql = "SELECT max(id) AS id FROM timeperiod";
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
						$sql = "SELECT attendance.TotalAttended, attendance.TotalClassesHeld
								FROM attendance WHERE attendance.RollNumber = '$rno' and attendance.YearandSem='$year/4 Sem-$semester' AND attendance.Timeperiod=(SELECT max(timeperiod.ID) from timeperiod)";
						global $TCH,$TCA;
						$TCH = null;
						$TCA = null;
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
					 			$sql = "INSERT INTO dailyattendance (RollNumber, CourseID, Timeperiod, Date, Timeslot, Attendance) VALUES ('$rno','$temp','$Timeperiod','$date','$time_slot[$i]','Absent')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								    if (is_null($TCH) and is_null($TCA))
								    {
								    	$sql = "INSERT INTO attendance(RollNumber, Timeperiod, YearandSem, TotalAttended, TotalClassesHeld) VALUES ('$rno', '$Timeperiod', '$year/4 Sem-$semester', 0, 1)";
								    	if (mysqli_query($conn, $sql))
					 					{
								    		//echo "New record created successfully";
								    		$TCH = 1;
							    			$TCA = 0;
					 					}
					 					else
					 					{
					 						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					 					}
								    }
								    elseif (!is_null($TCH) and !is_null($TCA))
								    {
								    	$TCH = $TCH +1;
								    	$sql = "UPDATE attendance SET TotalClassesHeld=$TCH WHERE RollNumber='$rno' AND timeperiod='$Timeperiod' AND YearandSem='$year/4 Sem-$semester'";
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
				}
				foreach ($present as $rno)
				{
					if (!is_null($rno))
					{
						$sql = "SELECT attendance.TotalAttended, attendance.TotalClassesHeld 
						FROM attendance 
						WHERE attendance.RollNumber = '$rno' and attendance.YearandSem='$year/4 Sem-$semester' AND attendance.Timeperiod=(SELECT max(timeperiod.ID) from timeperiod)";
						global $TCH,$TCA;
						$TCH = null;
						$TCA = null;
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
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$temp','$Timeperiod','$date','$time_slot[$i]','Present')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								    if (is_null($TCH) and is_null($TCA))
								    {
								    	$sql = "INSERT INTO attendance(RollNumber, Timeperiod, YearandSem, TotalAttended, TotalClassesHeld) VALUES ('$rno', '$Timeperiod', '$year/4 Sem-$semester', 1, 1)";
								    	if (mysqli_query($conn, $sql))
					 					{
								    		//echo "New record created successfully";
								    		$TCH = 1;
							    			$TCA = 1;
					 					}
					 					else
					 					{
					 						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					 					}
								    }
								    elseif (!is_null($TCH) and !is_null($TCA))
								    {
								    	$TCH = $TCH +1;
								    	$TCA = $TCA +1;
								    	$sql = "UPDATE attendance SET TotalAttended=$TCA,TotalClassesHeld=$TCH WHERE RollNumber='$rno' AND timeperiod='$Timeperiod' AND YearandSem='$year/4 Sem-$semester'";
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
				}
				echo "
				<div class='alert alert-danger'>
					<strong>Attendance added Successfully</strong>
				</div>";
			}
		}
		else
		{
			$Course = explode('--', $temp);
			$sql = "SELECT date FROM dailyattendance WHERE Date='$date' and CourseID='$Course[0]'";
			$retval = mysqli_query($conn, $sql);
			if(mysqli_num_rows($retval) > 0)
			{
				echo "
				<div class='alert alert-danger'>
					<strong>Cannot Add Attendance(Date Already used)</strong>
				</div>";
			}
			else
			{
				$sql = "SELECT max(id) AS id FROM timeperiod";
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
						$sql = "SELECT attendance.TotalAttended, attendance.TotalClassesHeld 
								FROM attendance 
								WHERE attendance.RollNumber = '$rno' and attendance.YearandSem='$year/4 Sem-$semester' AND attendance.Timeperiod=(SELECT max(timeperiod.ID) from timeperiod)";
						global $TCH,$TCA;
						$TCH = null;
						$TCA = null;
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
					 			$sql = "INSERT INTO dailyattendance (RollNumber, CourseID, Timeperiod, Date, Timeslot, Attendance) VALUES ('$rno','$Course[0]','$Timeperiod','$date','$time_slot[$i]','Absent')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								    if (is_null($TCH) and is_null($TCA))
								    {
								    	$sql = "INSERT INTO attendance(RollNumber, Timeperiod, YearandSem, TotalAttended, TotalClassesHeld) VALUES ('$rno', '$Timeperiod', '$year/4 Sem-$semester', 0, 1)";
								    	if (mysqli_query($conn, $sql))
					 					{
								    		//echo "New record created successfully";
								    		$TCH = 1;
							    			$TCA = 0;
					 					}
					 					else
					 					{
					 						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					 					}
								    }
								    elseif (!is_null($TCH) and !is_null($TCA))
								    {
								    	$TCH = $TCH +1;
								    	$sql = "UPDATE attendance SET TotalClassesHeld=$TCH WHERE RollNumber='$rno' AND timeperiod='$Timeperiod' AND YearandSem='$year/4 Sem-$semester'";
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
				}
				foreach ($present as $rno)
				{
					if (!is_null($rno))
					{
						$sql = "SELECT attendance.TotalAttended, attendance.TotalClassesHeld 
						FROM attendance 
						WHERE attendance.RollNumber = '$rno' and attendance.YearandSem='$year/4 Sem-$semester' AND attendance.Timeperiod=(SELECT max(timeperiod.ID) from timeperiod)";
						global $TCH,$TCA;
						$TCH = null;
						$TCA = null;
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
					 			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance) VALUES ('$rno','$Course[0]','$Timeperiod','$date','$time_slot[$i]','Present')";
					 			if (mysqli_query($conn, $sql))
					 			{
								    //echo "New record created successfully";
								    if (is_null($TCH) and is_null($TCA))
								    {
								    	$sql = "INSERT INTO attendance(RollNumber, Timeperiod, YearandSem, TotalAttended, TotalClassesHeld) VALUES ('$rno', '$Timeperiod', '$year/4 Sem-$semester', 1, 1)";
								    	if (mysqli_query($conn, $sql))
					 					{
								    		//echo "New record created successfully";
								    		$TCH = 1;
							    			$TCA = 1;
					 					}
					 					else
					 					{
					 						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					 					}
								    }
								    elseif (!is_null($TCH) and !is_null($TCA))
								    {
								    	$TCH = $TCH +1;
								    	$TCA = $TCA +1;
								    	$sql = "UPDATE attendance SET TotalAttended=$TCA,TotalClassesHeld=$TCH WHERE RollNumber='$rno' AND timeperiod='$Timeperiod' AND YearandSem='$year/4 Sem-$semester'";
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
				}
				echo "
				<div class='alert alert-danger'>
					<strong>Attendance added Successfully</strong>
				</div>";
			}
		}        
	}
?>