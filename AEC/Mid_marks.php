<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Mid Marks';

	include 'header.php';										
?>
<div class='row'>
	<div class='col-sm-3'>
		<ul class='nav nav-pills flex-column' role='tablist'>
			<li class='nav-item'>
				<a class='nav-link active' data-toggle='pill' href='#Add_Mid1'>Add Mid1 Marks</a>
			</li>
			<li class='nav-item'>
				<a class='nav-link' data-toggle='pill' href='#Add_Mid2'>Add Mid2 Marks</a>
			</li>
			<li class='nav-item'>
				<a class='nav-link' data-toggle='pill' href='#Update_Mid1'>Update Mid1 Marks</a>
			</li>
			<li class='nav-item'>
				<a class='nav-link' data-toggle='pill' href='#Update_Mid2'>Update Mid2 Marks</a>
			</li>
		</ul>
	</div>
	<div class='col-sm-8'>
		<div class='tab-content'>
			<div id='Add_Mid1' class='container tab-pane active'>
				<br>
				<center>
					<label for='rno'>Enter Roll Number</label>
					<input type='text' class='form-control' onkeyup="loadAddMid1(this.value)" id='rno' placeholder='eg:- 160114733094' name='rollno' required style=' width: 200px;     display: initial;'>
					<div id='add_mid1'></div>
				</center>
			</div>
			<div id='Add_Mid2' class='container tab-pane fade'>
				<br>
				<center>
					<label for='rno'>Enter Roll Number</label>
					<input type='text' class='form-control' onkeyup="loadAddMid2(this.value)" id='rno' placeholder='eg:- 160114733094' name='rollno' required style=' width: 200px;     display: initial;'>
					<div id='add_mid2'></div>
				</center>
			</div>
			<div id='Update_Mid1' class='container tab-pane fade'>
				<br>
				<center>
					<label for='rno'>Enter Roll Number</label>
					<input type='text' class='form-control' onkeyup="loadUpdateMid1(this.value)" id='rno' placeholder='eg:- 160114733094' name='rollno' required style=' width: 200px;     display: initial;'>
					<div id='update_mid1'></div>
				</center>
			</div>
			<div id='Update_Mid2' class='container tab-pane fade'>
				<br>
				<center>
					<label for='rno'>Enter Roll Number</label>
					<input type='text' class='form-control' onkeyup="loadUpdateMid2(this.value)" id='rno' placeholder='eg:- 160114733094' name='rollno' required style=' width: 200px;     display: initial;'>
					<div id='update_mid2'></div>
				</center>
			</div>
		</div>
	

<?php 
	if(isset($_POST["addMid1"]))
	{
		$data1 = $_SESSION['data'];
		if(!isset($_SESSION['data'])){
			echo "<h1>data1 not found</h1>";
		}
		$affected_rows1 = $_SESSION['affected_rows'];
		$rno = $_SESSION['rollno'];
		
		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['id'];
		}
		for($x=0; $x<$affected_rows1; $x++)
		{
			$mark = $_POST[$data1[$x]];
			
			$sql = "INSERT INTO `mid_marks`(`RollNumber`, `CourseID`, `Timeperiod`, `Mid1`) VALUES ('$rno','$data1[$x]','$timeperiod','$mark')";
			
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
				echo "
					<br>
					<div class='alert alert-dismissible alert-danger'>
						<strong>Mid1 Marks Added successfully</strong>
					</div>
				";
			}
		}
	}
?>

<?php 
	if(isset($_POST["addMid2"]))
	{
		$data1 = $_SESSION['data'];
		if(!isset($_SESSION['data'])){
			echo "<h1>data1 not found</h1>";
		}
		$affected_rows1 = $_SESSION['affected_rows'];
		$rno = $_SESSION['rollno'];
		
		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['id'];
		}
		for($x=0; $x<$affected_rows1; $x++)
		{
			$mark = $_POST[$data1[$x]];
			
			$sql = "UPDATE `mid_marks` SET `Mid2`= '$mark' WHERE RollNumber = '$rno' AND CourseID = '$data1[$x]' AND Timeperiod = '$timeperiod'";
			
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
				echo "
					<br>
					<div class='alert alert-dismissible alert-danger'>
						<strong>Mid2 Marks Added successfully</strong>
					</div>
				";
			}
		}
	}
?>

<?php 
	if(isset($_POST["updateMid1"]))
	{
		$data1 = $_SESSION['data'];
		if(!isset($_SESSION['data'])){
			echo "<h1>data1 not found</h1>";
		}
		$affected_rows1 = $_SESSION['affected_rows'];
		$rno = $_SESSION['rollno'];
		
		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['id'];
		}
		for($x=0; $x<$affected_rows1; $x++)
		{
			$mark = $_POST[$data1[$x]];
			
			$sql = "UPDATE `mid_marks` SET `Mid1`= '$mark' WHERE RollNumber = '$rno' AND CourseID = '$data1[$x]' AND Timeperiod = '$timeperiod'";
			
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
				echo "
					<br>
					<div class='alert alert-dismissible alert-danger'>
						<strong>Mid2 Marks Added successfully</strong>
					</div>
				";
			}
		}
	}
?>

<?php 
	if(isset($_POST["updateMid2"]))
	{
		$data1 = $_SESSION['data'];
		if(!isset($_SESSION['data'])){
			echo "<h1>data1 not found</h1>";
		}
		$affected_rows1 = $_SESSION['affected_rows'];
		$rno = $_SESSION['rollno'];
		
		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['id'];
		}
		for($x=0; $x<$affected_rows1; $x++)
		{
			$mark = $_POST[$data1[$x]];
			
			$sql = "UPDATE `mid_marks` SET `Mid2`= '$mark' WHERE RollNumber = '$rno' AND CourseID = '$data1[$x]' AND Timeperiod = '$timeperiod'";
			
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
				echo "
					<br>
					<div class='alert alert-dismissible alert-danger'>
						<strong>Mid2 Marks Added successfully</strong>
					</div>
				";
			}
		}
	}
?>


</div>
</div>
</div>
</div>
	<script src='Mid_marks/Mid_marks.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>