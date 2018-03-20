<?php include '../dataConnections.php';
	session_start();
	if(!isset($_SESSION['AEC'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = '';

	include 'header.php';										
?>
<div class="container">
	<center>
		<form>
			<input type="text" id="course_search" class='form-control' placeholder="Enter Subject Name" onkeyup="loadSearch(this.value)">
			<div id="search_results">
			</div>
		</form>
	</center>
	<div id="search-layer"></div>
</div>
</div>
</div>
	<script src='Course/course.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
</body>
</html>