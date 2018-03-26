function checkCID()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("check_cid").innerHTML = xhttp.responseText;
  		}
	};
	var cid = document.getElementById('cid').value;
	xhttp.open("POST", "New_Course/check_course.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("cid="+cid);
}
function addCourse()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("addcourse").innerHTML = xhttp.responseText;
  		}
	};
	var cid = document.getElementById('cid').value;
	var cname = document.getElementById('cname').value;
	var dept = document.getElementById('dept').value;
	var sessional = document.getElementById('sessional').value;
	var see = document.getElementById('see').value;
	var credits = document.getElementById('credits').value;
	xhttp.open("POST", "New_Course/add_course.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("cid="+cid+"&cname="+cname+"&dept="+dept+"&sessional="+sessional+"&see="+see+"&credits="+credits);
}