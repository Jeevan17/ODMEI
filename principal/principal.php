<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Home';
	
	include 'header.php';							
?>
<div>
	<center>
		<form action='principal.php' method='POST'>
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
			if(!isset($_SESSION['principal'])){
				echo "<script language='javascript'>window.location='index.php';</script>";
			}
			$rno = $_POST['rollno'];
			$sql = "select * from student where RollNumber='$rno'";
			$retval = mysqli_query($conn, $sql);
			if(! $retval )
			{
				echo "<script>alert('Entered RollNo does not exist!')</script>";
				die('Could not get data: ' . mysqli_error());
			}							
?>			
	<hr>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<ul class='nav nav-pills flex-column' role='tablist'>
					<li class='nav-item'>
						<a class='nav-link active' data-toggle='pill' href='#admission'>Admission Details</a>
					</li>
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
						{ ?>
						
							<h1><mark>Admission Details</mark></h1><br>
							<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
								<tbody class='text-primary'>
									<tr>
										<?php echo"
										<th rowspan='5'><img src='data:image/jpeg;base64,".base64_encode( $row['Photo'] )."' width=150px height=200px /></th>";
										?>
										<td class='text-info'>Name</th>
										<td>
											<?php echo "{$row['FirstName']}"." "."{$row['LastName']}" ?>
										</td>
										
										<tr>
											<td class='text-info'>Roll number</th>
											<td>
												<?php echo "{$row['RollNumber']}";?>
											</td>
										</tr>
										<tr>
											<td class='text-info'>Admission No</th>
											<td>
												<?php echo "{$row['AdmissionNumber']}"; ?>
											</td>
										</tr>
										<tr>
											<td class='text-info'>Phone Number</th>
											<td>
												<?php echo "{$row['phoneNumber']}"; ?>	
											</td>
										</tr>
										<tr>
											<td class='text-info'>Email Id</th>
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
					<div id='Attendance' class='container tab-pane fade'>
					    <h1><mark>Attendance Details</mark></h1><br>
						<?php 
							$sql="SELECT * from attendance where RollNumber='$rno'";
							$retval = mysqli_query($conn, $sql);
							echo "
								<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
									<thead>
										<tr>
											<th class='text-info'>Year and Sem</th>
											<th class='text-info'>Attendance(%)</th>
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
								</table><br><br><br>
					</div>";
					?>
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
										if($count!=0)
											$CGPA=$CGPA/$count;
										$CGPA=round($CGPA,2);
								echo"
									</tbody>
								</table>
							";
							echo "<h3>CGPA: $CGPA</h3><br><br><br>";
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
							$sql="SELECT * FROM `student_attend_placements` where RollNumber='$rno'";
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
											if($row['Result']=='Placed')
											{
												echo "
											<tr>
												<td><h5><font color='green'>{$row['CompanyName']}</font></h5></td>
												<td><h4><font color='green'>{$row['Result']}</font></h4></td>
											</tr>
											";
											}
											else
											{
												echo "
											<tr>
												<td>{$row['CompanyName']}</td>
												<td>{$row['Result']}</td>
											</tr>
											";
											}
											
										}
								echo"
									</tbody>
								</table><br><br><br>
							";
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
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