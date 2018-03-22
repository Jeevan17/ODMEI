<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	if (array_key_exists('id', $_POST))
	{
		$id = $_POST['id'];
		$sql = "DELETE FROM `news` WHERE id='$id'";
		if (mysqli_query($conn, $sql))
		{
		?>
			<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
						<thead>
							<tr>
								<th>File Name</th>
								<th>Download/Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * from news where role='Principal'";
								$retval = mysqli_query($conn, $sql);
								while($row = mysqli_fetch_array($retval))
								{
									echo "
										<tr>
											<td>{$row['DocumentName']}</td>
											<td><a href='Material/download.php?id={$row['ID']}' class='btn btn-success'/>Download</a> <button onclick='loadDelete({$row['ID']})' class='btn btn-danger'>Delete</button></td>
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