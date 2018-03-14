function loadBSP()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("getBSP").innerHTML = xhttp.responseText;
  		}
	};
	var course = document.getElementById('courses').value;
	var date = document.getElementById('date').value;
	xhttp.open("POST", "Attendance/get_BSP.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("courses="+course+"&date="+date);
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
	var yands = document.getElementById("yands").value;
	var branch = document.getElementById("Branch").value;
	var section = document.getElementById("Section").value;
	var course = document.getElementById('courses').value;
	var date = document.getElementById("date").value;
	
	xhttp.open("POST", "Attendance/get_RollNo.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("date="+date+"&course="+course+"&YandS="+yands+"&program="+program+"&branch="+branch+"&section="+section);
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
	var yands = document.getElementById("yands").value;
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
 
 	var course = document.getElementById('courses').value;
	xhttp.open("POST", "Attendance/addAttendance.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("date="+date+"&present="+JSON.stringify(present)+"&absent="+JSON.stringify(absent)+"&timeslot="+JSON.stringify(timeslot)+"&course="+course+"&YandS="+yands+"&program="+program+"&branch="+branch+"&section="+section);
	
	len=time.length;
 	for (var i=0; i<len; i++)
 	{
 	 	if(time[i].checked==true)
 	 	{
 	 		time[i].checked=false;
 	 	}
 	}
}