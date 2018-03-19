<?php include '../dataConnections.php'; 

  session_start();
  if(!isset($_SESSION['Placement'])){
    echo "<script language='javascript'>window.location='../index.php';</script>";
  }
  $currentPage = 'other';
  include 'header.php';
?>
<style>
input[type='submit']:hover {
    background-color: grey;
    cursor: pointer;
    color: white;
    
}
.button5 {background-color: grey; color: white;}
</style>
<form action="company_profile.php" method="post">
<h3><mark>New Company Details:</mark><br><br>
	<input type='text' class='form-control' id='cname' placeholder='Enter company name' name='company_name' required style=' width: 200px; display: initial;'><br>
	<textarea rows="3" cols="50" class='form-control' placeholder='Enter description' name='description' required style=' width: 300px; display: initial;'></textarea><br>
	<input type='file'  class='form-control' placeholder='Upload logo' name='logo' required style=' width: 300px; display: initial;'><br>
	<h5><small id="fileHelp" class="form-text text-muted">Click "Choose File" and select company's logo</small></h5>
	<input type='text' class='form-control' id='cname' placeholder='CutOff GPA' name='cutoff' required style=' width: 200px; display: initial;'><br>
	<select name="ctype" class='form-control' required style=' width: 250px; display: initial;'>
		<option value="FullTime">FullTime</option>
		<option value="Internship">Internship</option>
	</select><br><br>
	<input type='submit' value='SUBMIT' class='form-control button5' name='submit' required style=' width: 150px;' display: initial;>
</h3>
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
	<script src="Attendance/AEC.js"></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>
