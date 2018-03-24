function load42(rno,yands)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("show_marks").innerHTML = xhttp.responseText;
  		}
	};
	// var yy = document.getElementById('42').value;
	// alert('testing');
	// document.write(rno);
	//document.write(yands);
	// var yands = string(yands);
	// var n = string([yands.slice(0,1),"Sem",yands.slice(1)]);
	// document.write(n);
	xhttp.open("POST", "marks/getMarks.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("rno="+rno+"&yands="+yands);
}