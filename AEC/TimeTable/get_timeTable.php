<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	
	if (array_key_exists('year', $_POST) and array_key_exists('semester', $_POST) and array_key_exists('program', $_POST)  and array_key_exists('branch', $_POST) and array_key_exists('section', $_POST) and array_key_exists('batch', $_POST))
	{
		$year=$_POST["year"];
		$branch=$_POST["branch"];
		$section=$_POST["section"];
		$semester=$_POST["semester"];
		$program = $_POST['program'];
		$batch = $_POST['batch'];
		echo "<h3>Time Table for<mark>$program $year/4 Sem-$semester $branch-$section</mark></h3>
			<hr>
			<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
				<thead>
					<tr>
						<th></th>
						<th>09:40-10:30</th>
						<th>10:30-11:20</th>
						<th>11:20-12:10</th>
						<th>12:10-01:00</th>
						<th>01:35-02:25</th>
						<th>02:25-03:15</th>
						<th>03:15-04:05</th>
					</tr>
				</thead>
				<tbody>
				";
				$days = array('Monday','Tuesday','Wednesday','Thrusday','Friday','Saturday');
				foreach ($days as $day)
				{
					echo "
						<tr>
							<th>$day</th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					";
				}
				echo "
				</tbody>
			</table>
				";
	}		
?>