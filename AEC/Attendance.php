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
	if (array_key_exists('date', $_POST) and array_key_exists('timeperiod', $_POST) and array_key_exists('present', $_POST) and array_key_exists('absent', $_POST))
	{
		$present=json_decode($_POST['present']);
		$absent=json_decode($_POST['absent']);
		$timeperiod=json_decode($_POST['timeperiod']);
		$date=$_POST['date'];
		$course = $_POST['course'];
		echo "<br>$date<br>";
		
		var_dump($present);
		echo "<br>";
		var_dump($absent);
		echo "<br>";
		var_dump($timeperiod);
		echo "<br>";

		foreach ($present as $rno)
		{
			$sql = "INSERT INTO dailyattendance (RollNumber,CourseID,Timeperiod,Date,Timeslot,Attendance)
					VALUES ('$rno',)";
		}
		// $retval = mysqli_query($conn, $sql);
		// while($row = mysqli_fetch_array($retval))
		// {
		// 	$photo = $row['Photo'];
		// 	$name = $row['FirstName']." ".$row['LastName'];
		// 	$rno = $uname;
		// 	$phno = $row['PhoneNumber'];
		// 	$email = $row['Email'];
		// }        
	}
?>