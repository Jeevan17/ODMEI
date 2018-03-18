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
	xhttp.open("POST", "sendMaterial/getBsp.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("courses="+course);
}