<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Add Timeperiod';

	include 'header.php';								
?>
<center>
	
	<div class='row'>
		<div class="col-sm-2"></div>
		<div class="col-sm-4 pt-2"><h3>New TimePeriod : </h3></div>
		<div class="col-sm-4">
			<input type="text" style="text-transform: uppercase;" onkeyup="validateTP()" class='form-control' id='tp' placeholder='Eg: NOVEMBER-2017, APRIL-2018, MAY-2018' name='tp' required  >
		</div>
		<div id="val_tp" class="col-sm-0 pt-3"></div>
	</div><hr>
	<div class="row">
		<div class="col-sm-12">
			<input type='submit' onclick="checkTP()" value='SUBMIT' class='btn btn-outline-success pl-5 pr-5' name='submit'>
		</div>
	</div>
	<br>
	<div id="check_tp"></div>
</center>
</div>
</div>
<!-- 	<script>
	function validateTP(tp)
	{
		//var nbatch = document.forms["nb"]["new_batch"].value;
		var regex = /[A-Za-z]{2,10}\-[0-9]{4}$/;
		if(regex.test(tp.value) == false)
		{
			//alert('Invalid format !!');
			return false;
		}
		return true;
	}
	</script> -->
	<script src='Timeperiod/val_check.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>