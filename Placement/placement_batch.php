<?php include '../dataConnections.php'; 

  session_start();
  if(!isset($_SESSION['Placement'])){
    echo "<script language='javascript'>window.location='../index.php';</script>";
  }
  $currentPage = 'Placement Batch';
  include 'header.php';
?>
<form name="nb" action="placement_batch.php" method="post">
	<div class="row">
		<div class="col-sm-5 pt-2">
			<h3>New Placement Batch:</h3>
		</div>
		<div class="col-sm-4">
			<input type=textbox name="new_batch" class="form-control" placeholder="Eg:- 2017-2018" onblur="validateformat(this.value)">
		</div>
	</div>
	<hr>
	<center>
		<input type="submit" name="submit" class='btn btn-outline-info pl-5 pr-5'>
	</center>
</form>
<?php
	if(isset($_POST["submit"]))
	{
		if($_POST['new_batch']!=null)
		{
			$p_batch = $_POST['new_batch'];
			$check = "SELECT Batch_name from placement_batch where Batch_name='$p_batch'";
			$retval = mysqli_query($conn, $check);
			if(mysqli_affected_rows($conn)!=0)
			{
				echo "
					<div class='alert alert-danger'>
							<strong>Placement Batch already exists!</strong>
						</div>
						";
			}
			else
			{
				$sql = "INSERT INTO placement_batch (Batch_name) VALUES ('$p_batch')";
				//$retval = mysqli_query($conn,$sql);
				if (mysqli_query($conn, $sql)) 	
				{
				    echo "
					<div class='alert alert-danger'>
							<strong>New Placement Batch added successfully!</strong>
						</div>
						";
				} 
				else 
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
		}
	}
?>
</div>
</div>
	<script>
		function validateformat(nbatch)
		{
			//var nbatch = document.forms["nb"]["new_batch"].value;
			var regex = /[2-9][0-9]{3}\-[2-9][0-9]{3}$/;
			if(regex.test(nbatch.value) == false)
			{
				alert('Invalid format !!');
				return false;
			}
			return true;
		}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>