 <?php
    include '../../dataConnections.php';
    if (isset($_GET['id'])) 
   {
		$id = $_GET['id'];
		$sql = "SELECT * FROM news WHERE ID = '$id'";
		$retval = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($retval))
		{
			$id = $row['ID'];
			$DocumentName = $row['DocumentName'];
			$Description = $row['Description'];
			$File = $row['File'];
		}
		// $temp = 'media/'.$File;

		// if(file_exists($temp))
		// {
			header('Content-Type:'.$Description);
			header("Content-Disposition: attachment; filename='$DocumentName'");
			header('Cotent-Length:'.filesize($File));
			//readfile($temp);
			ob_clean();
			flush();
			echo $File;
			exit;
		//}
   }
?>