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
			echo "
				<div class='alert alert-dismissible alert-danger'>
					<strong>Please Insert data before Updating</strong>
				</div>
			";
		}
		else
		{
			$sql = "SELECT mid_marks.CourseID,courses.CourseName,mid_marks.Mid1 FROM mid_marks INNER JOIN courses ON mid_marks.CourseID = courses.CourseID INNER JOIN course_yands ON course_yands.CourseID = mid_marks.CourseID WHERE mid_marks.RollNumber='$rno' AND mid_marks.Timeperiod =(SELECT MAX(id) from Timeperiod) ORDER BY Type";
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
											echo "<input type='text' class='form-control' name='$nm1' value='{$row['Mid1']}' >";
											
											array_push($data,"{$row['CourseID']}");
											?>
										</td>
									</tr>
								<?php
								}
							
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
						<input type='submit' value='Submit' name='updateMid1' class='btn ml-3 btn-outline-success pl-5 pr-5' style='display: initial;'>
					</form>
					<br>
				<?php
			}
		}
	}
?>