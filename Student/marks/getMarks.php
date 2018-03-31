<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['student'];
	// var_dump($uname);
	if (array_key_exists('rno', $_POST) and array_key_exists('yands', $_POST))
	{
		echo "<hr>";
		$rno = $_POST['rno'];
		$yands = $_POST['yands'];
		
		$sql = "SELECT * FROM `sgpa` WHERE RollNumber='$rno' group by RollNumber";
		$retval = mysqli_query($conn, $sql);
		$cgpa=0;
		$aff_rows = mysqli_affected_rows($conn);
		if($aff_rows==0)
		{
			// die('Data not found !! ' . mysqli_error());
			// exit();
		}
		while($row = mysqli_fetch_array($retval))
		{
			$cgpa+=$row['SGPA'];
		}
		if($aff_rows!=0)
			$cgpa=$cgpa/$aff_rows;
		echo "<h3>CGPA: $cgpa </h3>";
		echo "<hr>";

		$sql="SELECT student_marks.RollNumber, student_marks.CourseID, student_marks.Timeperiod, student_marks.SyllabusType, student_marks.YearandSem, student_marks.MidExam1, student_marks.MidExam2, student_marks.External, course_yands.Type FROM student_marks INNER JOIN course_yands ON course_yands.CourseID = student_marks.CourseID WHERE student_marks.RollNumber='$rno' AND student_marks.YearandSem='$yands' Group BY CourseID ORDER BY Type";
		$retval = mysqli_query($conn, $sql);
		$affected_rows = mysqli_affected_rows($conn);
		if($affected_rows==0)
		{
			die('Data not found !! ');
			exit();
		}	
?>
	<center>
	<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-hover">
		<thead>
			<tr>
				<th>SNo</th>
				<th>CourseID</th>
				<th>CourseName</th>
				<th>Month & Year</th>
				<th>Syllabus Type </th>
				<th>Credits</th>
				<th>Final Grade</th>
				<th>Points Secured</th>
				<th>Status</th>
			</tr>
		</thead>
	<?php
			$count=0;
			$total_credits=0;
			$total_points_secured=0;
			$result="PASS";
			while($row = mysqli_fetch_array($retval))
			{
				$count+=1;
	?>
	<tbody>
		<tr>
			<td><?php echo $count;?></td>
			<td><?php echo $row['CourseID'];?></td>
			<?php
				$cid=$row['CourseID'];
				$sql2="SELECT * FROM courses where courses.CourseID='$cid'";
				$retval2 = mysqli_query($conn, $sql2);
				while($row2 = mysqli_fetch_array($retval2))
				{
					$cname = $row2['CourseName'];
					$sessional = $row2['sessional']; 
					$see = $row2['SEE'];
					$credits = $row2['Credits'];
					$total_credits+=$credits;
					// var_dump($credits);
					// var_dump($total_credits);
					$total_marks = $sessional+$see;
				}
				//var_dump($total_credits);
			?>
			<td><?php echo $cname; ?></td>
			<?php
				$id=$row['Timeperiod'];
				$sql3="SELECT Timeperiod FROM `timeperiod` where id='$id'";
				$retval3 = mysqli_query($conn, $sql3);
				$affected_rows3 = mysqli_affected_rows($conn);
				if($affected_rows3==0)
				{
					die('Could not get data: ' . mysqli_error());
				}
				while($row3 = mysqli_fetch_array($retval3))
				{
					$timeperiod=$row3['Timeperiod'];
				}
			?>
			<td><?php echo $timeperiod ?></td>
			<td><?php echo $row['SyllabusType']; ?></td>
			<?php
				$mid1 = $row['MidExam1'];
				$mid2 = $row['MidExam2'];
				$external = $row['External'];
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
			?>
			<td><?php echo $credits; ?></td>
			<td><?php echo $grade; ?></td>
			<td><?php echo $points_secured ?></td>
			<td><?php echo $status ?></td>
		</tr>
	</tbody>
	<?php
	}
	?>
	<tr>
		<td></td><td></td><td><h5>total</h5></td><td></td><td></td>
		<td><?php echo "<h5>".$total_credits."</h5>" ?></td>
		<td></td>
		<td><?php echo "<h5>".$total_points_secured."</h5>" ?></td>
		<td></td>
	</tr>
	</table>
	</center>
	<hr>
	<h3>SGPA: <?php $sgpa=round($total_points_secured/$total_credits,2); echo $sgpa ?></h3>
	<h3>RESULT: <?php echo "<mark>".$result."</mark>" ?> </h3>
	<!-- <p>&#x2705;</p>-->
	<?php
	$color=["PASS"=>"#00ffbf","FAIL"=>"#ff6666"];
	?>
	<style>
	mark { 
	    background-color: <?php echo $color[$result] ?>;
	    color: black;
	}
	</style>
<?php	
	}
?>