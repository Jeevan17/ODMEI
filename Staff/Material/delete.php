<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['staff'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['staff'];
	if (array_key_exists('id', $_POST))
	{
		$id = $_POST['id'];
		$sql = "DELETE FROM `material` WHERE id='$id'";
		if (mysqli_query($conn, $sql))
		{
		?>
			<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
				<thead>
					<tr>
						<th>Subject Name</th>
						<th>File Name</th>
						<th>Download/Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT courses.CourseName,material.ID,material.DocumentName,material.File FROM material INNER JOIN courses ON courses.CourseID=material.CourseID WHERE material.StaffID='$uname'";
						$retval = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($retval))
						{
							echo "
								<tr>
									<td>{$row['CourseName']}</td>
									<td>{$row['DocumentName']}</td>
									<td><a href='Material/download.php?id={$row['ID']}' class='btn btn-success'/>Download</a> <button onclick=loadDelete({$row['ID']}) class='btn btn-danger'>Delete</button></td>
								</tr>
							";
						}
					?>
				</tbody>
			</table>
			<?php
			echo "
			    <div class='alert alert-danger'>
					<strong>Record deleted successfully</strong>
				</div>";
		}
		else
		{
		    echo "
		    <div class='alert alert-danger'>
				<strong>Error deleting record:" . mysqli_error($conn);"</strong>
			</div>";
		}

   }
?>