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
			echo "Success";
			echo "<script language='javascript'>window.location='./library.php';</script>";	
		}
		else
		{
			echo "Error";
		}
	}
?>