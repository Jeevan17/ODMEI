function checkSID()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("checkStaff").innerHTML = xhttp.responseText;
  		}
	};
	var sid = document.getElementById('sid').value;
	xhttp.open("POST", "Admission_check/check_staff.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("sid="+sid);
}