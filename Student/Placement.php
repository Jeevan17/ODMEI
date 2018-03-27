<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['student'];

	include 'header.php';
?>
<h3><mark>Placement Details: </mark></h3><hr>
<?php
	$sql="SELECT * FROM `student_attend_placements` WHERE RollNumber='$uname'";
	$retval=mysqli_query($conn, $sql);
?>
<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
<?php
	while($row=mysqli_fetch_array($retval))
	{
		$color='';
		if($row['Result']=='Placed')
		{
			$color='#66ff66';
		}
?>
	<tr bgcolor=<?php echo $color?>><td><?php echo $row['CompanyName'] ?></td><td><?php echo $row['Result'] ?></td></tr>
<?php
}
?>
</table>
</div>
</div>
		
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>