<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['library'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Add Books';
	$uname=$_SESSION['library'];

	include 'header.php';
	$hod_name = explode('_', $uname);
?>
</div>
</div>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>