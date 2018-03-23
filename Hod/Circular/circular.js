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
	xhttp.open("POST", "Circular/delete.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+id);
}