<html>
<head>
	<script src="jquery-3.3.1.min.js"></script>
</head>
<body>
<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['library'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['library'];
	if (array_key_exists('rno', $_POST) and array_key_exists('bid', $_POST))
	{
		$rno = $_POST['rno'];
		$bid = $_POST['bid'];
		$sql = "UPDATE `student_takes_books` SET `ReturnedDate`=CURRENT_DATE WHERE RollNumber='$rno' AND BookID='$bid'";
		if(mysqli_query($conn, $sql))
		{
			?>
			<div>
			<?php
			echo "Success------Refresh the page";
			echo "<script type='text/javascript'>alert('$rno');</script>";
			?>
			</div>
		<?php
		}
		else
		{
			echo "Error";
		}
	}
?>
<script>
$(document).ready(function(){
    $("div").load(function(){
        
    });
});
</script>
</body>
</html>