<?php include '../../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['hod'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['hod'];
	$hod_name = explode('_', $uname);
	$enroll = $hod_name[1].'_Enroll';
	if (array_key_exists('enroll', $_POST))
	{
		$flag = $_POST['enroll'];
		if ($flag == '1' || $flag == '0')
		{	
			$sql = "UPDATE notification SET RollNumber='$flag' WHERE Type = '$enroll'";
			if (mysqli_query($conn, $sql))
			{
			    if($flag == '1')
			    {
				    $sql = "SELECT RollNumber FROM student WHERE student.BSP IN (SELECT bsp_code.BSP FROM bsp_code WHERE bsp_code.Branch = '$hod_name[1]')";
				    $retval = mysqli_query($conn, $sql);
					$temp = 'Enroll';
					while($row = mysqli_fetch_array($retval))
					{
						$rno = $row['RollNumber'];
						try
						{
							$dbh = new PDO("mysql:host=localhost;dbname=project", "admin", "cbit");
							$stmt = $dbh->prepare("INSERT INTO notification(Rollnumber, Type) VALUES (?,?)");
							$stmt->bindParam(1, $rno);
							$stmt->bindParam(2, $temp);
							$stmt->execute();
						}
						catch(PDOException $e)
					    {
					    echo "Inner Error: " . $e->getMessage();
					    }
					    $dbh = null;		
					}
				}

			    echo "<script language='javascript'>window.location='../enroll_courses.php';</script>";
			}
			else
			{
			    echo "
			    	<div class='alert alert-dismissible alert-primary'>
			    		<strong>Error Toggling</strong>
					</div>
				";
			}
		}
		else
		{
			echo "
		    	<div class='alert alert-dismissible alert-primary'>
		    		<strong>Error Toggling</strong>
				</div>
			";
		}
	}
?>