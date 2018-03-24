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
		// $new = substr($yands,1,1);
		$yands = substr($yands,0,1).'/'.substr($yands,1,1).' Sem-'.substr($yands,-1);
		// var_dump($new);
		//$yands = $new;
		$sql = "SELECT * FROM `sgpa` WHERE RollNumber='$rno' group by RollNumber";
		$retval = mysqli_query($conn, $sql);
		$cgpa=0;
		$aff_rows = mysqli_affected_rows($conn);
		if($aff_rows==0)
		{
			die('Data not found !! ' . mysqli_error());
			exit();
		}
		while($row = mysqli_fetch_array($retval))
		{
			$cgpa+=$row['SGPA'];
		}
		$cgpa=$cgpa/$aff_rows;
		echo "<h3>CGPA: $cgpa </h3>";
		echo "<hr>";

		$sql="SELECT * from student_marks where student_marks.RollNumber='$rno' and student_marks.YearandSem='$yands'";
		$retval = mysqli_query($conn, $sql);
		$affected_rows = mysqli_affected_rows($conn);
		if($affected_rows==0)
		{
			die('Data not found !! ' . mysqli_error());
			exit();
		}	
?>
<center>
<table border="1">
	<tr>
		<th>SNo</th>
		<th>CourseID</th>
		<th>CourseName</th>
		<th>Timeperiod</th>
		<th>Syllabus Type </th>
		<th>Credits</th>
		<th>Final Grade</th>
		<th>Points Secured</th>
		<th>Status</th>
	</tr>
<?php
		$count=0;
		$total_credits=0;
		$total_points_secured=0;
		$result="PASS";
		while($row = mysqli_fetch_array($retval))
		{
			$count+=1;
?>
<tr>
	<td><?php echo $count;?></td>
	<td><?php echo $row['CourseID'];?></td>
	<?php
		$cid=$row['CourseID'];
		$sql2="SELECT * FROM courses 
		where courses.CourseID='$cid'";
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
		}
	?>
	<td><?php echo $credits; ?></td>
	<td><?php echo $grade; ?></td>
	<td><?php echo $points_secured ?></td>
	<td><?php echo $status ?></td>
</tr>
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
<h3>SGPA: <?php $sgpa=$total_points_secured/$total_credits; echo $sgpa ?></h3>
<h3>RESULT: <?php echo "<mark>".$result."</mark>" ?> </h3>
<!-- <p>&#x2705;</p>-->
<?php
$color=["PASS"=>"chartreuse","FAIL"=>"red"];
?>
<style>
mark { 
    background-color: <?php echo $color[$result] ?>;
    color: black;
}
</style>
<?php
	$sql="INSERT INTO `sgpa`(`RollNumber`, `YearandSem`, `Timeperiod`, `SGPA`) VALUES ('$rno','$yands','$id','$sgpa')";
	$retval = mysqli_query($conn, $sql);
	if(!$retval)
	{
		// die('Could not get data: ' . mysqli_error());
	}
}
?>