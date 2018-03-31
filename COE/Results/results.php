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
		$sql = "SELECT RollNumber FROM `sem_marks` GROUP BY RollNumber";
		$retval5 = mysqli_query($conn, $sql);
		//$count=0;
		while($row5 = mysqli_fetch_array($retval5))
		{
			$rno = $row5['RollNumber'];
			$total_credits=0;
			$total_points_secured=0;

			$sql="SELECT mid_marks.RollNumber,mid_marks.CourseID,mid_marks.Timeperiod, mid_marks.Mid1, mid_marks.Mid2, sem_marks.External FROM mid_marks NATURAL JOIN sem_marks WHERE mid_marks.RollNumber = '$rno' AND mid_marks.Timeperiod = '$id'";
			$retval = mysqli_query($conn, $sql);
			
			while($row = mysqli_fetch_array($retval))
			{
				$cid = $row['CourseID'];
				$mid1 = $row['Mid1'];
				$mid2 = $row['Mid2'];
				$external = $row['External'];
				
				$sql3 = "SELECT `YearandSem`, `SyllabusType` FROM `student_enroll_courses` WHERE RollNumber='$rno' AND CourseID='$cid'";
				$retval3 = mysqli_query($conn, $sql3);
				while($row3 = mysqli_fetch_array($retval3))
				{ 
					$syllabus = $row3['SyllabusType'];
					$yands = $row3['YearandSem'];
				}
				//$count+=1;
				$sql = "INSERT INTO `student_marks`(`RollNumber`, `CourseID`, `Timeperiod`, `SyllabusType`, `YearandSem`, `MidExam1`, `MidExam2`, `External`) VALUES ('$rno','$cid','$id','$syllabus','$yands','$mid1','$mid2','$external')";
				if (mysqli_query($conn, $sql))
				{
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
				else
				{
					echo "<center><h1>Error</h1></center>";
				}
			}
			if($total_credits != 0)
				$sgpa=round($total_points_secured/$total_credits,2);
			$sql="INSERT INTO `sgpa`(`RollNumber`, `YearandSem`, `Timeperiod`, `SGPA`) VALUES ('$rno','$yands','$timeperiod','$sgpa')";
			mysqli_query($conn, $sql);
		}

		echo "<hr><center><h3><mark>Results has been declared successfully !!</mark</h3></center>";

		$sql = "DELETE FROM mid_marks";
		mysqli_query($conn, $sql);
		$sql = "DELETE FROM sem_marks";
		mysqli_query($conn, $sql);
	}
?>