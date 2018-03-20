<?php include '../../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['Hod'];

	$hod_name = explode('_', $uname);
	if (array_key_exists('yname', $_POST))
	{
		$yname=$_POST["yname"];
		echo "<hr><h3><mark>$yname</mark></h3><br>";
		$sql="SELECT student_attend_placements.CompanyName, count(bsp_code.Branch) as Count FROM student INNER JOIN student_attend_placements ON student.RollNumber=student_attend_placements.RollNumber INNER JOIN bsp_code ON student.BSP=bsp_code.BSP where student_attend_placements.Result='Placed' and PBatch = (SELECT placement_batch.ID FROM placement_batch WHERE placement_batch.Batch_name='$yname') AND bsp_code.BSP IN (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch ='$hod_name[1]') GROUP BY student_attend_placements.CompanyName, bsp_code.Branch ORDER BY student_attend_placements.CompanyName";
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
	}
?>