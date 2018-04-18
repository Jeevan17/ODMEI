<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['library'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Add Books';
	$uname=$_SESSION['library'];
	include 'header.php';
?>
<h3><mark>New Book Details:</mark></h3><hr>
<div class='row'>
	<div class="col-sm-1 pt-2">
		Book ID: 
	</div>
	<div class="col-sm-5">
		<input type='text' id='bid' onkeyup="checkBID()" class='form-control' placeholder='Enter New BookID' name='bid' required  >
	</div>
	<div class="col-sm-5 pt-2" id="check_bid"></div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-2">
		Title: 
	</div>
	<div class="col-sm-5">
		<input type='text' id='btitle' class='form-control' placeholder='Enter the title' name='btitle' required  >
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-2">
		Author: 
	</div>
	<div class="col-sm-5">
		<input type='text' id='bauthor' class='form-control' placeholder='Enter Author names' name='bauthor' required  >
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-2">
		Publisher: 
	</div>
	<div class="col-sm-5">
		<input type='text' id='bpub' class='form-control' placeholder='Enter publisher' name='bpub' required  >
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-2">
		Edition: 
	</div>
	<div class="col-sm-5">
		<input type='text' id='bedition' class='form-control' placeholder='Enter edition' name='bedition' required  >
	</div>
</div>
<br>
<div class='row'>
	<div class="col-sm-1 pt-2">
		ISBN: 
	</div>
	<div class="col-sm-5">
		<input type='text' id='bisbn' class='form-control' placeholder='Enter ISBN' name='bisbn' required  >
	</div>
</div>
<br>
<center><input type='submit' value='SUBMIT' onclick="addBook()" class='btn btn-outline-success pl-5 pr-5' name='submit'></center>
<div id="addbook"> </div>

</div>
</div>
	<script src="student_info/student_info.js"></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>