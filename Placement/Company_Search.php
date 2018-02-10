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
	if (array_key_exists('cname', $_POST))
	{
		$cname=$_POST["cname"];
		echo "<hr><h3><mark>$cname</mark></h3><br>";
		$sql="SELECT student_attend_placements.PBatch, bsp_code.Branch ,count(bsp_code.Branch) as Count
			FROM student 
			INNER JOIN student_attend_placements ON student.RollNumber=student_attend_placements.RollNumber 
			INNER JOIN bsp_code ON student.BSP=bsp_code.BSP 
			where student_attend_placements.Result='Placed' and student_attend_placements.CompanyName='$cname'
			GROUP BY student_attend_placements.CompanyName, bsp_code.Branch
			ORDER BY student_attend_placements.CompanyName";
		$retval = mysqli_query($conn, $sql);
		
		$data = array();
		$brch = array('CSE','ECE','IT');
		while($row = mysqli_fetch_array($retval))
		{
			for ($i=0; $i<3 ; $i++)
			{ 
				$data[$row['PBatch']][$brch[$i]] = '-';
			}
		}
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$data[$row['PBatch']][$row['Branch']] = (int)$row['Count'];
		}
		echo "
			<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
				<thead class='thead-dark'>
					<tr>
						<th>Placement Batch</th>
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
	}
?>