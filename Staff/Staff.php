<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['staff'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Staff';
	$uname=$_SESSION['staff'];
	
	include 'header.php';										
	$sql = "select * from staff where StaffID='$uname'";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$photo = $row['Photo'];
		$name = $row['FullName'];
		$sid = $uname;
		$phno = $row['PhoneNo'];
		$email = $row['EmailID'];
		$Specialization = $row['Specialization'];
	}
?>
<br>
	<div class="row">
		<div class="col-sm-6">
			<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
				<tbody>
					<tr>
						<th rowspan='5'>
							<?php 
								echo "
			        			<img src='data:image/jpeg;base64,".base64_encode( $photo )."'  alt='photo' height='150' width='120'/> 
			        			";
			        		?>
		        		</th>
					    <th scope="row">Name</th>
					    <td><?php echo "$name" ?></td>
						<tr >
					      <th scope="row">Staff ID</th>
					      <td><?php echo "$sid" ?></td>
					    </tr>
						<tr >
					      <th scope="row">Phone No</th>
					      <td><?php echo "$phno" ?></td>
					    </tr>
						<tr >
					      <th scope="row">EMAIL ID</th>
					      <td><?php echo "$email" ?></td>
					    </tr>
						<tr >
					      <th scope="row">Specialization</th>
					      <td><?php echo "$Specialization" ?></td>
					    </tr>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<div>
</div>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>