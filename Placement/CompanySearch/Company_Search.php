<?php include '../../dataConnections.php'; 

session_start();
if(!isset($_SESSION['Placement'])){
	echo "<script language='javascript'>window.location='../index.php';</script>";
}
if (array_key_exists('cname', $_POST))
{
	$cname=$_POST["cname"];
	echo "<hr><h3><mark>$cname</mark></h3><br>";
	$sql="SELECT placement_batch.Batch_name, bsp_code.Branch ,count(bsp_code.Branch) as Count
		FROM student 
		INNER JOIN student_attend_placements ON student.RollNumber=student_attend_placements.RollNumber 
		INNER JOIN bsp_code ON student.BSP=bsp_code.BSP 
		INNER JOIN placement_batch ON placement_batch.ID = student_attend_placements.PBatch
		where student_attend_placements.Result='Placed' and student_attend_placements.CompanyName='$cname'
		GROUP BY student_attend_placements.CompanyName, bsp_code.Branch
		ORDER BY student_attend_placements.CompanyName";
	$retval = mysqli_query($conn, $sql);
	
	$data = array();
	$brch = array('CSE','IT');
	while($row = mysqli_fetch_array($retval))
	{
		for ($i=0; $i<2 ; $i++)
		{ 
			$data[$row['Batch_name']][$brch[$i]] = '-';
		}
	}
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$data[$row['Batch_name']][$row['Branch']] = (int)$row['Count'];
	}
	echo "
		<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
			<thead class='thead-dark'>
				<tr>
					<th>Placement Batch</th>
					<th>CSE</th>
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