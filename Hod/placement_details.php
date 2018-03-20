<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['Hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Placement';
	$uname=$_SESSION['Hod'];

	include 'header.php';
	$hod_name = explode('_', $uname);						
?>
<div class="container">
	<div class="row">
		<div class='col-sm-3'>
			<ul class='nav nav-pills flex-column' role='tablist'>
				<li class='nav-item'>
					<a class='nav-link active' data-toggle='pill' href='#placement'>Placement Details</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' data-toggle='pill' href='#company'>Company wise search</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' data-toggle='pill' href='#branch'>Branch wise search</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' data-toggle='pill' href='#year'>Year wise search</a>
				</li>
			</ul>
		</div>
		<div class='col-sm-8'>
			<div class='tab-content'>
				<div id='placement' class='container tab-pane active'>
					<h2>Placement Batch: <mark>2017-2018</mark></h2><br>
					<?php
						$sql="SELECT student_attend_placements.CompanyName, COUNT(student_attend_placements.CompanyName) AS Count FROM student_attend_placements INNER JOIN placement_batch ON placement_batch.ID = student_attend_placements.PBatch WHERE student_attend_placements.RollNumber IN (SELECT student.RollNumber FROM student WHERE student.BSP IN (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch='$hod_name[1]')) AND student_attend_placements.PBatch=(SELECT MAX(placement_batch.ID) FROM placement_batch) GROUP BY Batch_name, CompanyName";
						$retval = mysqli_query($conn, $sql);
						
						$data = array();
						while($row = mysqli_fetch_array($retval))
						{
							$data[$row['CompanyName']][$hod_name[1]] = '-';
						}
						
						$retval = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($retval))
						{
							$data[$row['CompanyName']][$hod_name[1]] = (int)$row['Count'];
						}
						echo "
							<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
								<thead class='thead-dark'>
									<tr>
										<th>Company Name</th>
										<th>$hod_name[1]</th>
									</tr>
								</thead>
								<tbody class='table-secondary'>
						";
						foreach ($data as $companyname => $value)
						{
							echo "
								<tr>
									<td>$companyname</div>
							";
							foreach ($value as $branch => $count)
							{
								echo "
									<td>$count</td>
								";	
							}
							echo "</tr>";
						}
						echo "</tbody>
							</table>
							";
					?>
				</div>
				<div id='company' class='container tab-pane fade'>
					<center>
						<label for='cname'>Enter Company Name</label>
						<input type='text' class='form-control' id='cname' placeholder='eg:- Google' name='company_name' required style=' width: 200px;     display: initial;'>
						<input type='button' name='Search' value='Search' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;' onclick='loadCompany()'>
					</center>
				  	<div id='company_details'>
				  	</div>
				</div>
						
				<div id='branch' class='container tab-pane fade'>
					<?php 
						$sql="SELECT placement_batch.Batch_name, student_attend_placements.CompanyName, COUNT(student_attend_placements.CompanyName) AS Count FROM student_attend_placements INNER JOIN placement_batch ON placement_batch.ID = student_attend_placements.PBatch WHERE student_attend_placements.RollNumber IN (SELECT student.RollNumber FROM student WHERE student.BSP IN (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch='$hod_name[1]'))GROUP BY Batch_name, CompanyName";
						$data = array();
						$retval = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($retval))
						{
							$data[$row['Batch_name']][$row['CompanyName']] = '-';
						}
						//var_dump($data);
						$retval = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($retval))
						{
							$data[$row['Batch_name']][$row['CompanyName']] = $row['Count'];
						}
				
						echo "
								<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
									<thead class='thead-dark'>
										<tr>
											<th>Placement Batch</th>
											";
											foreach ($data as $Pbatch => $value)
											{
												foreach ($value as $Cname => $count)
												{
													echo "<th>$Cname</th>";
												}
											}
										echo "
										</tr>
									</thead>
									<tbody class='table-secondary'>
							";
										foreach ($data as $Pbatch => $value)
										{
											echo "<th class='text-info'>$Pbatch</th>";
											foreach ($value as $Cname => $count)
											{
												echo "<td>$count</th>";
											}
										}
						echo "
									</tbody>
								</table>
							";
					?>
			  	</div>

				<div id='year' class='container tab-pane fade'>
					<center>
						<label for='yname'>Enter Placement Batch</label>
						<input type='text' class='form-control' id='yname' placeholder='eg:- 2017-2018' name='year_name' required style=' width: 200px;     display: initial;'>
						<input type='button' name='Search' value='Search' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;' onclick='loadYear()'>
					</center>
				  	<div id='year_details'>
					</div>
			  	</div>
			</div>
		</div>
	</div>
</div>

</div>
</div>
			
	<script src='placement/placement.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>