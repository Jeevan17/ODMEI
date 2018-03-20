<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Placement';
	
	include 'header.php';							
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
						$sql="SELECT student_attend_placements.CompanyName, bsp_code.Branch ,count(bsp_code.Branch) as Count FROM student INNER JOIN student_attend_placements ON student.RollNumber=student_attend_placements.RollNumber INNER JOIN bsp_code ON student.BSP=bsp_code.BSP where student_attend_placements.Result='Placed' and PBatch= (select id from placement_batch order by id desc) GROUP BY student_attend_placements.CompanyName, bsp_code.Branch ORDER BY student_attend_placements.CompanyName";
						$retval = mysqli_query($conn, $sql);
						
						$data = array();
						$brch = array('CSE','ECE','IT');
						while($row = mysqli_fetch_array($retval))
						{
							for ($i=0; $i<3 ; $i++)
							{ 
								$data[$row['CompanyName']][$brch[$i]] = '-';
							}
							//$data[$row['CompanyName']][$row['Branch']] = (int)$row['Count'];
						}
						//var_dump($data);
						$retval = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($retval))
						{
							$data[$row['CompanyName']][$row['Branch']] = (int)$row['Count'];
						}
						echo "
							<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
								<thead class='thead-dark'>
									<tr>
										<th>Company Name</th>
										<th>CSE</th>
										<th>ECE</th>
										<th>IT</th>
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
					<center>
						<label for='bname'>Enter Branch Name</label>
						<input type='text' class='form-control' id='bname' placeholder='eg:- CSE' name='branch_name' required style=' width: 200px;     display: initial;'>
						<input type='button' name='Search' value='Search' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;' onclick='loadBranch()'>
					</center>
				  	<div id='branch_details'>
				  	</div>
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