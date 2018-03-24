<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['student'])){
		echo "<script language='javascript'>window.location='../student_login.php';</script>";
	}
	$currentPage = 'Marks Details';
	$uname=$_SESSION['student'];
	$rno = $_SESSION['rno'];
	if(!isset($_SESSION['rno']))
	{
		echo "<h1>Roll number not found</h1>";
	}

	include 'header.php';
?>
<center>
<table>
	<th>
		<tr>
			<td><input type=button id="141" value="1/4 Sem-1"
				onclick="load42(<?php echo $rno; ?>,<?php echo "141"; ?>)"></td>
			<td><input type=button id="142" value="1/4 Sem-2"
				onclick="load42(<?php echo $rno; ?>,<?php echo "142"; ?>)"></td>
			<td><input type=button id="241" value="2/4 Sem-1"
				onclick="load42(<?php echo $rno; ?>,<?php echo "241"; ?>)"></td>
			<td><input type=button id="242" value="2/4 Sem-2"
				onclick="load42(<?php echo $rno; ?>,<?php echo "242"; ?>)"></td>
			<td><input type=button id="341" value="3/4 Sem-1"
				onclick="load42(<?php echo $rno; ?>,<?php echo "341"; ?>)"></td>
			<td><input type=button id="342" value="3/4 Sem-2"
				onclick="load42(<?php echo $rno; ?>,<?php echo "342"; ?>)"></td>
			<td><input type=button id="441" value="4/4 Sem-1"
				onclick="load42(<?php echo $rno; ?>,<?php echo "441"; ?>)"></td>
			<td><input type=button id="442" value="4/4 Sem-2" 
				onclick="load42(<?php echo $rno; ?>,<?php echo "442"; ?>)">
			</td>
		</tr>
	</th>
</table>
</center>
<div id='show_marks'>
</div>
</div>
</div>
		<script src='marks/marks.js'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>