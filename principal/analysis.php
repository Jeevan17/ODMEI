<?php include '../dataConnections.php'; 

	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'other';
	
	include 'header.php';
 	
	$data = array();
	$yands = '2/4 Sem-1';
	$Branch = 'CSE';

	$sql = "SELECT student_marks.CourseID,COUNT(student_marks.CourseID) AS count FROM student_marks WHERE student_marks.YearandSem = '$yands' AND student_marks.CourseID IN (SELECT course_yands.CourseID FROM course_yands WHERE course_yands.Branch = '$Branch') GROUP BY CourseID ORDER BY CourseID";
	$retval = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($retval))
	{
		$data[$row['CourseID']] = $row['count'];
	}
	
	$dataPoints1 = array();
	$dataPoints2 = array();
	foreach ($data as $cid => $count)
	{
		$pass = 0;
		$fail = 0;
	 	$sql="SELECT courses.CourseName,courses.sessional, courses.SEE,student_marks.MidExam1, student_marks.MidExam2, student_marks.External FROM student_marks INNER JOIN courses ON courses.CourseID = student_marks.CourseID WHERE student_marks.CourseID = '$cid' ORDER BY student_marks.CourseID";
		$retval = mysqli_query($conn, $sql);
		$total = 0;
		while($row = mysqli_fetch_array($retval))
		{
			$max = $row['sessional'] + $row['SEE'];
			$cname = $row['CourseName'];
			$total = ($row['MidExam1'] + $row['MidExam2'])/2 + $row['External'];
			if ($total >= ($max * 0.4))
			{
				$pass++;
			}
			else
			{
				$fail++;
			}
		}
		array_push($dataPoints2, array("label"=> "$cname", "y"=> $pass));
		array_push($dataPoints1, array("label"=> "$cname", "y"=> $fail));
	}
 
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Student Marks Analysis"
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Fail",
		indexLabel: "{y}",
		// yValueFormatString: "$#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Pass",
		indexLabel: "{y}",
		// yValueFormatString: "$#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>