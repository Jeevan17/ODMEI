<?php include '../dataConnections.php'; 

  session_start();
  if(!isset($_SESSION['Placement'])){
    echo "<script language='javascript'>window.location='../index.php';</script>";
  }
  $currentPage = 'Add Company Profile';
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
	<input type='text' class='form-control' id='cname' placeholder='CutOff GPA' name='cutoff' required style=' width: 200px; display: initial;'><br>
	<select class='form-control' name='type' required style=' width: 250px; display: initial;'>
		<option>Full Time</option>
		<option>Internship</option>
	</select><br><br>
	<input type='submit' value='SUBMIT' class='form-control button5' name='submit' required style=' width: 150px;' display: initial;>
</h3>
</form>
