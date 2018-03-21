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
	xhttp.open("POST", "Material/getBsp.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("courses="+course);
}
function loadDelete(id)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("get_delete").innerHTML = xhttp.responseText;
  		}
	};
	xhttp.open("POST", "Material/delete.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+id);
}