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
											GROUP BY student_attend_placements.CompanyName, bsp_code.Branch
											ORDER BY student_attend_placements.CompanyName";
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
									<div>
										<center>
											<label for='cname'>Enter Company Name</label>
											<input type='text' class='form-control' id='cname' placeholder='eg:- Google' name='company_name' required style=' width: 200px;     display: initial;'>
											<input type='button' name='Search' value='Search' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;' onclick='loadDoc(company)'>
											</form>
										</center>
								  	</div>
								  	<div id='company_details'>
								  	</div>
								</div>
	    					</div>
	    				</div>
					</div>
				</div>
			</div>
			
			<script>
				function loadDoc(cFunction)
				{
					var xhttp;
					xhttp=new XMLHttpRequest();
				  	xhttp.onreadystatechange = function() 
				  	{    
				  		if (this.readyState == 4 && this.status == 200) 
					    {
					    	cFunction(this);
					    }
				  	};
				  	var x = document.getElementById("cname").value; 
					xhttp.open("POST", "Company_Search.php", true);
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send("cname="+x);
					xhttp.send();
				}
				function company(xhttp)
				{
					document.getElementById("company_details").innerHTML = xhttp.responseText;
				}
			</script>

			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
			<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
		</body>
	</html>
