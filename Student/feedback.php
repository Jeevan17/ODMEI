<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['student'];

	include 'header.php';

	if ($feedback_count > 0)
	{
		$sql = "DELETE FROM notification WHERE Rollnumber='$uname' AND Type='Feedback'";

		if ($conn->query($sql) === TRUE)
		{
		}
		else
		{
		    echo "<h1>Error</h1>";
		}
	}

	$sql = "SELECT Branch,CurrentYandS,CBatch FROM student INNER JOIN bsp_code ON student.BSP = bsp_code.BSP WHERE student.RollNumber=$uname";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$Bfeedback = $row['Branch'].'_feedback';
		$branch = $row['Branch'];
		$yands = $row['CurrentYandS'];
		$batch = $row['CBatch'];
	}
	$sql = "SELECT * FROM notification WHERE Type = '$Bfeedback'";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$flag = $row['RollNumber'];
	}
	if($flag == 1)
	{
		
		$sql ="SELECT * FROM `feedback` WHERE RollNumber='$uname'";
			$retval = mysqli_query($conn, $sql);
			if(!(mysqli_num_rows($retval)>0))
			{
				$sql = "SELECT timetable.StaffID,staff.FullName, timetable.CourseID, courses.CourseName FROM timetable INNER JOIN staff ON timetable.StaffID = staff.StaffID INNER JOIN courses ON timetable.CourseID = courses.CourseID WHERE timetable.YearandSem = '$yands' AND timetable.BSP = (SELECT student.BSP FROM student WHERE student.RollNumber ='$uname') AND timetable.CourseID IN (SELECT student_enroll_courses.CourseID FROM student_enroll_courses WHERE student_enroll_courses.RollNumber='$uname') AND (timetable.Batch = '$batch' OR timetable.Batch = '0') GROUP by timetable.StaffID";
				$retval = mysqli_query($conn, $sql);
				$data = array();
				while($row = mysqli_fetch_array($retval))
				{
					array_push($data, array($row['FullName'],$row['CourseName'],$row['StaffID'],$row['CourseID']));
				}
				?>
				<form method='POST' action='feedback.php'>
					<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
						<thead>
							<tr>
								<th></th>
								<th>Communication</th>
								<th>Teaching Methodology</th>
								<th>Controll over class</th>
								<th>Punctuality</th>
								<th>Doubts Clarification</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($data as $data_array)
								{
									echo "
										<tr>
											<td><center>$data_array[0]<hr>$data_array[1]</center></td>
											<td>
												<select class='form-control' name='$data_array[3]-communication-$data_array[2]'>
											        <option>5-Excellent</option>
											        <option>4-Good</option>
											        <option>3-Average</option>
											        <option>2-Bad</option>
											        <option>1-Very Bad</option>
										    	</select>
										    </td>
										    <td>
												<select class='form-control' name='$data_array[3]-methodology-$data_array[2]'>
											        <option>5-Excellent</option>
											        <option>4-Good</option>
											        <option>3-Average</option>
											        <option>2-Bad</option>
											        <option>1-Very Bad</option>
										    	</select>
										    </td>
										    <td>
												<select class='form-control' name='$data_array[3]-controlloverclass-$data_array[2]'>
											        <option>5-Excellent</option>
											        <option>4-Good</option>
											        <option>3-Average</option>
											        <option>2-Bad</option>
											        <option>1-Very Bad</option>
										    	</select>
										    </td><td>
												<select class='form-control' name='$data_array[3]-punctuality-$data_array[2]'>
											        <option>5-Excellent</option>
											        <option>4-Good</option>
											        <option>3-Average</option>
											        <option>2-Bad</option>
											        <option>1-Very Bad</option>
										    	</select>
										    </td><td>
												<select class='form-control' name='$data_array[3]-clarification-$data_array[2]'>
											        <option>5-Excellent</option>
											        <option>4-Good</option>
											        <option>3-Average</option>
											        <option>2-Bad</option>
											        <option>1-Very Bad</option>
										    	</select>
										    </td>
										</tr>
									";
								}
							?>
						</tbody>
					</table>
					<center><input type='submit' value='Submit' class='btn btn-outline-primary pl-5 pr-5' name='submit'></center><br>
				</form>
	<?php
			}
			else
			{
				echo "
				<div class='alert alert-danger'>
					<strong>Feedback Submited Already!</strong>
				</div>";
			}

	}
	else
	{
		echo "
			<div class='alert alert-danger'>
				<strong>There is no feedback form accessible at this moment</strong>
			</div>";
	}	
?>

<?php
	if(isset($_POST["submit"]))
	{
		foreach ($data as $data_array)
		{
			$communication = $_POST["$data_array[3]-communication-$data_array[2]"];
			$methodology = $_POST["$data_array[3]-methodology-$data_array[2]"];
			$controlloverclass = $_POST["$data_array[3]-controlloverclass-$data_array[2]"];
			$punctuality = $_POST["$data_array[3]-punctuality-$data_array[2]"];
			$clarification = $_POST["$data_array[3]-clarification-$data_array[2]"];

			$sql = "INSERT INTO `feedback`(`RollNumber`, `StaffID`, `CourseID`, `Communication`, `Methodology`, `controlloverclass`, `Punctuality`, `Clarification`) VALUES ('$uname', '$data_array[2]', '$data_array[3]', '$communication', '$methodology', '$controlloverclass', '$punctuality', '$clarification')";
			if (mysqli_query($conn, $sql))
			{

			}
			else
			{
			    echo "
			    	<div class='alert alert-dismissible alert-primary'>
			    		<strong>Error while Submitting</strong>
					</div>
				";
			}
		}
		echo "
			<script language='javascript'>window.location='feedback.php';</script>
			";
	}
?>

</div>
</div>
		
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>