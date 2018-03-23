<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['student'];

	include 'header.php';

	if ($news_count > 0)
	{
		$sql = "DELETE FROM notification WHERE Rollnumber='$uname' AND Type='news'";

		if ($conn->query($sql) === TRUE)
		{
		}
		else
		{
		    echo "<h1>Error</h1>";
		}
 
	}
	$sql = "SELECT Branch FROM student INNER JOIN bsp_code ON student.BSP = bsp_code.BSP WHERE student.RollNumber=$uname";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$branch = $row['Branch'];
	}
?>

<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
	<thead>
		<tr>
			<th>File Name</th>
			<th>Download</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sql = "SELECT * from news WHERE Role = 'Principal' OR Role='Hod_$branch'";
			$retval = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($retval))
			{
				echo "
					<tr>
						<td>{$row['DocumentName']}</td>
						<td><a href='news/download.php?id={$row['ID']}' class='btn btn-success'/>Download</a></td>
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