// function loadSearch(str)
// {
// 	var s1=document.getElementById("course_search").value;
// 	var xmlhttp;
// 	if (str.length==0) {
// 	    document.getElementById("livesearch").innerHTML="";
// 	    document.getElementById("livesearch").style.border="0px";
// 		document.getElementById("search-layer").style.width="auto";
// 		document.getElementById("search-layer").style.height="auto";
// 		document.getElementById("livesearch").style.display="block";
// 		$('#textbox-clr').text("");
// 	    return;
// 	  }
// 	if (window.XMLHttpRequest)
// 	  {// code for IE7+, Firefox, Chrome, Opera, Safari
// 	  xmlhttp=new XMLHttpRequest();
// 	  }
// 	else
// 	  {// code for IE6, IE5
// 	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
// 	  }
// 	xmlhttp.onreadystatechange=function()
// 	  {
// 	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
// 	    {
// 	    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
// 		document.getElementById("search-layer").style.width="100%";
// 		document.getElementById("search-layer").style.height="100%";
// 		document.getElementById("livesearch").style.display="block";
// 		$('#textbox-clr').text("X");
// 	    }
// 	  }
// 	xmlhttp.open("GET","call_ajax.php?n="+s1,true);
// 	xmlhttp.send();	
// }
function loadSearch(str)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  	document.getElementById("search_results").innerHTML = xhttp.responseText;
    	  	document.getElementById("search-layer").style.width="100%";
			document.getElementById("search-layer").style.height="100%";
			document.getElementById("livesearch").style.display="block";
  		}
	};
	var s1=document.getElementById("course_search").value;
	if (str.length==0)
	{
	    document.getElementById("search_results").innerHTML="";
	    document.getElementById("search_results").style.border="0px";
		document.getElementById("search-layer").style.width="auto";
		document.getElementById("search-layer").style.height="auto";
		document.getElementById("livesearch").style.display="block";
		$('#textbox-clr').text("");
	    return;
	}
	xhttp.open("POST", "Course/get_subjects.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("n="+s1);
}