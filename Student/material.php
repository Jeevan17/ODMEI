<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['student'];

	include 'header.php';

	if ($material_count > 0)
	{
		$sql = "DELETE FROM notification WHERE Rollnumber='$uname' AND Type='Material'";

		if ($conn->query($sql) === TRUE)
		{
		}
		else
		{
		    echo "<h1>Error</h1>";
		}
 
	}
?>

<!-- <table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
	<thead>
		<tr>
			<th>Subject Name</th>
			<th>File Name</th>
			<th>Download</th>
		</tr>
	</thead>
	<tbody>
		<?php
			//$sql = ''
		?>
		<tr>
			<td> -->

</div>
</div>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>	