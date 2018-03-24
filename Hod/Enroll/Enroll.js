function loadToggle()
{
	var xhttp;
	xhttp=new XMLHttpRequest();
  	xhttp.onreadystatechange = function() 
  	{    
  		if (this.readyState == 4 && this.status == 200) 
	    {
	    	document.getElementById("test").innerHTML = xhttp.responseText;
	    }
  	};
  	var enroll = document.getElementById("enroll");

  	if(enroll.checked == true)
  	{
  		value=1
  	}
  	else
  	{
  		value=0;
  	}

	xhttp.open("POST", "Enroll/Enroll.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("enroll="+value);
}