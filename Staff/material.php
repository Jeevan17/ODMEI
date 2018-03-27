	<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['staff'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Material';
	$uname=$_SESSION['staff'];
	
	include 'header.php';										
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
				<form action='material.php' method='POST' enctype='multipart/form-data'>
					<div class='row'>
						<div class="col-sm-1 pt-2">
							Courses: 
						</div>	
						<div class="col-sm-4">
							<?php
								$sql = "SELECT courses.CourseName,courses.CourseID FROM courses WHERE courses.CourseID IN (SELECT staff_teaches_courses.CourseID FROM staff_teaches_courses WHERE staff_teaches_courses.StaffID='$uname')";
								$retval = mysqli_query($conn, $sql);
								echo "<select class='form-control' id='courses' name='courses' onchange='loadBSP()'>
										<option selected='selected'>-</option>
									";
								while($row = mysqli_fetch_array($retval))
								{
									echo "<option>".$row['CourseID']."--".$row['CourseName']."</option>";
								}
								echo "</select>";
							?>
						</div>
						<div class="col-sm-1"></div>
						<div class="col-sm-1 pt-2">
							File input
						</div>
						<div class="col-sm-4">
							<input type="file" class="form-control-file" id="material" name="material" required>
					      	<small id="fileHelp" class="form-text text-muted">Select a File and Upload to share  (Less: 2 MB)</small>
					    </div>		
					</div>
					<div id='getBSP'>
					</div>
					<br>
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
		$cid = explode("--",$_POST['courses']);

		$file_name = $_FILES['material']['name'];
		$file_type = $_FILES['material']['type'];
		$file_data = file_get_contents($_FILES['material']['tmp_name']);

		$Program = $_POST['Program'];
		$yands = $_POST['yands'];
		$Branch = $_POST['Branch'];
		$Section = $_POST['Section'];
		$batch = $_POST['Batch'];
		
		$sql = "SELECT max(id) AS id FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['id'];
		}
		$sql = "SELECT BSP FROM bsp_code WHERE Branch = '$Branch' AND Program = '$Program' AND Section = '$Section'";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$bsp = $row['BSP'];
		}
		try
		{
			$dbh = new PDO("mysql:host=localhost;dbname=project", "admin", "cbit");
			$stmt = $dbh->prepare("INSERT INTO material(StaffID, CourseID, Timeperiod, YearandSem, BSP, Batch, DocumentName, Description, File) VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->bindParam(1, $uname);
			$stmt->bindParam(2, $cid[0]);
			$stmt->bindParam(3, $timeperiod);
			$stmt->bindParam(4, $yands);
			$stmt->bindParam(5, $bsp);
			$stmt->bindParam(6, $temp);	
			$stmt->bindParam(7, $file_name);
			$stmt->bindParam(8, $file_type);
			$stmt->bindParam(9, $file_data);
			if ($batch == 'All (1, 2 and 3)')
			{
				$temp = '0';
			}
			else
			{
				$temp = $batch;
			}
			$stmt->execute();

			echo "
			<br>
			<div class='alert alert-info'>
				<strong>File Uploaded Successfully</strong>
			</div>";
		}
		catch(PDOException $e)
	    {
	    echo "Error: " . $e->getMessage();
	    }
	    $dbh = null;

	    $sql=null;
	    if ($batch == 'All (1, 2 and 3)')
		{
			$sql = "SELECT student_enroll_courses.RollNumber FROM student_enroll_courses WHERE student_enroll_courses.CourseID='$cid[0]' AND student_enroll_courses.RollNumber IN (SELECT student.RollNumber FROM student WHERE student.BSP='$bsp')";
		}
		else
		{
			$sql = "SELECT student_enroll_courses.RollNumber FROM student_enroll_courses WHERE student_enroll_courses.CourseID='$cid[0]' AND student_enroll_courses.RollNumber IN (SELECT student.RollNumber FROM student WHERE student.BSP='$bsp' AND student.CBatch='$batch')";
		}
	    $retval = mysqli_query($conn, $sql);
		$temp = 'Material';
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
	<script src='Material/material.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>
