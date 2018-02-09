<?php
	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');
	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
   
	if(! $conn )
	{
		echo "
			<div class='alert alert-danger'>
				<strong>Not connected to database." . mysqli_error();"</strong>
			</div>";
	}
?>
<!DOCTYPE html>
	<html lang='en'>
		<head>
		  <title>Principal</title>
		  <meta charset='utf-8'>
		  <meta name='viewport' content='width=device-width, initial-scale=1'>
		  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
		</head>
		<body>
			<div class='container pt-2'>
			  	<div class='row'>
			  		<div class='col-sm-2'>
			  		</div>
			  		<div class='col-sm-8'>
			  			<center>
				  			<!--h5 class='text-primary'> Chaitanya Bharathi Institute of Technology(Autonomous)<br>
				  			<small class='text-info'>Accredited by NBA & NAAC, Approved by A.I.C.T.E., New Delhi, Affliated to Osmania University<br> Chaityana Bharathi(PO),Kokapeta(village), Gandipet, Hyderabad -500075, Telangana, India</small></h5-->
				  			<img class='img-fluid' src='../images/header.jpg'>
			  			</center>
			  		</div>
			  		<div class='col-sm-2 pl-5'>
			  			<a href='../index.php' class='btn btn-danger btn-sm'>Logout</a>
			  		</div>
			  	</div>
			</div>
			<br>
			<div class='container pt-3'>
				<div class='row'>
			  		<div class='col-sm-12'>
			  			<ul class='nav nav-tabs nav-justified'>
					    	<li class='nav-item'>
								<a class='nav-link  ' href='principal.php'>Student Details</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link active' href='placement_details.php'>Placement Details</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link ' href='staff_details.php'>Staff Details</a>
							</li>
						</ul>
						<div class='tab-content'>
							<div class='container tab-pane active'><br>
								<div>
								</div>
		    				</div>
		    			</div>
					</div>
				</div>
				<div class='container'>
					<div class='row'>
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
									<?php
										$sql="SELECT student_attend_placements.CompanyName, bsp_code.Branch ,count(bsp_code.Branch) as Count
											FROM student 
											INNER JOIN student_attend_placements ON student.RollNumber=student_attend_placements.RollNumber 
											INNER JOIN bsp_code ON student.BSP=bsp_code.BSP 
											where student_attend_placements.Result='Placed'
											GROUP BY student_attend_placements.CompanyName, bsp_code.Branch";
										$retval = mysqli_query($conn, $sql);
										echo "
											<table class='table table-bordered table-hover'>
												<tbody>
													<tr>
														<th style='padding: 5px;font-size: 20px;'>Company Name</th>
														<th style='padding: 5px;font-size: 20px;'>CSE</th>
														<th style='padding: 5px;font-size: 20px;'>ECE</th>
														<th style='padding: 5px;font-size: 20px;'>IT</th>
													</tr>";
													while($row = mysqli_fetch_array($retval))
													{
														echo "<tr>";
														switch ($row['Branch']) 
														{
															case 'CSE':
																echo "
																<td style='padding: 10px;font-size: 20px;'>{$row['CompanyName']}</td>
																<td style='padding: 10px;font-size: 20px;'>{$row['Count']}</td>
																<td style='padding: 10px;font-size: 20px;'>-</td>
																<td style='padding: 10px;font-size: 20px;'>-</td>
																";
																break;
															case 'ECE':
																echo "
																<td style='padding: 10px;font-size: 20px;'>{$row['CompanyName']}</td>
																<td style='padding: 10px;font-size: 20px;'>-</td>
																<td style='padding: 10px;font-size: 20px;'>{$row['Count']}</td>
																<td style='padding: 10px;font-size: 20px;'>-</td>
																";
																break;
															case 'IT':
																echo "
																<td style='padding: 10px;font-size: 20px;'>{$row['CompanyName']}</td>
																<td style='padding: 10px;font-size: 20px;'>-</td>
																<td style='padding: 10px;font-size: 20px;'>-</td>
																<td style='padding: 10px;font-size: 20px;'>{$row['Count']}</td>
																";
																break;
														}
														echo "</tr>";
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
			</div>
<?php
echo "
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
			<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
		</body>
	</html>
	";
?>