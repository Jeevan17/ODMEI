<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['student'];

	include 'header.php';
?>
<style>
	p {
		color: red;
    	font: bold;
	}
</style>
<div class='row'>
	<div class='col-sm-3'>
		<ul class='nav nav-pills flex-column' role='tablist'>
			<li class='nav-item'>
				<a class='nav-link active' data-toggle='pill' href='#send'>Upload Achievement</a>
			</li>
			<li class='nav-item'>
				<a class='nav-link' data-toggle='pill' href='#delete'>Uploaded Achievements</a>
			</li>
		</ul>
	</div>
	<div class='col-sm-9'>
		<div class='tab-content'>
			<div id='send' class='container tab-pane active'>
				<form action='student_achievements.php' method='POST' enctype='multipart/form-data'>
					<div class='row'>
						<div class="col-sm-20">
							<p><b>Important Note:</b><br>Once you upload you cannot rollback or delete. So make sure you upload the authenticated certificate.</p>
						</div>
					</div>
					<div class='row'>
						<div class="col-sm-2 pt-4">
							Title: 
						</div>
						<div class="col-sm-4 pt-2">
							<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
						</div>
					</div>
					<hr>
					<div class='row'>
						<div class="col-sm-2 pt-4">
							Description: 
						</div>
						<div class="col-sm-4 pt-2">
							<textarea id="description" name="description" class="form-control" placeholder="Enter Description" rows="3"></textarea>
						</div>
					</div>
					<hr>
					<div class='row'>
						<div class="col-sm-2 pt-4">
							File Input: 
						</div>
						<div class="col-sm-5">
							<input type="file" class="form-control-file" id="file" name="file" required>
					      	<small id="fileHelp" class="form-text text-muted">Select a File and Upload to share  (Max Limit: 2 MB)</small>
					    </div>
					</div><hr>
					<div class='row'>
						<div class="col-sm-2"></div>
						<input type='submit' value='Upload' name='submit' class='btn btn-outline-info pl-5 pr-5'>
					</div>
				</form>
			</div>
			<div id='delete' class='container tab-pane fade'>
				<div id='get_delete'>
					<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
						<thead>
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Document Name</th>
								<th>Download</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql="SELECT * FROM `student_achievements` WHERE RollNumber='$uname'";
								$retval = mysqli_query($conn, $sql);
								if(mysqli_num_rows($retval) > 0)
								{
									while($row=mysqli_fetch_array($retval))
									{
										echo "
											<tr>
												<td>{$row['Title']}</td>
												<td>{$row['Description']}</td>
												<td>{$row['DocumentName']}</td>
												<td><a href='material/download_std_achievements.php?id={$row['id']}' class='btn btn-success'/>Download</a> </td>
											</tr>
										";
									}
								}
								else
								{
									echo "<div class='alert alert-info'>
										<strong>Please Upload Your Achievements to Visible</strong>
									</div>";
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
	if(isset($_POST["submit"]))
	{
		$title=$_POST['title'];
		$desc = $_POST['description'];
		$file_name = $_FILES['file']['name'];
		$file_type = $_FILES['file']['type'];
		$file_data = file_get_contents($_FILES['file']['tmp_name']);
		try
		{
			$dbh = new PDO("mysql:host=localhost;dbname=project", "admin", "cbit");
			$stmt = $dbh->prepare("INSERT INTO `student_achievements`(`RollNumber`, `Title`, `Description`, `DocumentName`, `FileDescription`, `File`) VALUES (?,?,?,?,?,?)");
			$stmt->bindParam(1, $uname);
			$stmt->bindParam(2, $title);
			$stmt->bindParam(3, $desc);
			$stmt->bindParam(4, $file_name);
			$stmt->bindParam(5, $file_type);
			$stmt->bindParam(6, $file_data);
			$stmt->execute();
			echo "
			<hr>
			<div class='alert alert-info'>
				<strong>File Uploaded Successfully</strong>
			</div>";
		}
		catch(PDOException $e)
	    {
	    echo "Error: " . $e->getMessage();
	    }
	}
?>

</div>
</div>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>