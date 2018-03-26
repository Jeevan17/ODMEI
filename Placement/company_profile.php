<?php include '../dataConnections.php'; 

  session_start();
  if(!isset($_SESSION['Placement'])){
    echo "<script language='javascript'>window.location='../index.php';</script>";
  }
  $currentPage = 'other';
  include 'header.php';
?>
<form action="company_profile.php" method="post">
	
	<h3><mark>New Company Details:</mark></h3>
	<hr>
	<div class="row">
		<div class="col-sm-3 pt-2">
			<h5>Company Name:</h5>
		</div>
		<div class="col-sm-5">
			<input type='text' class='form-control' id='cname' placeholder='Enter company name' name='company_name' required>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-sm-3 pt-2">
			<h5>Company Description:</h5>
		</div>
		<div class="col-sm-5">
			<textarea rows="3" cols="50" class='form-control' placeholder='Enter description' name='description' required></textarea>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-sm-3 pt-2">
			<h5>Company Logo:</h5>
		</div>
		<div class="col-sm-5">
			<input type="file" class="form-control-file" id="material" name="logo" required>
	      	<small id="fileHelp" class="form-text text-muted">Click "Choose File" and select company's logo(Max: 64KiB)</small>
	    </div>
	</div>
	<br>
	<div class="row">
		<div class="col-sm-3 pt-2">
			<h5>Cut Off:</h5>
		</div>
		<div class="col-sm-5">
			<input type='text' class='form-control' id='cname' placeholder='CutOff GPA' name='cutoff' required>
	    </div>
	</div>
	<br>
	<div class="row">
		<div class="col-sm-3 pt-2">
			<h5>Job Type:</h5>
		</div>
		<div class="col-sm-5">
			<select name="ctype" class='form-control' required>
				<option>FullTime</option>
				<option>Internship</option>
			</select>
	    </div>
	</div>
	<hr>
	<center>
		<input type='submit' value='SUBMIT' class='btn btn-outline-danger pl-5 pr-5' name='submit'>
	</center>
	<br>
</form>
<?php
	if(isset($_POST["submit"]))
	{
		if(isset($_POST["ctype"]))
		{
			$c_name = $_POST['company_name'];
			$desc = $_POST['description'];
			$logofile = $_POST['logo'];
			$cutoffgpa = $_POST['cutoff'];
			$ctype = $_POST['ctype'];
			// var_dump($c_name);
			// var_dump($ctype);

			$sql = "INSERT INTO placement 
				(CompanyName, Description, Logo, CutOff, Type) 
				VALUES ('$c_name', '$desc', '$logofile', '$cutoffgpa', '$ctype')";
			if (mysqli_query($conn, $sql)) 	
			{
			   echo "
					<div class='alert alert-danger'>
						<strong>New Company details added successfully!</strong>
					</div>
					";
			} 
			else 
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}	
	}
?>
</div>
</div>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>
