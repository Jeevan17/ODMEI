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
	
	xhttp.open("POST", "TimeTable/get_timeTable.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("year="+year+"&program="+program+"&branch="+branch+"&section="+section+"&semester="+semester);
}
function loadStaff(subject,i)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("staff"+i+i).innerHTML = xhttp.responseText;
  		}
	};
	var program = document.getElementById("Program").value;
	var year = document.getElementById("Year").value;
	var semester = document.getElementById("Semester").value;
	var branch = document.getElementById("Branch").value;
	var section = document.getElementById("Section").value;
	
	xhttp.open("POST", "TimeTable/get_staff.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("year="+year+"&program="+program+"&branch="+branch+"&section="+section+"&semester="+semester+"&subject="+subject+"&i="+i);
}

function loadInsert()
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
	var day = document.getElementById("day").value;

	var subjects = new Array();
	var staff = new Array();
	var batch = new Array();
	for (j=0;j<7;j++)
	{
		subjects[j] = document.getElementById("course"+j).value;
	}
	for (j=0;j<7;j++)
	{
		staff[j] = document.getElementById("staff"+j).value;
	}
	for (j=0;j<7;j++)
	{
		batch[j] = document.getElementById("batch"+j).value;
	}
	
	xhttp.open("POST", "TimeTable/insert.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("day="+day+"&batch="+JSON.stringify(batch)+"&staff="+JSON.stringify(staff)+"&subjects="+JSON.stringify(subjects)+"&year="+year+"&program="+program+"&branch="+branch+"&section="+section+"&semester="+semester);
	alert('Record Inserted');
}