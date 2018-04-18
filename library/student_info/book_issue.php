<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['library'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['library'];
	if (array_key_exists('rno', $_POST) and array_key_exists('bi', $_POST))
	{
		$rno = $_POST['rno'];
		$bi = $_POST['bi'];
		$sql = "SELECT BookID FROM student_takes_books WHERE RollNumber='$rno' AND BookID='$bi' AND ReturnedDate IS NULL";
		$retval = mysqli_query($conn, $sql);
		if(mysqli_affected_rows($conn)!=0)
		{
			echo "<h5>Same book cannot be issued unless it is returned !</h5>";
		}
		else
		{
			$sql = "INSERT INTO `student_takes_books`(`RollNumber`, `BookID`, `CheckedOutDate`) VALUES ('$rno','$bi',CURRENT_DATE)";
			if(mysqli_query($conn, $sql))
			{
				?>
				<div>
				<?php
				echo "<h2>Success------Refresh the page</h2>";
				//echo "<script type='text/javascript'>alert('$rno');</script>";
				?>
				</div>
			<?php
			}
			else
			{
				echo "<h2>Error</h2>";
			}
		}
	}
?>