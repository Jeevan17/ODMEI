function loadAddMid1(rno)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("add_mid1").innerHTML = xhttp.responseText;
  		}
	};
	xhttp.open("POST", "Mid_marks/addMid1.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("rno="+rno);
}
function loadAddMid2(rno)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("add_mid2").innerHTML = xhttp.responseText;
  		}
	};
	xhttp.open("POST", "Mid_marks/addMid2.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("rno="+rno);
}
function loadUpdateMid1(rno)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("update_mid1").innerHTML = xhttp.responseText;
  		}
	};
	xhttp.open("POST", "Mid_marks/updateMid1.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("rno="+rno);
}
function loadUpdateMid2(rno)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("update_mid2").innerHTML = xhttp.responseText;
  		}
	};
	xhttp.open("POST", "Mid_marks/updateMid2.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("rno="+rno);
}