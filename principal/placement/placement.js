function loadCompany()
{
	var xhttp;
	xhttp=new XMLHttpRequest();
  	xhttp.onreadystatechange = function() 
  	{    
  		if (this.readyState == 4 && this.status == 200) 
	    {
	    	document.getElementById("company_details").innerHTML = xhttp.responseText;
	    }
  	};
  	var x = document.getElementById("cname").value; 
	xhttp.open("POST", "placement/Company_Search.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("cname="+x);
}
function loadBranch()
{
	var xhttp;
	xhttp=new XMLHttpRequest();
  	xhttp.onreadystatechange = function() 
  	{    
  		if (this.readyState == 4 && this.status == 200) 
	    {
	    	document.getElementById("branch_details").innerHTML = xhttp.responseText;
	    }
  	};
  	var x = document.getElementById("bname").value; 
	xhttp.open("POST", "placement/Branch_Search.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("bname="+x);
}
function loadYear()
{
	var xhttp;
	xhttp=new XMLHttpRequest();
  	xhttp.onreadystatechange = function() 
  	{    
  		if (this.readyState == 4 && this.status == 200) 
	    {
	    	document.getElementById("year_details").innerHTML = xhttp.responseText;
	    }
  	};
  	var x = document.getElementById("yname").value; 
	xhttp.open("POST", "placement/Year_Search.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yname="+x);
}