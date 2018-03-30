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
			<input type='text' onkeyup="checkADMN()" class='form-control' id='admn' placeholder='Enter New Admission Number' name='admn_no' required  >
		</div>
		<div id="checkAdmn" class="col-sm-1 pt-2"></div>
		<div class="col-sm-1 pt-2">
			RollNumber: 
		</div>
		<div class="col-sm-4">
			<input type="text" id='roll_no' onkeyup="checkRNO()" class='form-control' placeholder='Enter New Roll number' name='roll_no' required  >
		</div>
		<div id="checkRno" class="col-sm-1 pt-2"></div>
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
<hr>
<form action='Admission_details.php' method='POST' enctype='multipart/form-data'>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-1 pt-2">
			File input
		</div>
		<div class="col-sm-4">
			<input type="file" class="form-control-file" id="excel" name="excel" required>
		  	<small id="fileHelp" class="form-text text-muted">Select a  ExcelFile and Upload</small>
		</div>
		<div class="col-sm-4">
			<input type='submit' value='Upload' class='btn btn-info pl-5 pr-5' name='Upload'>
		</div>
	</div>
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
		$photo_type = $_FILES['photo']['type'];

		$sql = "SELECT `BSP` FROM `bsp_code` WHERE Branch='$branch' and Section='$section' and Program='$program'";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$bsp = $row['BSP'];
		}

		if(substr($photo_type, 0, 5) == "image")
		{
			try
			{
				$dbh = new PDO("mysql:host=localhost;dbname=project", "admin", "cbit");
				$stmt = $dbh->prepare("INSERT INTO `student`(`AdmissionNumber`, `RollNumber`, `FirstName`, `LastName`, `BSP`, `CBatch`, `phoneNumber`, `Email`, `Photo`, `CurrentYandS`) VALUES (?,?,?,?,?,?,?,?,?,?)");
				$stmt->bindParam(1, $admn_no);
				$stmt->bindParam(2, $roll_no);
				$stmt->bindParam(3, $first_name);
				$stmt->bindParam(4, $last_name);
				$stmt->bindParam(5, $bsp);
				$stmt->bindParam(6, $batch);	
				$stmt->bindParam(7, $phno);
				$stmt->bindParam(8, $email);
				$stmt->bindParam(9, $photo);
				$stmt->bindParam(10, $currentyands);
				
				$stmt->execute();

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
<?php
	$output = ''; 
	if(isset($_POST["Upload"]))
	{
		$connection = mysqli_connect('localhost', 'admin', 'cbit','project');
		$extension = explode(".", $_FILES["excel"]["name"]);
		$allowed_extension = array("xls", "xlsx", "csv"); 
		if(in_array($extension[1], $allowed_extension)) 
		{
			$file = $_FILES["excel"]["tmp_name"];
			include("../PHPExcel/IOFactory.php"); 

			$objPHPExcel = PHPExcel_IOFactory::load($file); 
			$output .= "<center><label class='text-success'>Data Inserted</label><br></center>";
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				for($row=2; $row<=$highestRow; $row++)
				{
					$data = array();
					for ($i=0; $i <11 ; $i++)
					{ 
						array_push($data, mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow($i,$row)->getValue()));
					}
					try
					{
						$db = new PDO("mysql:host=localhost;dbname=project", "admin", "cbit");
						$statement = $db->prepare("SELECT BSP FROM bsp_code WHERE Program= :program and Branch= :branch and Section= :section");
						$statement->execute(array(':program' => "$data[4]",':branch' => "$data[5]", ':section' => "$data[6]"));
						$bsp = $statement->fetch();
					}
					catch(PDOException $e)
				    {
				    echo "Error: " . $e->getMessage();
				    }
				    $db = null;
					
					$query = "INSERT INTO student(`AdmissionNumber`, `RollNumber`, `FirstName`, `LastName`, `BSP`, `CBatch`, `phoneNumber`, `Email`, `CurrentYandS`) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$bsp[0]', '$data[7]', '$data[8]', '$data[9]', '$data[10]')";
					if(mysqli_query($conn, $query))
					{
						$query = "INSERT INTO `student_login`(`RollNumber`, `Password`) VALUES ('$data[1]', 1)";
						mysqli_query($conn, $query);
					}
					else
					{
						echo "Error: " . $query . "<br>" . mysqli_error($conn);
					}
				}
			} 
		}
		echo "$output";
	}
?>

</div>
</div>
	<script src='Admission_check/check2.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>