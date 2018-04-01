<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'Marks Details';
	$uname=$_SESSION['student'];
	$rno = $_SESSION['rno'];
	if(!isset($_SESSION['rno']))
	{
		echo "<h1>Roll number not found</h1>";
	}

	include 'header.php';

	$sql = "SELECT YearandSem FROM `student_marks` WHERE RollNumber = '$uname' GROUP BY YearandSem";
	$retval = mysqli_query($conn, $sql);
?>
	
	<div class="row">
		<?php 
		while($row = mysqli_fetch_array($retval))
		{?>
				<div class='col-sm-1'>
					<input type=button id="<?php echo $row['YearandSem'] ?>" class='btn btn-info' value="<?php echo $row['YearandSem'] ?>"	onclick="load42('<?php echo $rno ?>' , '<?php echo $row['YearandSem'] ?>')">
				</div>
		<?php } ?>
	</div>
	<div id='show_marks'>
	</div>

</div>
</div>
		<script src='marks/marks.js'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>