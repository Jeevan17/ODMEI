<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['COE'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Publish Results';

	include 'header.php';
	$sql="SELECT * FROM `timeperiod` order by id DESC limit 1";
	$retval = mysqli_query($conn, $sql);
	if(!$retval)
	{
		die('Could not get data: ' . mysqli_error());
	}
	while($row = mysqli_fetch_array($retval))
	{
		$id=$row[0];
		$timeperiod=$row[1];
	}
?>
<?php $results="Release".$timeperiod."results";?>
<center>
<h2><input type=button onclick="loadResults(<?php echo $id; ?>)" value=<?php echo $results;?>></h2>
</center>
<div id="show_results">
</div>
</div>
</div>
	<script src='Results/results.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>