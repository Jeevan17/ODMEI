<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Faculty Details';

	include 'header.php';										
?>
<form action="faculty_details.php" method="post" enctype='multipart/form-data'>
<h3><mark>New Faculty Details:</mark></h3><hr>
<div class='row'>
	<div class="col-sm-1 pt-2">
		Staff ID: 
	</div>
	<div class="col-sm-4">
		<input type='text' onkeyup='checkSID()' class='form-control' id='sid' placeholder='Enter New Staff ID' name='sid' required  >
	</div>
	<div id="checkStaff" class="col-sm-1 pt-2"></div>
	<div class="col-sm-1 pt-2">
		Full Name:
	</div>
	<div class="col-sm-4">
		<input type="text" id='fname' class='form-control' placeholder='Enter Full Name' name='fname' required  >
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-2">
		Department: 
	</div>
	<div class="col-sm-4">
		<select class="form-control" id='dept' name='dept'>
			<option>CSE</option>
			<option>IT</option>
			<option>ECE</option>
			<option>Civil</option>
		</select>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-1 pt-2">
		Role: 
	</div>
	<div class="col-sm-4">
		<select class="form-control" id='role' name='role'>
			<option>Teaching</option>
			<option>Non-Teaching</option>
		</select>
	</div>
</div>
<br>
<div class="row">
	<div class="col-sm-1 pt-2">
		Specialization: 
	</div>
	<div class="col-sm-4">
		<input type='text' id='spzn' class='form-control' placeholder='Specialization' name='spzn' required  >
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-1 pt-2">
		Phone Number: 
	</div>
	<div class="col-sm-4">
		<input type='number' id='phno' class='form-control' placeholder='Phone number' name='phno' required  >
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-2">
		Email ID: 
	</div>
	<div class="col-sm-4">
		<input type='text' id='email' class='form-control' placeholder='E-mail' name='email' required  >
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-1 pt-2">
		Date of Joining:
	</div>
	<div class="col-sm-4">
		<input type='date' id='doj' class='form-control' placeholder='Phone number' name='doj' required  >
	</div>
</div>
<br>
<div class="row">
	<div class="col-sm-1 pt-1">
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

<?php
	if(isset($_POST["submit"]))
	{
		$sid = $_POST['sid'];
		$fname = $_POST['fname'];
		$dept = $_POST['dept'];
		$role = $_POST['role'];
		$spzn = $_POST['spzn'];
		$phno = $_POST['phno'];
		$email = $_POST['email'];
		$doj = $_POST['doj'];
		$photo = file_get_contents($_FILES['photo']['tmp_name']);
		$photo_type = $_FILES['photo']['type'];

		if(substr($photo_type, 0, 5) == "image")
		{
			try
			{
				$dbh = new PDO("mysql:host=localhost;dbname=project", "admin", "cbit");
				$stmt = $dbh->prepare("INSERT INTO `staff`(`StaffID`, `FullName`, `Department`, `Role`, `Specialization`, `PhoneNo`, `EmailID`, `DOJ`, `Photo`) VALUES (?,?,?,?,?,?,?,?,?)");
				$stmt->bindParam(1, $sid);
				$stmt->bindParam(2, $fname);
				$stmt->bindParam(3, $dept);
				$stmt->bindParam(4, $role);
				$stmt->bindParam(5, $spzn);
				$stmt->bindParam(6, $phno);	
				$stmt->bindParam(7, $email);
				$stmt->bindParam(8, $doj);
				$stmt->bindParam(9, $photo);
				
				$stmt->execute();

				echo "
				<div class='alert alert-success'>
					<strong>Record Inserted Successfully</strong>
				</div>";
				$sql = "INSERT INTO `staff_login`(`StaffID`, `Password`) VALUES ('$sid','1')";
				if (mysqli_query($conn, $sql))
				{
					
				}
				else
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
			catch(PDOException $e)
		    {
		    echo "Error: " . $e->getMessage();
		    }
		    $dbh = null;
		}
		else
		{
			echo "
				<div class='alert alert-success'>
					<strong>Only images are allowed</strong>
				</div>";
		}
		
	}
?>

</div>
</div>
	<script src='Admission_check/check.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>