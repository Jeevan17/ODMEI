<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['AEC'];
	$data=array();
	if (array_key_exists('rno', $_POST))
	{
		echo "<hr>";
		$rno = $_POST['rno'];
		$sql = "SELECT student_enroll_courses.CourseID,courses.CourseName from student_enroll_courses join courses on student_enroll_courses.CourseID=courses.CourseID where student_enroll_courses.RollNumber='$rno' and student_enroll_courses.YearandSem = (select CurrentYandS from student where student.RollNumber='$rno')";
		$retval = mysqli_query($conn, $sql);
		//var_dump($retval);
		if(!retval)
		{
			//var_dump($data);
			// echo "<script>alert('Entered RollNo does not exist!')</script>";
			echo "<script type='text/javascript'>alert(\"testing\");</script>";
			$message="test";
			echo "<script type='text/javascript'>alert('$message');</script>";
			die('Could not get data: ' . mysqli_error());
		}	
		$affected_rows = mysqli_affected_rows($conn);
		if(mysqli_num_rows($retval) > 0)
		 {

		?>
		<h3><mark><?php echo $rno ?></mark></h3><br>
			<form method='POST' action='Mid_marks.php'>
				<table>
					<th>
						<tr><td><h5>Courses</h5></td> <td><h5>Mid 1</h5></td><td><h5>Mid 2</h5></td></tr>
					</th>
					<?php
					while($row = mysqli_fetch_array($retval))
					{ ?>
						<tr>
							<td><?php echo "{$row['CourseID']}"."--"."{$row['CourseName']}" ?></td>
							<td>
								<?php $nm1=$row['CourseID']; 
								echo "<input type='text' name='$nm1' placeholder='$nm1'>";
								
								array_push($data,"{$row['CourseID']}");
								// var_dump($data);		
								?>
							</td>
							<td>
								<?php $nm2=$row['CourseID']; $nm2.="2";
								echo "<input type='text' name='$nm2' placeholder='$nm1'>";
								
								// array_push($data,"{$row['CourseID']}");
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
				</table><br>
				<input type='submit' value='Submit' name='submit' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;'>
			</form>
		<?php
		}
	}
?>