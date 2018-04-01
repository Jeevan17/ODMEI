<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['AEC'];
	$data=array();
	if (array_key_exists('rno', $_POST))
	{
		$rno = $_POST['rno'];
		echo "<hr>";
		$sql="SELECT * from mid_marks where mid_marks.RollNumber='$rno' and mid_marks.Timeperiod=(SELECT MAX(id) from Timeperiod)";
		$retval = mysqli_query($conn,$sql);
		$aff_rows = mysqli_affected_rows($conn);
		

		if($aff_rows==0)
		{
			$sql = "SELECT student_enroll_courses.CourseID,courses.CourseName, course_yands.Type FROM student_enroll_courses INNER JOIN courses on student_enroll_courses.CourseID = courses.CourseID INNER JOIN course_yands ON course_yands.CourseID = student_enroll_courses.CourseID where student_enroll_courses.RollNumber='$rno' and student_enroll_courses.YearandSem = (select CurrentYandS from student where student.RollNumber='$rno') ORDER BY Type";
			$retval = mysqli_query($conn, $sql);
			
			if(!$retval)
			{
				echo "
					<div class='alert alert-dismissible alert-danger'>
						<strong>Could not get data</strong>
					</div>
				";
			}

			$affected_rows = mysqli_affected_rows($conn);
			if(mysqli_num_rows($retval) > 0)
			{
				?>
				<h3><mark><?php echo $rno ?></mark></h3><br>
					<form method='POST' action='Mid_marks.php'>
						<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
							<thead>
								<tr>
									<th><h5>Courses</h5></th>
									<th><h5>Mid1 Marks</h5></th>
								</tr>
							</thead>
							<tbody>
								<?php
								while($row = mysqli_fetch_array($retval))
								{ ?>
									<tr>
										<td><?php echo "{$row['CourseID']}"."--"."{$row['CourseName']}" ?></td>
										<td>
											<?php $nm1=$row['CourseID']; 
											echo "<input type='text' class='form-control' name='$nm1' placeholder='$nm1' required>";
											
											array_push($data,"{$row['CourseID']}");
											?>
										</td>
									</tr>
								<?php
								}
							
							// var_dump($data);
							// var_dump($affected_rows);
							if(!isset($_SESSION)) 
							{ 
								session_start(); 
							} 
							$_SESSION['data'] = $data;
							$_SESSION['affected_rows'] = $affected_rows;
							$_SESSION['rollno'] = $rno;
							?>
							</tbody>
						</table><br>
						<input type='submit' value='Submit' name='addMid1' class='btn ml-3 btn-outline-success pl-5 pr-5' style='display: initial;'>
					</form>
					<br>
				<?php
			}
		}
		else
		{
			echo "
				<div class='alert alert-dismissible alert-danger'>
					<strong>Data Already Exists</strong>
				</div>
			";
		}
	}
?>