<?php include 'dataConnections.php';
	$company_data = array("Oracle"=>"oracle pvt ltd", "Google"=>"google pvt ltd", "Microsoft"=>"Microsoft private","Accolite"=>"Accolite tech","Accenture"=>"Accenture technologies","Bank of America"=>"BOA Tech","Infosys"=>"Infosys pvt ltd","Wipro"=>"Wipro tech","Franklin Templeton"=>"FT Investments","JP Morgan"=>"JPMC tech","TCS"=>"TCS tech","Delloite"=>"Delloite private","Cognizant"=>"Cognizant tech","Tech Mahindra"=>"TM pvt","Apple"=>"Apple Technologies","CA"=>"CA Technologies","Capgemini"=>"Capgemini infotech","Ivy"=>"Ivy Comptech");
	foreach($company_data as $c_name => $c_desc)
	{
		$cutoff = round(rand(60,85)/10,1);
		$c_type = array("Internship", "FullTime");
		$type = array_rand($c_type,1);
		$sql = "INSERT INTO `placement`(`CompanyName`, `Description`, `CutOff`, `Type`) VALUES ('$c_name','$c_desc','$cutoff','$c_type[$type]')";
		if(mysqli_query($conn, $sql))
		{
			echo "$c_name<br>$c_desc<br>$cutoff<br>$type<br>----------------------<br>";
		}
		else
		{
			echo "Error";
		}
	}
?>