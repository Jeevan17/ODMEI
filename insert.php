<?php include 'dataConnections.php';
	$branch = 'IT';
	$yands = '2/4 Sem-2';
	$timeperiod = '6';
	$syllabustype = 'R13';

	$sql = "SELECT CourseID FROM course_yands WHERE Branch='$branch' AND YearandSem='$yands'";
	$retval = mysqli_query($conn, $sql);
	$data = array();
	while($row = mysqli_fetch_array($retval))
	{
		array_push($data, $row['CourseID']);
	}
	$sql = "SELECT * FROM student WHERE BSP IN (SELECT BSP FROM bsp_code WHERE Branch='$branch') AND CurrentYandS = '$yands'";
	$retval = mysqli_query($conn, $sql);
	$data1 = array();
	while($row = mysqli_fetch_array($retval))
	{
		array_push($data1, $row['RollNumber']);
	}
	//------------------------------------------
	//Student Enroll Courses
	//------------------------------------------

	foreach ($data1 as $rno)
	{
		foreach ($data as $cid)
		{
			$sql = "INSERT INTO student_enroll_courses(RollNumber, YearandSem, CourseID, Timeperiod) VALUES ('$rno', '$yands', '$cid', '$timeperiod')";
			if(mysqli_query($conn, $sql))
			{
				echo "<h5>student_enroll_courses -- : $rno</h5>";
			}
			else
			{
				echo "
				<div class='alert alert-danger'>
					<strong>student_enroll_courses -- : $rno." . mysqli_error();"</strong>
				</div>";
			}
		}
	}
	//------------------------------------------
	//Mid | Sem | SGPA
	//------------------------------------------
	foreach ($data1 as $rno)
	{
		$total_credits=0;
		$total_points_secured=0;
		foreach ($data as $cid)
		{
			$sql = "SELECT Type FROM course_yands WHERE CourseID = '$cid'";
			$retval = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($retval))
			{
				$type = $row['Type'];
			}
			if($type == 'Lab')
			{
				$mid1 = rand(15,25);
				$mid2 = rand(15,25);
				$external = rand(40,50);
			}
			else
			{
				$mid1 = rand(10,25);
				$mid2 = rand(10,25);
				$external = rand(50,75);
			}
			
			$sql = "INSERT INTO `student_marks`(`RollNumber`, `CourseID`, `Timeperiod`, `SyllabusType`, `YearandSem`, `MidExam1`, `MidExam2`, `External`) VALUES ('$rno','$cid','$timeperiod','$syllabustype','$yands','$mid1','$mid2','$external')";
			if(mysqli_query($conn, $sql))
			{
				echo "<h5>student_marks -- : $rno</h5>";
			}
			else
			{
				echo "
				<div class='alert alert-danger'>
					<strong>student_marks -- : $rno." . mysqli_error();"</strong>
				</div>";
			}

			$sql2="SELECT * FROM courses where courses.CourseID='$cid'";
			$retval2 = mysqli_query($conn, $sql2);
			while($row2 = mysqli_fetch_array($retval2))
			{
				$cname = $row2['CourseName'];
				$sessional = $row2['sessional']; 
				$see = $row2['SEE'];
				$credits = $row2['Credits'];
				$total_credits+=$credits;
				$total_marks = $sessional+$see;
			}

			$midavg = ($mid1+$mid2)/2;
			$total = $midavg+$external;
			$grade='';
			$grade_array=['S','A','B','C','D','E','F'];
			$grade_points=["S"=>"10","A"=>"9","B"=>"8","C"=>"7","D"=>"6","E"=>"5","F"=>"4"];
			for($x=1;$x<=7;$x++)
			{
				if($total>=($total_marks-(($total_marks/10)*$x)))
				{
					$grade=$grade_array[$x-1];
					$status=$grade=="F"? "Fail":"Pass";
					if($status=="Fail")
					{
						$result = "FAIL";
					}
					$points_secured = $credits*$grade_points[$grade];
					$total_points_secured+=$points_secured;
					break;
				}
				else
				{
					if($x==7)
					{
						$grade=$grade_array[$x-1];
						$status=$grade=="F"? "Fail":"Pass";
						if($status=="Fail")
						{
							$result = "FAIL";
						}
						$points_secured = $credits*$grade_points[$grade];
						$total_points_secured+=$points_secured;
						break;
					}
				}
			}
		}
		if($total_credits!=0)
			$sgpa=round($total_points_secured/$total_credits,2);
		$sql="INSERT INTO `sgpa`(`RollNumber`, `YearandSem`, `Timeperiod`, `SGPA`) VALUES ('$rno','$yands','$timeperiod','$sgpa')";
		if(mysqli_query($conn, $sql))
		{
			echo "<h5>sgpa -- : $rno</h5>";
		}
		else
		{
			echo "
			<div class='alert alert-danger'>
				<strong>sgpa -- : $rno." . mysqli_error();"</strong>
			</div>";
		}
	}
	//------------------------------------------
	//Attendance
	//------------------------------------------
	foreach ($data1 as $rno)
	{
		$TCA = rand(300,380);
		$sql = "INSERT INTO `attendance`(`RollNumber`, `YearandSem`, `Timeperiod`, `TotalAttended`, `TotalClassesHeld`) VALUES ('$rno','$yands','$timeperiod','$TCA','400')";
		if(mysqli_query($conn, $sql))
		{
			echo "<h5>attendance -- : $rno</h5>";
		}
		else
		{
			echo "
			<div class='alert alert-danger'>
				<strong>attendance -- : $rno." . mysqli_error();"</strong>
			</div>";
		}
	}
?>