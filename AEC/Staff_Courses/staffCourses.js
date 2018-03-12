function loadCourses()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("courses").innerHTML = xhttp.responseText;
  		}
	};
	var staff = document.getElementById('staff').value; 
	xhttp.open("POST", "Staff_Courses/get_Courses.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("staff="+staff);
}
function loadInsert()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("courses2").innerHTML = xhttp.responseText;
  		}
	};
	var staff = document.getElementById('staff').value;
	var program = document.getElementById("Program").value;
	var year = document.getElementById("Year").value;
	var semester = document.getElementById("Semester").value;
	var branch = document.getElementById("Branch").value;
	var section = document.getElementById("Section").value;
	var batch = document.getElementById('Batch').value;
	var course = document.getElementById('course').value;
	xhttp.open("POST", "Staff_Courses/Insert.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("course="+course+"&staff="+staff+"&batch="+batch+"&year="+year+"&program="+program+"&branch="+branch+"&section="+section+"&semester="+semester);
	alert('Record Inserted Successfully');
}
