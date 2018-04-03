<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['library'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Home';
	$uname=$_SESSION['library'];

	include 'header.php';
	$hod_name = explode('_', $uname);
?>

<div>
	<label for='rno'>Enter Student's Roll Number: </label>
	<input type='text' class='form-control' onkeyup="loadStudentInfo()" id='rno' placeholder='eg:- 160114733313' name='rollno' required style=' width: 200px; display: initial;'>
	<input type='submit' value='Search' name='submit' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;'>
</div>
<div id="result"></div>


</div>
</div>
	<script src='student_info/student_info.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>