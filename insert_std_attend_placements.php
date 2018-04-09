<?php include 'dataConnections.php';
	$sql = "SELECT RollNumber FROM student WHERE CurrentYandS='4/4 Sem-1'";
	$retval = mysqli_query($conn, $sql);
	$roll_numbers = array();
	while($row = mysqli_fetch_array($retval))
	{
		array_push($roll_numbers, $row[0]);
	}
	$company_names=array();
	$sql="SELECT CompanyName FROM placement";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		array_push($company_names, $row[0]);
	}
	//(hh,mm,ss,mm,dd,yy)
	$sql="SELECT MAX(ID) FROM placement_batch";
	$retval=mysqli_query($conn, $sql);
	while($row=mysqli_fetch_array($retval))
	{
		$PBatch=$row[0];
	}
	echo $PBatch;
	$result_array = array("Placed","NotPlaced","NotAttempted","NotEligible");
	foreach ($roll_numbers as $rno)
	{
		echo $rno."<br>";
		foreach ($company_names as $cname)
		{
			$result = array_rand($result_array,1);
			$rand_date1= mktime(11,22,33,rand(1,12),rand(1,31),rand(2017,2018)); 
			$date1 = date("Y-m-d",$rand_date1);
			$rand_date2= mktime(11,22,33,rand(1,12),rand(1,31),rand(2017,2018)); 
			$date2 = date("Y-m-d",$rand_date2);
			$sql="INSERT INTO `student_attend_placements`(`RollNumber`, `CompanyName`, `StartDate`, `PBatch`, `EndDate`, `Result`) VALUES ('$rno','$cname','$date1','$PBatch','$date2','$result_array[$result]')";
			if(mysqli_query($conn, $sql))
			{
				echo "$cname"."--------"."$result_array[$result]"."<br>";
			}
			else
			{
				echo "Error";
			}
		}
		echo "-----------------------------------------------<br>";
	}
		
?>