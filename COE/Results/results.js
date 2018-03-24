function loadResults(id)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("show_results").innerHTML = xhttp.responseText;
  		}
	};
	// document.write(timeperiod);
	xhttp.open("POST", "Results/results.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+id);
}