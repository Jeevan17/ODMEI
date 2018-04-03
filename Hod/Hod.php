<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Home';
	$uname=$_SESSION['hod'];

	include 'header.php';
	$hod_name = explode('_', $uname);

	$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$time_slot = array('09:40:00','10:30:00','11:20:00','12:10:00','01:35:00','02:25:00','03:15:00');

	$data = array();
	foreach ($days as $day)
	{
		foreach ($time_slot as $time)
		{
			$data[$day][$time] = '-';
		}
	}
?>
<div>
	<center>
		<form action='Hod.php' method='POST'>
			<label for='rno'>Enter Roll Number</label>
			<input type='text' class='form-control' id='rno' placeholder='eg:- 160114733313' name='rollno' required style=' width: 200px;     display: initial;'>
			<input type='submit' value='Search' name='submit' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;'>
		</form>
	</center>
</div>
			
<!--***********************************************-->
<?php
	if(isset($_POST["submit"]))
	{
		if($_POST['rollno']!=null)
		{
			//session_start();
			if(!isset($_SESSION['hod'])){
				echo "<script language='javascript'>window.location='index.php';</script>";
			}
			$rno = $_POST['rollno'];
			$sql = "SELECT * from student where RollNumber='$rno' AND BSP IN(SELECT bsp_code.BSP from bsp_code WHERE bsp_code.Branch = '$hod_name[1]')";
			$retval = mysqli_query($conn, $sql);
			if(! $retval )
			{
				echo "<script>alert('Entered RollNo does not exist!')</script>";
				die('Could not get data: ' . mysqli_error());
			}							
			if(mysqli_num_rows($retval) > 0)
			{
?>			
	<hr>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<ul class='nav nav-pills flex-column' role='tablist'>
					<li class='nav-item'>
						<a class='nav-link active' data-toggle='pill' href='#admission'>Admission Details</a>
					</li>
					<!-- <li class='nav-item'>
						<a class='nav-link' data-toggle='pill' href='#timetable'>TimeTable</a>
					</li> -->
					<li class='nav-item'>
						<a class='nav-link' data-toggle='pill' href='#Attendance'>Attendance</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' data-toggle='pill' href='#marks'>Marks</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' data-toggle='pill' href='#library'>Library</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' data-toggle='pill' href='#placement'>Placement</a>
					</li>
				</ul>
			</div>
			<div class='col-sm-8'>
				<div class='tab-content'>
					<div id='admission' class='container tab-pane active'>
						<?php
						while($row = mysqli_fetch_array($retval))
						{ 	$batch = $row['CBatch'];
							$yands = $row['CurrentYandS'];
							?>
						
							<h1><mark>Admission Details</mark></h1><br>
							<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
								<tbody class='text-primary'>
									<tr>
										<?php echo"
										<th rowspan='5'><img src='data:image/jpeg;base64,".base64_encode( $row['Photo'] )."' width=150px height=200px /></th>";
										?>
										<td class='text-info'>Name</td>
										<td>
											<?php echo "{$row['FirstName']}"." "."{$row['LastName']}" ?>
										</td>
										
										<tr>
											<td class='text-info'>Roll number</td>
											<td>
												<?php echo "{$row['RollNumber']}";?>
											</td>
										</tr>
										<tr>
											<td class='text-info'>Admission No</td>
											<td>
												<?php echo "{$row['AdmissionNumber']}"; ?>
											</td>
										</tr>
										<tr>
											<td class='text-info'>Phone Number</td>
											<td>
												<?php echo "{$row['phoneNumber']}"; ?>	
											</td>
										</tr>
										<tr>
											<td class='text-info'>Email Id</td>
											<td>
												<?php echo "{$row['Email']}"; ?>
											</td>
										</tr>
									</tr>
								</tbody>
							</table>
				  	<?php 
				  		} 
				  	?>
					</div>
					<!-- <div id='timetable' class='container tab-pane fade'>
					    <?php
							// $sql = "SELECT timetable.Day,timetable.Timeslot,timetable.StaffID,staff.FullName, timetable.CourseID, courses.CourseName FROM timetable INNER JOIN staff ON timetable.StaffID = staff.StaffID INNER JOIN courses ON timetable.CourseID = courses.CourseID WHERE timetable.YearandSem = '$yands' AND timetable.BSP = (SELECT student.BSP FROM student WHERE student.RollNumber = '$rno') AND timetable.CourseID IN (SELECT student_enroll_courses.CourseID FROM student_enroll_courses WHERE student_enroll_courses.RollNumber='$rno') AND (timetable.Batch = '$batch' OR timetable.Batch = '0') ORDER BY Day,Timeslot";
							// $retval = mysqli_query($conn, $sql);
							// while($row = mysqli_fetch_array($retval))
							// {
							// 	$data[$row['Day']][$row['Timeslot']] = array($row['StaffID'],$row['FullName'], $row['CourseID'], $row['CourseName']);
							// }
						?>
						<h2><mark>Time Table</mark></h2>
						<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
							<thead>
								<tr>
									<th></th>
									<th>09:40:00-10:30:00</th>
									<th>10:30:00-11:20:00</th>
									<th>11:20:00-12:10:00</th>
									<th>12:10:00-01:00:00</th>
									<th>01:35:00-02:25:00</th>
									<th>02:25:00-03:15:00</th>
									<th>03:15:00-04:05:00</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									// foreach ($data as $day => $time)
									// {
									// 	if ($day == date("l"))
									// 	{
									// 		echo "
									// 			<tr class='table-info'>
									// 				<th>$day</th>
									// 		";
									// 	}
									// 	else
									// 	{
									// 		echo "
									// 			<tr>
									// 				<th>$day</th>
									// 		";
									// 	}
										
									// 	foreach ($time as $value)
									// 	{
									// 		echo "<td>";
									// 		if ($value != '-')
									// 		{
									// 			echo "<center>$value[3]<br>--------<br>";
									// 			echo "$value[1]</center>";
									// 		}
									// 		else
									// 		{
									// 			echo "<center style='font-size:  20px;'>$value</center>";
									// 		}
									// 		echo "</td>";
									// 	}
									// 	echo "</tr>";
									// }
								?>
							</tbody>
						</table>
					</div> -->
					<div id='Attendance' class='container tab-pane fade'>
					    <h1><mark>Attendance Details</mark></h1><br>
						<?php 
							$sql="SELECT * from attendance where RollNumber='$rno' AND RollNumber IN(SELECT RollNumber from student where student.BSP IN(SELECT bsp_code.BSP from bsp_code WHERE bsp_code.Branch = '$hod_name[1]'))";
							$retval = mysqli_query($conn, $sql);
							echo "
								<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
									<thead>
										<tr>
											<th class='text-info'>Year and Sem</th>
											<th class='text-info'>Attendance</th>
										</tr>
									</thead>
									<tbody class='text-primary'>";
										while($row = mysqli_fetch_array($retval))
										{
											$Attendance=round(($row['TotalAttended']/$row['TotalClassesHeld'])*100);
											echo "
											<tr>
												<td>{$row['YearandSem']}</td>
												<td>$Attendance</td>
											</tr>
											";
										}
								echo"
									</tbody>
								</table>";
							?>
					</div>
					<div id='marks' class='container tab-pane fade'>
						<h1><mark>Semester Marks Details</mark></h1><br>
						
						<?php
							$sql="SELECT * FROM `sgpa` WHERE RollNumber='$rno' ORDER by YearandSem";
							$retval = mysqli_query($conn, $sql);
							echo "
								<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
									<thead>
										<tr>
											<th class='text-info'>Year and Sem</th>
											<th class='text-info'>SGPA</th>
										</tr>
									<tbody class='text-primary'>
										";
										$CGPA =0;
										$count=0;
										while($row = mysqli_fetch_array($retval))
										{
											$CGPA = $row['SGPA'] + $CGPA;
											$count++;
											echo "
											<tr>
												<td>{$row['YearandSem']}</td>
												<td>{$row['SGPA']}</td>
											</tr>
											";
										}
										$CGPA=$CGPA/$count;
								echo"
										<tr>
											<td class='text-info'>CGPA</th>
											<td>$CGPA</td>
										</tr>
									</tbody>
								</table>
							";
						?>
					</div>
					
					<div id='library' class='container tab-pane fade'>
						<h1><mark>Library Details</mark></h1><br>
						<?php
							$sql="SELECT library.Title,CheckedOutDate FROM `student_takes_books`, library where RollNumber='$rno' and library.BookID=student_takes_books.BookID";
							$retval = mysqli_query($conn, $sql);
							echo "
								<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
									<tbody class='text-primary'>
										<tr>
											<th class='text-info'>Books</th>
											<th class='text-info'>Date</th>
										</tr>";
										$count=0;
										while($row = mysqli_fetch_array($retval))
										{
											$count++;
											echo "
											<tr>
												<td>{$row['Title']}</td>
												<td>{$row['CheckedOutDate']}</td>
											</tr>
											";
										}
								echo"
										<tr>
											<td class='text-info'>Total</th>
											<td>$count</td>
										</tr>
									</tbody>
								</table>
							";
						?>
					</div>
					<div id='placement' class='container tab-pane fade'>
						<h1><mark>Placement Details</mark></h1><br>
						<?php
							$sql="SELECT * FROM `student_attend_placements` where RollNumber='$rno' AND RollNumber IN(SELECT RollNumber from student where student.BSP IN(SELECT bsp_code.BSP from bsp_code WHERE bsp_code.Branch = '$hod_name[1]'))";
							$retval = mysqli_query($conn, $sql);
							echo "
								<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
									<tbody class='text-primary'>
										<tr>
											<th class='text-info'>Company Name</th>
											<th class='text-info'>Result</th>
										</tr>";
										while($row = mysqli_fetch_array($retval))
										{
											echo "
											<tr>
												<td>{$row['CompanyName']}</td>
												<td>{$row['Result']}</td>
											</tr>
											";
										}
								echo"
									</tbody>
								</table>
							";
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
			}
			else
			{
				echo "
					<div class='alert alert-danger'>
						<strong>No Data Found</strong>
					</div>
				";
			}
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