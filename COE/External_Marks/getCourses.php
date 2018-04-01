<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['COE'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['COE'];
	$data=array();
	if (array_key_exists('rno', $_POST))
	{
		echo "<hr>";
		$rno = $_POST['rno'];
		$sql="SELECT * from sem_marks where sem_marks.RollNumber='$rno' and sem_marks.Timeperiod=(SELECT MAX(id) from Timeperiod)";
		$retval = mysqli_query($conn,$sql);
		$aff_rows = mysqli_affected_rows($conn);
		if($aff_rows==0)
		{
			$sql="SELECT * from student_marks where student_marks.RollNumber='$rno' and student_marks.Timeperiod=(SELECT MAX(id) from Timeperiod)";
			$retval = mysqli_query($conn,$sql);
			$aff_rows = mysqli_affected_rows($conn);
			if($aff_rows==0)
			{
				$sql = "SELECT student_enroll_courses.CourseID,courses.CourseName, course_yands.Type FROM student_enroll_courses INNER JOIN courses on student_enroll_courses.CourseID = courses.CourseID INNER JOIN course_yands ON course_yands.CourseID = student_enroll_courses.CourseID where student_enroll_courses.RollNumber='$rno' and student_enroll_courses.YearandSem = (select CurrentYandS from student where student.RollNumber='$rno') ORDER BY Type";
				$retval = mysqli_query($conn, $sql);
				$aff_rows = mysqli_affected_rows($conn);
				//var_dump($rno);
				if($aff_rows==0)
				{
					die('RollNumber does not Enrolled Courses / Exists ! ');
				}	
				$affected_rows = mysqli_affected_rows($conn);
				if(mysqli_num_rows($retval) > 0)
				{

				?>
				<div class="container">
					<h3><mark><?php echo $rno ?></mark></h3><br>
					<form method='POST' action='COE.php'>
						<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
							<thead>	
								<tr>
									<td>
										<h5>Courses</h5>
									</td>
									<td>
										<h5>External Marks</h5>
									</td>
								</tr>
							</thead>
							<tbody>
								<?php
								while($row = mysqli_fetch_array($retval))
								{ ?>
									<tr>
										<td><?php echo "{$row['CourseID']}"."--"."{$row['CourseName']}" ?></td>
										<td>
											<?php $nm=$row['CourseID']; 
											echo "<input type='text' class='form-control' name='$nm' placeholder='$nm'>";
											
											array_push($data,"{$row['CourseID']}");
											// var_dump($data);		
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
						</table><hr>
						<input type='submit' value='Submit' name='submit' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;'>
					</form>
					<br>
				</div>
				<?php
				}
			}
			else
			{
				die("<div class='alert alert-danger'>
					<strong>Data already exists !!</strong>
				</div>");
			}
		}
		else
		{
			die("<div class='alert alert-danger'>
					<strong>Data already exists !!</strong>
				</div>");
		}
	}
?>