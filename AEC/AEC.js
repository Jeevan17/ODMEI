function loadUpdate()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("LAttendance").innerHTML = xhttp.responseText;
  		}
	};
	var program = document.getElementById("Program1").value;
	var year = document.getElementById("Year1").value;
	var semester = document.getElementById("Semester1").value;
	var branch = document.getElementById("Branch1").value;
	var section = document.getElementById("Section1").value;
	var date = document.getElementById("date1").value;
	
	var rno = document.getElementsByName("rollnumber");
    var len = rno.length;
    for (var r = 0; r < len; r++) {
    	var rollnumber = rno[r].innerHTML;
    	var present = new Array();
	    var absent = new Array();
	    var timeslot = new Array();
		var time = document.getElementsByName(rollnumber);
	    
	 	len=time.length;
	 	for (var i=0; i<len; i++)
	 	{
	 	 	if(time[i].checked==true)
	 	 	{
	 	 		timeslot[i]=1;
	 	 	}
	 	 	if(time[i].checked==false)
	 	 	{
	 	 		timeslot[i]=0;
	 	 	}
	 	}
	 			
	 // 	present.forEach(function(element) {
		// 	alert('present:  '+element);
		// });
	 // 	absent.forEach(function(element) {
		// 	alert('absent:  '+element);
		// });
		//var course = document.getElementById('courses').value;
		xhttp.open("POST", "UpdateAttendance.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("date="+date+"&timeslot="+JSON.stringify(timeslot)+"&rollnum="+rollnumber);
    }
}

function loadAttendance()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("LAttendance").innerHTML = xhttp.responseText;
  		}
	};
	var program = document.getElementById("Program1").value;
	var year = document.getElementById("Year1").value;
	var semester = document.getElementById("Semester1").value;
	var branch = document.getElementById("Branch1").value;
	var section = document.getElementById("Section1").value;
	var date = document.getElementById("date1").value;
	xhttp.open("POST", "Get_Attendance.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("year="+year+"&program="+program+"&branch="+branch+"&section="+section+"&semester="+semester+"&date="+date);
}
function loadAdd()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("rollnumber").innerHTML = xhttp.responseText;
  		}
	};
	var program = document.getElementById("Program").value;
	var year = document.getElementById("Year").value;
	var semester = document.getElementById("Semester").value;
	var branch = document.getElementById("Branch").value;
	var section = document.getElementById("Section").value;
	var date = document.getElementById("date").value;
	
	var rno = document.getElementsByName("rollnumber");
	var time = document.getElementsByName("Attendance");
    var len = rno.length;
    var present = new Array();
    var absent = new Array();
    var timeslot = new Array();
    for (var i=0; i<len; i++)
 	{
 	 	if(rno[i].checked==true)
 	 	{
 	 		present[i]=rno[i].value;
 	 	}
 	 	if(rno[i].checked==false)
 	 	{
 	 		absent[i]=rno[i].value;
 	 	}
 	}
 	len=time.length;
 	for (var i=0; i<len; i++)
 	{
 	 	if(time[i].checked==true)
 	 	{
 	 		timeslot[i]='1';
 	 	}
 	 	if(time[i].checked==false)
 	 	{
 	 		timeslot[i]='0';
 	 	}
 	}
 			
 // 	present.forEach(function(element) {
	// 	alert('present:  '+element);
	// });
 // 	absent.forEach(function(element) {
	// 	alert('absent:  '+element);
	// });
	var course = document.getElementById('courses').value;
	xhttp.open("POST", "Attendance.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("date="+date+"&present="+JSON.stringify(present)+"&absent="+JSON.stringify(absent)+"&timeslot="+JSON.stringify(timeslot)+"&course="+course+"&year="+year+"&program="+program+"&branch="+branch+"&section="+section+"&semester="+semester);
	
	len=time.length;
 	for (var i=0; i<len; i++)
 	{
 	 	if(time[i].checked==true)
 	 	{
 	 		time[i].checked=false;
 	 	}
 	}
	
}

function loadRnum()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("rollnumber").innerHTML = xhttp.responseText;
  		}
	};
	var program = document.getElementById("Program").value;
	var year = document.getElementById("Year").value;
	var semester = document.getElementById("Semester").value;
	var branch = document.getElementById("Branch").value;
	var section = document.getElementById("Section").value;
	var date = document.getElementById("date").value;
	xhttp.open("POST", "Get_rollno.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("year="+year+"&program="+program+"&branch="+branch+"&section="+section+"&semester="+semester);
}



// function toggle(source) {
//   checkboxes = document.getElementsByName('rollnumber');
//   for(var checkbox in checkboxes)
//     checkbox.checked = source.checked;
// }