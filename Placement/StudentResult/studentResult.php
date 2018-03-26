<?php include '../../dataConnections.php'; 

session_start();
if(!isset($_SESSION['Placement'])){
	echo "<script language='javascript'>window.location='../index.php';</script>";
}
if (array_key_exists('cname', $_POST))
{
	$Cname = $_POST['cname'];
	echo "<center><hr><h3><mark>$Cname</mark></h3></center>";

	$sql = '' ;
?>
	
	<br><br>
	<form action='Student_Result.php' method='POST' enctype='multipart/form-data'>
		<div class='row'>
			<div class="col-sm-2 pt-2">
				Start Date: 
			</div>
			<div class="col-sm-4">
				<input class="form-control" type="date" name="Sdate" required>
			</div>
			<div class="col-sm-2 pt-2">
				End Date: 
			</div>
			<div class="col-sm-4">
				<input class="form-control" type="date" name="Edate" required>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-2 pt-2">
				File input
			</div>
			<div class="col-sm-4">
				<input type="file" class="form-control-file" id="excel" name="excel" required>
			  	<small id="fileHelp" class="form-text text-muted">Select a  ExcelFile and Upload to Add Student Result</small>
			</div>
		</div>
		<hr>
		<center>
			<input type='submit' value='Upload' class='btn btn-info pl-5 pr-5' name='Upload'>
		</center>
		<?php $_SESSION['CompanyName'] = $Cname; ?>
	</form>
<?php
}
?>