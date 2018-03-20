<?php include '../../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}

	if (array_key_exists('bname', $_POST))
	{
		$bname=$_POST["bname"];
		echo "<hr><h3><mark>$bname</mark></h3><br>";
		$sql="SELECT placement_batch.Batch_name, student_attend_placements.CompanyName, COUNT(student_attend_placements.CompanyName) AS Count FROM student_attend_placements 
			INNER JOIN placement_batch ON placement_batch.ID = student_attend_placements.PBatch
			WHERE student_attend_placements.RollNumber IN (SELECT student.RollNumber FROM student WHERE student.BSP IN (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch='$bname'))GROUP BY Batch_name, CompanyName";
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
	}
?>