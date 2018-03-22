function loadTimetable()
{
	var xhttp;
	xhttp=new XMLHttpRequest();
  	xhttp.onreadystatechange = function() 
  	{    
  		if (this.readyState == 4 && this.status == 200) 
	    {
	    	document.getElementById("getTimetable").innerHTML = xhttp.responseText;
	    }
  	};
  	var program = document.getElementById("Program").value;
	var yands = document.getElementById("yands").value;
	var section = document.getElementById("Section").value;
	
	xhttp.open("POST", "timetable/get_timetable.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yands="+yands+"&program="+program+"&section="+section);
}