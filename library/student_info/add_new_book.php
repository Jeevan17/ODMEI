<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['library'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['library'];
	if (array_key_exists('bid', $_POST) and array_key_exists('btitle', $_POST) and array_key_exists('bauthor', $_POST) and array_key_exists('bpub', $_POST) and array_key_exists('bedition', $_POST) and array_key_exists('bisbn', $_POST))
	{
		$bid=$_POST['bid'];
		$btitle=$_POST['btitle'];
		$bauthor=$_POST['bauthor'];
		$bpub=$_POST['bpub'];
		$bedition=$_POST['bedition'];
		$bisbn=$_POST['bisbn'];
		$sql = "INSERT INTO `library`(`BookID`, `Title`, `Author`, `Publisher`, `Edition`, `ISBN`) VALUES ('$bid','$btitle','$bauthor','$bpub','$bedition','$bisbn')";
		$retval = mysqli_query($conn,$sql);
		if(!$retval)
		{
			 die('Could not add new book!: ' . mysqli_error());
		}
		else
		{
			echo "<h3>New Book added successfully!</h3>";
		}
	}
?>