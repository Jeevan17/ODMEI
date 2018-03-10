<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	
	if (array_key_exists('staff', $_POST))
	{
		$staff=$_POST["staff"];
		echo "
			<p> Select Below Fields and press Insert/Update Record</p>
			<div class='row'>
				<div class='col-sm-1 pt-2'>
					Year: 
				</div>
				<div class='col-sm-4'>
					<select class='form-control' id='Year'>
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
						<option selected='selected'>4</option>
					</select>
				</div>
				<div class='col-sm-1'></div>
				<div class='col-sm-1 pt-2'>
					Semester: 
				</div>
				<div class='col-sm-4'>
					<select class='form-control' id='Semester'>
					    <option>1</option>
					    <option selected='selected'>2</option>
					</select>
				</div>
			</div>
			<br>
			<div class='row'>
				<div class='col-sm-1 pt-2'>
					Branch: 
				</div>
				<div class='col-sm-4'>
					<select class='form-control' id='Branch'>
					    <option selected='selected'>CSE</option>
					    <option>ECE</option>
					    <option>IT</option>
					</select>
				</div>
				<div class='col-sm-1'></div>
				<div class='col-sm-1 pt-2'>
					Section: 
				</div>
				<div class='col-sm-4'>
					<select class='form-control' id='Section'>
					    <option>1</option>
					    <option selected='selected'>2</option>
					    <option>3</option>
					</select>
				</div>
			</div>
			<br>
			<div class='row'>
				<div class='col-sm-1 pt-2'>
					Program: 
				</div>
				<div class='col-sm-4'>
					<select class='form-control' id='Program'>
					    <option selected='selected'>BE</option>
					    <option>MBA</option>
					    <option>MCA</option>
					</select>
				</div>
				<div class='col-sm-1'></div>
				<div class='col-sm-1 pt-2'>
					Batch: 
				</div>
				<div class='col-sm-4'>
					<select class='form-control' id='Batch'>
					    <option selected='selected'>All (1, 2 and 3)</option>
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					</select>
				</div>
			</div>
			<br>
			<div class='row'>
				<div class='col-sm-1 pt-2'>
						Select Course:
				</div>
				<div class='col-sm-4'>
					<select class='form-control' id='course'>
					    <option selected='selected'></option>
					    ";
					    $sql = "SELECT CourseID,CourseName FROM courses";
						$retval = mysqli_query($conn, $sql);

						while($row = mysqli_fetch_array($retval))
						{
							echo "<option>".$row['CourseID']."-".$row['CourseName']."</option>";;
						}
					echo "
					</select>
			 	</div>
			</div>
			<br>
			<button type='button' class='btn btn-outline-dark' onclick='loadInsert()'>Insert Data</button>
			";
	}
?>