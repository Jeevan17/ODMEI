<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Mid Marks';

	include 'header.php';										
?>
<div>
	<center>
		<label for='rno'>Enter Roll Number</label>
		<input type='text' class='form-control' onblur="loadCourses()" id='rno' placeholder='eg:- 160114733094' name='rollno' required style=' width: 200px;     display: initial;'>
		<input type='submit' value='Search' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;'>
		<div id='show_courses'></div>
	</center>
</div>
<?php 
	if(isset($_POST["submit"]))
	{
		// $test = $_POST['CS421'];
		// var_dump($test);
		$data1 = $_SESSION['data'];
		if(!isset($_SESSION['data'])){
		echo "<h1>data1 not found</h1>";
		}
		$affected_rows1 = $_SESSION['affected_rows'];
		$rno = $_SESSION['rollno'];
		// var_dump($affected_rows1);
		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['id'];
		}
		for($x=0; $x<$affected_rows1; $x++)
		{
			$mark = $_POST[$data1[$x]];
			$mark2 = $_POST[$data1[$x]."2"];
			// $sql = "INSERT INTO sem_marks VALUES('$rno','$data[$x]','1','$mark')";
			// $sql = "INSERT INTO `sem_marks`(`RollNumber`, `CourseID`, `Timeperiod`, `external`) VALUES ('$rno','$data1[$x]','$timeperiod','$mark')";
			$sql = "INSERT INTO `mid_marks`(`RollNumber`, `CourseID`, `Timeperiod`, `Mid1`, `Mid2`) VALUES ('$rno','$data1[$x]','$timeperiod','$mark','$mark2')";
			
			if (mysqli_query($conn, $sql))
			{
				// echo "New record inserted successfully";
			}
			else
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			if($x==$affected_rows1-1)
			{
				echo "<h3><mark>New record inserted successfully</mark></h3>";
			}
		}
	}
?>
</div>
</div>
	<script src='Mid_marks/Mid_marks.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>