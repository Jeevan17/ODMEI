<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['hod'];

	include 'header.php';
	$hod_name = explode('_', $uname);
?>
<div class='row'>
	<div class='col-sm-2'>
		<ul class='nav nav-pills flex-column' role='tablist'>
			<li class='nav-item'>
				<a class='nav-link active' data-toggle='pill' href='#send'>Send Material</a>
			</li>
			<li class='nav-item'>
				<a class='nav-link' data-toggle='pill' href='#delete'>Delete Material</a>
			</li>
		</ul>
	</div>
	<div class='col-sm-9'>
		<div class='tab-content'>
			<div id='send' class='container tab-pane active'>
				<form action='send_circular.php' method='POST' enctype='multipart/form-data'>
					<div class='row'>
						<div class="col-sm-2 pt-2">
							File input
						</div>
						<div class="col">
							<input type="file" class="form-control-file" id="material" name="material" required>
					      	<small id="fileHelp" class="form-text text-muted">Select a File and Upload to share  (Less: 2 MB)</small>
					    </div>		
					</div>
					<hr>
					<center>
						<input type='submit' value='Upload' name='send' class='btn btn-outline-info pl-5 pr-5'>
					</center>
				</form>
			</div>
			<div id='delete' class='container tab-pane fade'>
				<div id='get_delete'>
					<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
						<thead>
							<tr>
								<th>File Name</th>
								<th>Download/Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * from news where role='$uname'";
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
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	if(isset($_POST["send"]))
	{
		$file_name = $_FILES['material']['name'];
		$file_type = $_FILES['material']['type'];
		$file_data = file_get_contents($_FILES['material']['tmp_name']);

		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['id'];
		}
		try
		{
			$dbh = new PDO("mysql:host=localhost;dbname=project", "admin", "cbit");
			$stmt = $dbh->prepare("INSERT INTO news(ID, Role, DocumentName, Description, File, Timeperiod) VALUES ('',?,?,?,?,?)");
			$stmt->bindParam(1, $role);
			$stmt->bindParam(2, $file_name);
			$stmt->bindParam(3, $file_type);
			$stmt->bindParam(4, $file_data);
			$stmt->bindParam(5, $timeperiod);
			$role = $uname;
			$stmt->execute();

			echo "
			<br>
			<div class='alert alert-info'>
				<strong>Circular Sent Successfully</strong>
			</div>";
		}
		catch(PDOException $e)
	    {
	    echo "Error: " . $e->getMessage();
	    }
	    $dbh = null;

	    $sql=null;
	    $sql = "SELECT RollNumber FROM student WHERE student.BSP IN (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch = '$hod_name[1]')";
	    $retval = mysqli_query($conn, $sql);
		$temp = 'News';
		while($row = mysqli_fetch_array($retval))
		{
			$rno = $row['RollNumber'];
			try
			{
				$dbh = new PDO("mysql:host=localhost;dbname=project", "admin", "cbit");
				$stmt = $dbh->prepare("INSERT INTO notification(Rollnumber, Type) VALUES (?,?)");
				$stmt->bindParam(1, $rno);
				$stmt->bindParam(2, $temp);
				$stmt->execute();
			}
			catch(PDOException $e)
		    {
		    echo "Inner Error: " . $e->getMessage();
		    }
		    $dbh = null;		
		}
	}
?>

</div>
</div>
	<script src='Circular/circular.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>
