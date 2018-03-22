<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['hod'];

	include 'header.php';
	$hod_name = explode('_', $uname);
?>

<div class='row'>
	<div class="col-sm-1 pt-2">
		Program: 
	</div>
	<div class="col-sm-4">
		<select class="form-control" id="Program">
			<option>BE</option>
			<option>ME</option>
		</select>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-1 pt-2">
		YandS: 
	</div>
	<div class="col-sm-4">
		<select class="form-control" id="yands">
			<option>1/4 Sem-1</option>
			<option>1/4 Sem-2</option>
			<option>2/4 Sem-1</option>
			<option>2/4 Sem-2</option>
			<option>3/4 Sem-1</option>
			<option>3/4 Sem-2</option>
			<option>4/4 Sem-1</option>
			<option>4/4 Sem-2</option>
		</select>
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-2">
		Section: 
	</div>
	<div class="col-sm-4">
		<select class="form-control" id="Section">
			<option>1</option>
			<option>2</option>
			<option>3</option>
		</select>
	</div>
</div>
<hr>
<center><button onclick='loadTimetable()' class='btn btn-info'>Get Time Table</button></center>
<div id="getTimetable"></div>
</div>
</div>
		<script src='timetable/timetable.js'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>