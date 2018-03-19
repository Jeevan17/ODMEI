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
	$sql = "SELECT BSP,CBatch,CurrentYandS FROM student WHERE RollNumber='$uname'
";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$bsp = $row['BSP'];
		$batch = $row['CBatch'];
		$yands = $row['CurrentYandS'];
	}
?>

<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
	<thead>
		<tr>
			<th>Subject Name</th>
			<th>File Name</th>
			<th>Download</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sql = "SELECT courses.CourseName,material.DocumentName,material.File FROM material INNER JOIN courses ON courses.CourseID=material.CourseID WHERE material.BSP='$bsp' AND material.YearandSem='$yands' AND (material.Batch='$batch' OR material.Batch='0')";
			$retval = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($retval))
			{
				echo "
					<tr>
						<td>{$row['CourseName']}</td>
						<td>{$row['DocumentName']}</td>
						<td><a href='data:image/jpeg;base64,".base64_encode( $row['File'] )."'/>Download</a></td>
					</tr>
				";
			}
		?>
	</tbody>
</table>

</div>
</div>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>	