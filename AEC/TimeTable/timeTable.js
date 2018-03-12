function loadTable()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("timetable").innerHTML = xhttp.responseText;
  		}
	};
	var program = document.getElementById("Program").value;
	var year = document.getElementById("Year").value;
	var semester = document.getElementById("Semester").value;
	var branch = document.getElementById("Branch").value;
	var section = document.getElementById("Section").value;
	//var batch = document.getElementById('Batch').value; 
	xhttp.open("POST", "TimeTable/get_timeTable.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("year="+year+"&program="+program+"&branch="+branch+"&section="+section+"&semester="+semester);
}