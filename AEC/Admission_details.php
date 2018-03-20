<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Admission Details';

	include 'header.php';										
?>

<form action="Admission_details.php" method="post" enctype='multipart/form-data'>
	<h3><mark>New Admission Details:</mark></h3><hr>
	<div class='row'>
		<div class="col-sm-1 pt-2">
			Admission Number: 
		</div>
		<div class="col-sm-4">
			<input type='text' class='form-control' id='admn' placeholder='Enter Admission Number' name='admn_no' required  >
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-1 pt-2">
			RollNumber: 
		</div>
		<div class="col-sm-4">
			<input class='form-control' placeholder='Enter Roll number' name='roll_no' required  >
		</div>
	</div>
	<br>
	<div class='row'>
		<div class="col-sm-1 pt-2">
			First Name: 
		</div>
		<div class="col-sm-4">
			<input type='text' class='form-control' placeholder='Enter First Name' name='first_name' required  >
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-1 pt-2">
			Last Name: 
		</div>
		<div class="col-sm-4">
			<input type='text' class='form-control' placeholder='Enter Last Name' name='last_name' required  >
		</div>
	</div>
	<br>
	<div class='row'>
		<div class="col-sm-1 pt-2">
			Branch: 
		</div>
		<div class="col-sm-4">
			<input type='text' class='form-control' placeholder='Branch' name='branch' required  >
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-1 pt-2">
			Section: 
		</div>
		<div class="col-sm-4">
			<input type='text' class='form-control' placeholder='Section' name='section' required  >
		</div>
	</div>
	<br>
	<div class='row'>
		<div class="col-sm-1 pt-2">
			Program: 
		</div>
		<div class="col-sm-4">
			<input type='text' class='form-control' placeholder='Program' name='program' required  >
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-1 pt-2">
			Batch: 
		</div>
		<div class="col-sm-4">
			<select class="form-control" name='batch'>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<!-- <option>4</option> -->
			</select>
		</div>
	</div>
	<br>
	<div class='row'>
		<div class="col-sm-1 pt-2">
			Year and Sem: 
		</div>
		<div class="col-sm-4">
			<select class="form-control" name="currentyands">
				<option>1/4 Sem-1</option>
				<option>1/4 Sem-2</option>
				<option>2/4 Sem-1</option>
				<option>2/4 Sem-2</option>
				<option>3/4 Sem-1</option>
				<option>3/4 Sem-2</option>
				<option>4/4 Sem-1</option>
				<option>4/4 Sem-2</option>
				<option>1/2 Sem-1</option>
				<option>1/2 Sem-2</option>
				<option>2/2 Sem-1</option>
				<option>2/2 Sem-2</option>
			</select>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-1 pt-2">
			Phone Number: 
		</div>
		<div class="col-sm-4">
			<input type='number' class='form-control' placeholder='Phone number' name='phno' required  >
		</div>
	</div>
	<br>
	<div class='row'>
		<div class="col-sm-1 pt-2">
			Email ID: 
		</div>
		<div class="col-sm-4">
			<input type='text' class='form-control' placeholder='E-mail' name='email' required  >
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-1 pt-2">
			Upload Photo: 
		</div>
		<div class="col-sm-4">
			<input type="file" class="form-control-file" id="photo" name="photo" required>
	      	<small id="fileHelp" class="form-text text-muted">Upload passport size photo</small>
		</div>
	</div>
	<br>
	<center><input type='submit' value='SUBMIT' class='btn btn-outline-success pl-5 pr-5' name='submit'></center>
</form>
<br>
<?php
	if(isset($_POST["submit"]))
	{
		$admn_no = $_POST['admn_no'];
		$roll_no = $_POST['roll_no'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$branch = $_POST['branch'];
		$section = $_POST['section'];
		$program = $_POST['program'];
		$batch = $_POST['batch'];
		$currentyands = $_POST['currentyands'];
		$phno = $_POST['phno'];
		$email = $_POST['email'];
		$photo = file_get_contents($_FILES['photo']['tmp_name']);

		$sql = "SELECT `BSP` FROM `bsp_code` WHERE Branch='$branch' and Section='$section' and Program='$program'";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$bsp = $row['BSP'];
		}

		$sql = "INSERT INTO `student`(`AdmissionNumber`, `RollNumber`, `FirstName`, `LastName`, `BSP`, `CBatch`, `phoneNumber`, `Email`, `Photo`, `CurrentYandS`) VALUES ('$admn_no','$roll_no','$first_name','$last_name','$branch','$bsp','$batch','$phno','$email','$photo')";
		if (mysqli_query($conn, $sql))
		{
			echo "
			<div class='alert alert-success'>
				<strong>Record Inserted Successfully</strong>
			</div>";
			$sql = "INSERT INTO `student_login`(`RollNumber`, `Password`) VALUES ('$roll_no','1')";
			if (mysqli_query($conn, $sql))
			{
				
			}
			else
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		else
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
?>
</div>
</div>
	<script src='Attendance/staff.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>