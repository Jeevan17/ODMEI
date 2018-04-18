<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'other';
	$uname=$_SESSION['student'];

	include 'header.php';

	$sql="SELECT * from student NATURAL join student_details where RollNumber='$uname'";
	$retval=mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$rno = $row['RollNumber'];
		$admn_no = $row['AdmissionNumber'];
		$fname = $row['FirstName'];
		$lname = $row['LastName'];
		$bsp = $row['BSP'];
		$cbatch = $row['CBatch'];
		$phno = $row['phoneNumber'];
		$email = $row['Email'];
		$photo = $row['Photo'];
		$c_yands = $row['CurrentYandS'];
		$admn_date = $row['AdmissionDate'];
		$admn_type = $row['AdmissionType'];
		$caste = $row['Caste'];
		$fee_r = $row['FeeReimbursement'];
		$scholarship = $row['Scholarship'];
		$dob = $row['DateOfBirth'];
		$gender = $row['Gender'];
		$nat = $row['Nationality'];
		$father_name = $row['FatherName'];
		$test = $row['Test'];
		$address = $row['Address'];
		$district = $row['District'];
		$state = $row['State'];
		$pincode = $row['Pincode'];
		$s_alt_email = $row['StudentAltEmail'];
		$parent_phno = $row['ParentMobileNo'];
		$parent_email = $row['ParentEmail'];
	}
	$sql = "SELECT `Branch`, `Section`, `Program` FROM `bsp_code` WHERE BSP='$bsp'";
	$retval = mysqli_query($conn ,$sql);
	$row=mysqli_fetch_array($retval);
	$branch=$row[0];
	$section=$row[1];
	$program=$row[2];

?>
<!-- class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl" -->
<h3><mark>Admission Details: </mark></h3><hr>
<h4><?php echo $fname." "; echo $lname ?></h4><hr>
<div class="row">
	<div class="col-sm-15">
		<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<tr>
				<th rowspan="13">
					<?php 
						echo "
				        	<img src='data:image/jpeg;base64,".base64_encode( $photo )."' alt='photo' height='150' width='120'/> 
				        ";
					?>
				</th>	
				<th colspan="2"><h5><center>Admission Details</center></h5></th>
				<th colspan="2"><h5><center>Personal Details</center></h5></th>
				<th colspan="2"><h5><center>Communication Details</center></h5></th>
			<tr>
				<td><span style="color:blue;font-weight:bold">Roll Number</span></td>
				<td><span style="color:blue;font-weight:bold"><?php echo $rno ?></span></td>
				<td>Date of Birth</td><td><?php echo $dob ?></td>
				<td>Father Name</td><td><?php echo $father_name ?></td>
			</tr>
			<tr>
				<td>Admission Number</td><td><?php echo $admn_no ?></td>
				<td>Gender</td><td><?php echo $gender ?></td>
				<td>Parent Phone Number</td><td><?php echo $parent_phno ?></td>
			</tr>
			<tr>
				<td>Program</td><td><?php echo $program ?></td>
				<td>Phone Number</td><td><?php echo $phno ?></td>
				<td>Parent Email</td><td><?php echo $parent_email ?></td>
			</tr>
			<tr>
				<td>Branch</td><td><?php echo $branch ?></td>
				<td>Email</td><td><?php echo $email ?></td>
				<td>Address</td><td><?php echo $address ?></td>
			</tr>
			<tr>
				<td>Section</td><td><?php echo $section ?></td>
				<td>Alternative Email</td><td><?php echo $s_alt_email ?></td>
				<td>District</td><td><?php echo $district ?></td>
			</tr>
			<tr>
				<td>Batch</td><td><?php echo $cbatch ?></td>
				<td>Caste</td><td><?php echo $caste ?></td>
				<td>State</td><td><?php echo $state ?></td>
			</tr>
			<tr>
				<td>Current Year and Semester</td><td><?php echo $c_yands ?></td>
				<td>Nationality</td><td><?php echo $nat ?></td>
				<td>Pincode</td><td><?php echo $pincode ?></td>
			</tr>
			<tr>
				<td>Admission Date</td><td><?php echo $admn_date ?></td>
			</tr>
			<tr>
				<td>Admission Type</td><td><?php echo $admn_type ?></td>
			</tr>
			<tr>
				<td>Fee Reimbursement</td><td><?php echo $fee_r ?></td>
			</tr>
			<tr>
				<td>Scholarship</td><td><?php echo $scholarship ?></td>
			</tr>
			<tr>
				<td>Test</td><td><?php echo $test ?></td>
			</tr>
		</tr>
		</table>
	</div>
</div>

</div>
</div>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>