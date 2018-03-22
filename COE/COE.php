<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['COE'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'External Marks';

	include 'header.php';										
?>
<div>
	<center>
		<form action='COE.php' method='POST'>
			<label for='rno'>Enter Roll Number</label>
			<input type='text' class='form-control' id='rno' placeholder='eg:- 160114733313' name='rollno' required style=' width: 200px;     display: initial;'>
			<input type='submit' value='Search' name='submit' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;'>
		</form>
	</center>
</div>
</div>
</div>
<?php
$GLOBALS['data']=array();
if(isset($_POST["submit"]))
{
	if($_POST['rollno']!=null)
	{
		//session_start();
		if(!isset($_SESSION['COE'])){
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
		$rno = $_POST['rollno'];
		$sql = "SELECT student_enroll_courses.CourseID,courses.CourseName from student_enroll_courses join courses on student_enroll_courses.CourseID=courses.CourseID where student_enroll_courses.RollNumber='$rno' and student_enroll_courses.YearandSem = (select CurrentYandS from student where student.RollNumber='$rno')";
		$retval = mysqli_query($conn, $sql);
		if(! $retval )
		{
			echo "<script>alert('Entered RollNo does not exist!')</script>";
			die('Could not get data: ' . mysqli_error());
		}	
		$GLOBALS['affected_rows'] = mysqli_affected_rows($conn);

		// echo "$affected_rows";		
		// var_dump($affected_rows);				
		if(mysqli_num_rows($retval) > 0)
		 {

?>
<h3><mark><?php echo $rno ?></mark></h3>
<table>
	<th>
		<tr><td>Courses</td> <td>External Marks</td></tr>
	</th>
	<form method='POST' action='COE.php'>
	<?php
	while($row = mysqli_fetch_array($retval))
	{ ?>
		<tr>
			<td><?php echo "{$row['CourseID']}"."--"."{$row['CourseName']}" ?></td>
			<td>
				<?php $nm=$row['CourseID']; ?>
				<input type=text name="<?php echo $nm; ?>" placeholder="<?php echo $nm; ?>">
				<?php
				array_push($data,"{$row['CourseID']}");
				// var_dump($data);		
				?>
			</td>
		</tr>
	<?php
	} ?>
</table>
<input type=submit name="submit2">
</form>
<?php

}
}
}
var_dump($affected_rows);
?>
<?php
	//var_dump($data);
	var_dump($affected_rows);
	if(isset($_POST["submit2"]))
	{
		var_dump($new_data);
		var_dump($affected_rows);
		echo "submit2 successful";

		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['id'];
		}
		for($x=0; $x<$affected_rows; $x++)
		{
			$mark = $_POST['$data[$x]'];
			// $sql = "INSERT INTO sem_marks VALUES('$rno','$data[$x]','1','$mark')";
			$sql = "INSERT INTO `sem_marks`(`RollNumber`, `CourseID`, `Timeperiod`, `external`) VALUES ('$rno','$data[$x]','$timeperiod','$mark')";
			if (mysqli_query($conn, $sql))
			{
				echo "New record inserted successfully";
			}
			else
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
	// echo "$newdata[CS421]";
	//var_dump($data);
?>

</div>
</div>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>