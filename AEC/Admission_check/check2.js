function checkADMN()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("checkAdmn").innerHTML = xhttp.responseText;
  		}
	};
	var admn = document.getElementById('admn').value;
	xhttp.open("POST", "Admission_check/check_admn.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("admn="+admn);
}
function checkRNO()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("checkRno").innerHTML = xhttp.responseText;
  		}
	};
	var rno = document.getElementById('roll_no').value;
	xhttp.open("POST", "Admission_check/check_rno.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("rno="+rno);
}