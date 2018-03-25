<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['COE'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Add New Courses';

	include 'header.php';										
?>
<h3><mark>New Course Details:</mark></h3><hr>
<div class='row'>
	<div class="col-sm-1 pt-3">
		Course ID: 
	</div>
	<div class="col-sm-2">
		<input type='text' id='cid' onkeyup="checkCID()" class='form-control' placeholder='Enter Course ID' name='cid' required >
	</div>
	<div class="col-sm-5 pt-2" id="check_cid"></div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-1">
		Course Name: 
	</div>
	<div class="col-sm-5">
		<input type='text' id='cname' class='form-control' placeholder='Enter Course Name' name='cname' required  >
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-3">
		Department: 
	</div>
	<div class="col-sm-2">
		<select class="form-control" id='dept' name='dept'>
			<option>CSE</option>
			<option>IT</option>
			<option>ECE</option>
			<option>Civil</option>
		</select>
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-3">
		Sessional: 
	</div>
	<div class="col-sm-2">
		<input type='text' id='sessional' class='form-control' placeholder='Enter Sessional Marks' name='sessional' required  >
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-3">
		SEE: 
	</div>
	<div class="col-sm-2">
		<input type='text' id='see' class='form-control' placeholder='Enter SEE Marks' name='see' required  >
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-3">
		Credits: 
	</div>
	<div class="col-sm-2">
		<input type='number' id='credits' class='form-control' placeholder='Enter Credits' name='credits' required  >
	</div>
</div>
<br>
<center><input type='submit' value='SUBMIT' onclick="addCourse()" class='btn btn-outline-success pl-5 pr-5' name='submit'></center>
<div id="addcourse"> </div>
</div>
</div>
	<script src="New_Course/newcourse.js"></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>