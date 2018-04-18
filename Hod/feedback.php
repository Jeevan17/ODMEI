<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['hod'];

	include 'header.php';
	$hod_name = explode('_', $uname);
	$feedback = $hod_name[1].'_feedback';
	
	$sql = "SELECT * from notification Where Type = '$feedback'";
	$retval=mysqli_query($conn,$sql);
	$flag=null;
	while ($row = mysqli_fetch_array($retval))
	{
		$flag = $row['RollNumber'];
	}
	// var_dump($flag);
?>

<br><br>
<div class="row">
	<div class="col-sm-6 pt-2">
		<h3>Enable Staff Feedback : </h3>
	</div>
	<div class="col-sm-1">
	</div>
		<input type='checkbox' id='feedback' data-toggle='toggle' data-on='Ready' data-off='Not Ready' data-onstyle='success' data-offstyle='danger' onchange="loadToggle()"
		<?php 
			if($flag == 0)
			{
				echo "";
			}
			elseif($flag == 1)
			{
				echo "checked";
			}
		?>
		>
	</div>
</div>
<div id="test">
</div>

</div>
</div>
	<script src='Feedback/feedback.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	</body>
</html>