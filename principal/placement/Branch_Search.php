<?php include '../../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}

	if (array_key_exists('bname', $_POST))
	{
		$bname=$_POST["bname"];
		echo "<hr><h3><mark>$bname</mark></h3><br>";
		$sql="SELECT student_attend_placements.CompanyName,count(bsp_code.Branch) as Count
			FROM student 
			INNER JOIN student_attend_placements ON student.RollNumber=student_attend_placements.RollNumber 
			INNER JOIN bsp_code ON student.BSP=bsp_code.BSP 
			where student_attend_placements.Result='Placed' and bsp_code.Branch='$bname'
			GROUP BY student_attend_placements.CompanyName
			ORDER BY student_attend_placements.CompanyName";
		$retval = mysqli_query($conn, $sql);
		
		echo "
				<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
					<thead class='thead-dark'>
						<tr>
							<th>Company Name</th>
							<th>Count</th>
						</tr>
					</thead>
					<tbody class='table-secondary'>
			";
						while($row = mysqli_fetch_array($retval))
						{
							echo "
									<tr>
										<td>{$row['CompanyName']}</td>
										<td>{$row['Count']}</td>
									</tr>
								";
						}
		echo "
					</tbody>
				</table>
			";
	}
?>