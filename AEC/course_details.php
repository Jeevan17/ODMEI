<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'other';

	include 'header.php';										
?>
<div class="container">
	<center>
		<form>
			<label for='rno'>Enter CourseID</label>
			<input type='text' class='form-control' " id='cid' placeholder='eg:- CS471' name='cid' required style=' width: 200px;     display: initial;' onkeyup="loadCourses(this.value)">
			<!-- <input type='text' class='form-control' " id='cid' placeholder='eg:- CS471' name='cid' required style=' width: 200px;     display: initial;'">
			<input type='button' value='Search' " class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;' onclick="loadCourses()"> -->
		</form>
		<br>
		<div id='showDetails'></div>
	</center>
</div>
<?php
if(isset($_POST["submit"]))
{
    $cid = $_SESSION['cid'];
	$yands = $_POST['yands'];
    $ctype = $_POST['Ctype'];
    $branch = $_POST['Branch'];
    $sql = "INSERT INTO `course_yands`(`CourseID`, `Type`, `Branch`, `YearandSem`) VALUES ('$cid', '$ctype', '$branch', '$yands')";
    if(mysqli_query($conn, $sql))
    {
        echo "
            <div class='alert alert-dismissible alert-info'>
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				<strong>Data Inserted</strong>
			</div>
            ";
    }
    else
    {
        echo "
            <div class='alert alert-danger'>
                <strong>Error Inserting Data</strong>
            </div>";
    }
}
?>
</div>
</div>
	<script src='Course/course.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>