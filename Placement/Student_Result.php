<?php include '../dataConnections.php'; 

  session_start();
  if(!isset($_SESSION['Placement'])){
    echo "<script language='javascript'>window.location='../index.php';</script>";
  }
  $currentPage = 'other';
  include 'header.php';
?>

<center>
	<label for='cname'>Enter Company Name: </label>
	<input type='text' class='form-control' id='cname' placeholder='eg:- Google' name='company_name' required style=' width: 200px; display: initial;'>
	<input type='submit' name='Search' value='Search' class='btn ml-3 pl-5 pr-5 btn-outline-primary' onclick='loadCompany()'>
</center>
<div id='company_details'>
</div>
<br>

<?php
	$output = ''; 
	if(isset($_POST["Upload"]) and isset($_POST['Sdate']) and isset($_POST['Edate']))
	{
		$cname = $_SESSION['CompanyName'];
		$Sdate = $_POST['Sdate'];
		$Edate = $_POST['Edate'];
		$pos = 0;
		$neg = 0; 
		$sql = "SELECT max(ID) as ID from placement_batch";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$Pbatch = $row['ID'];
		}
		
		$connection = mysqli_connect('localhost', 'admin', 'cbit','project');
		$extension = explode(".", $_FILES["excel"]["name"]);
		$allowed_extension = array("xls", "xlsx", "csv"); 
		if(in_array($extension[1], $allowed_extension)) 
		{
			$file = $_FILES["excel"]["tmp_name"];
			include("../PHPExcel/IOFactory.php"); 

			$objPHPExcel = PHPExcel_IOFactory::load($file); 
			$output .= "<center><label class='text-success'><h3>Data Inserted</h3></label></center>";
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				for($row=2; $row<=$highestRow; $row++)
				{
					$data = array();
					for ($i=0; $i <2 ; $i++)
					{ 
						array_push($data, mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow($i,$row)->getValue()));
					}
					
					$query = "INSERT INTO student_attend_placements(RollNumber, CompanyName, StartDate, PBatch, EndDate, Result) VALUES ('$data[0]', '$cname', '$Sdate', '$Pbatch', '$Edate', '$data[1]')";
					if(mysqli_query($conn, $query))
					{
						$pos++;
					}
					else
					{
						$neg++;
					}
					//var_dump($data);
				}
			}
		}
		echo "$output $pos $neg";
	}
?>
</div>
</div> 
	<script src="StudentResult/studentResult.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>