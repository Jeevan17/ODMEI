<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['student'];

	include 'header.php';


	$sql = "SELECT Branch,CurrentYandS FROM student INNER JOIN bsp_code ON student.BSP = bsp_code.BSP WHERE student.RollNumber=$uname";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$BEnroll = $row['Branch'].'_Enroll';
		$branch = $row['Branch'];
		$yands = $row['CurrentYandS'];
	}

	$sql = "SELECT * FROM notification WHERE Type = '$BEnroll'";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$flag = $row['RollNumber'];
	}
	if(mysqli_num_rows($retval)>0)
	{
		if($flag == 1)
		{
			$sql ="SELECT * FROM `student_enroll_courses` WHERE RollNumber='$uname' AND YearandSem='$yands'";
			$retval = mysqli_query($conn, $sql);
			if(!(mysqli_num_rows($retval)>0))
			{
				$sql = "SELECT course_yands.CourseID, Type, courses.CourseName FROM course_yands INNER JOIN courses ON courses.CourseID = course_yands.CourseID WHERE Branch='$branch' AND YearandSem='$yands'";
				$retval = mysqli_query($conn, $sql);
				$data = array();
				while($row = mysqli_fetch_array($retval))
				{
					$data[$row['Type']][$row['CourseID']] = $row['CourseName'];
				}
				
				echo "<h1>Enroll Your Subjects</h1>";
				echo "<hr>";
				echo "<form method='POST' action='Enroll_courses.php'>";
				$temp = array();
				foreach ($data as $type => $courses)
				{
					if($type == 'Theory')
					{
						echo "<h3><mark>Theory</mark></h3>";
						echo "<br>";
						foreach ($courses as $cid => $cname)
						{
							echo "<div class='col-sm-6'>";
							echo "
							  <input class='form-control' name='$cid' type='text' disabled value='$cname'>
							";
							echo "</div><br>";
							array_push($temp, $cid);
						}
					}
					elseif($type == 'Elective-1')
					{
						echo "<h3><mark>Elective-1</mark></h3>";
						echo "<br>";
						echo "<div class='col-sm-6'>";
							echo "<select class='form-control' name='Elective-I'>";
							foreach ($courses as $cid => $cname)
							{
								echo "
									<option>$cid--$cname</option>
								";
							}
							echo "</select><br>";
						echo "</div>";
					}
					elseif($type == 'Elective-2')
					{
						echo "<h3><mark>Elective-2</mark></h3>";
						echo "<br>";
						echo "<div class='col-sm-6'>";
							echo "<select class='form-control' name='Elective-II'>";
							foreach ($courses as $cid => $cname)
							{
								echo "
									<option>$cid--$cname</option>
								";
							}
							echo "</select><br>";
						echo "</div>";
					}
					elseif($type == 'Elective-3')
					{
						echo "<h3><mark>Elective-3</mark></h3>";
						echo "<br>";
						echo "<div class='col-sm-6'>";
							echo "<select class='form-control' name='Elective-III'>";
							foreach ($courses as $cid => $cname)
							{
								echo "
									<option>$cid--$cname</option>
								";
							}
							echo "</select><br>";
						echo "</div>";
					}
					elseif($type == 'Elective-4')
					{
						echo "<h3><mark>Elective-4</mark></h3>";
						echo "<br>";
						echo "<div class='col-sm-6'>";
							echo "<select class='form-control' name='Elective-IV'>";
							foreach ($courses as $cid => $cname)
							{
								echo "
									<option>$cid--$cname</option>
								";
							}
							echo "</select><br>";
						echo "</div>";
					}
					elseif($type == 'Lab')
					{
						echo "<h3><mark>Lab</mark></h3>";
						echo "<br>";
						foreach ($courses as $cid => $cname)
						{
							echo "<div class='col-sm-6'>";
							echo "
							  <input class='form-control' name='lab' type='text' disabled value='$cname'>
							";
							echo "</div><br>";
							array_push($temp, $cid);
						}
					}
				}
				echo "<br>
	                    <center><input type='submit' value='Enroll' class='btn btn-outline-info pl-5 pr-5' name='submit'></center>
	                </form>
	                <br>
	                ";
				$_SESSION['temp'] = $temp;
			}
			else
			{
				echo "
				<div class='alert alert-danger'>
					<strong>Already Enrolled!</strong>
				</div>";
			}
		}
		else
		{
			echo "
				<div class='alert alert-danger'>
					<strong>You Cant Enroll Now</strong>
				</div>";
		}
	}
?>

<?php
	if(isset($_POST["submit"]))
	{
		$sql = "SELECT MAX(id) AS ID FROM timeperiod";
		$retval = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($retval))
		{
			$timeperiod = $row['ID'];
		}
		$theory = $_SESSION['temp'];
		for ($i=0; $i <sizeof($theory) ; $i++)
		{
			$sql = "INSERT INTO student_enroll_courses(RollNumber, YearandSem, CourseID, Timeperiod) VALUES ('$uname', '$yands', '$theory[$i]', '$timeperiod')";
			if (mysqli_query($conn, $sql))
			{
			    echo "
			    	<div class='alert alert-dismissible alert-primary'>
			    		<strong>Courses Enrolled Successfully(You can't revert it back)</strong>
					</div>
				";
			}
			else
			{
			    echo "
			    	<div class='alert alert-dismissible alert-primary'>
			    		<strong>Error Enrolling</strong>
					</div>
				";
			}
		}
		$electives = array();
		if(isset($_POST['Elective-I']))
			array_push($electives, $_POST['Elective-I']);
		else
			array_push($electives, null);
		
		if(isset($_POST['Elective-II']))
			array_push($electives, $_POST['Elective-II']);
		else
			array_push($electives, null);
		
		if(isset($_POST['Elective-III']))
			array_push($electives, $_POST['Elective-III']);
		else
			array_push($electives, null);
		
		if(isset($_POST['Elective-IV']))
			array_push($electives, $_POST['Elective-IV']);
		else
			array_push($electives, null);

		foreach ($electives as $e)
		{
			if(!is_null($e))
			{
				$Cid = explode('--', $e);
				$sql = "INSERT INTO student_enroll_courses(RollNumber, YearandSem, CourseID, Timeperiod) VALUES ('$uname', '$yands', '$Cid[0]', '$timeperiod')";
				if (mysqli_query($conn, $sql))
				{
				    echo "
				    	<div class='alert alert-dismissible alert-primary'>
				    		<strong>$Cid[1] Enrolled Successfully(You can't revert it back)</strong>
						</div>
					";
				}
				else
				{
				    echo "
				    	<div class='alert alert-dismissible alert-primary'>
				    		<strong>Error Enrolling</strong>
						</div>
					";
				}
			}
		}
		echo "
			<script language='javascript'>window.location='Enroll_courses.php';</script>
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