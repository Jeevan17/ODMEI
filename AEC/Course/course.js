// function loadSearch(str)
// {
// 	var xhttp = new XMLHttpRequest();
// 	xhttp.onreadystatechange = function()
// 	{
//     	if (this.readyState == 4 && this.status == 200)
//     	{
//     	  	document.getElementById("search_results").innerHTML = xhttp.responseText;
//     	  	document.getElementById("search-layer").style.width="100%";
// 			document.getElementById("search-layer").style.height="100%";
// 			document.getElementById("livesearch").style.display="block";
//   		}
// 	};
// 	var s1=document.getElementById("course_search").value;
// 	if (str.length==0)
// 	{
// 	    document.getElementById("search_results").innerHTML="";
// 	    document.getElementById("search_results").style.border="0px";
// 		document.getElementById("search-layer").style.width="auto";
// 		document.getElementById("search-layer").style.height="auto";
// 		document.getElementById("livesearch").style.display="block";
// 		$('#textbox-clr').text("");
// 	    return;
// 	}
// 	xhttp.open("POST", "Course/get_subjects.php", true);
// 	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 	xhttp.send("n="+s1);
// }

function loadCourses()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("showDetails").innerHTML = xhttp.responseText;
  		}
	};
	var cid = document.getElementById('cid').value;
	var branch = document.getElementById('Branch').value;
	xhttp.open("POST", "Course/get_subjects.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("cid="+cid+"&branch="+branch);
}

// function loadCourses(cid)
// {
// 	var xhttp = new XMLHttpRequest();
// 	xhttp.onreadystatechange = function()
// 	{
//     	if (this.readyState == 4 && this.status == 200)
//     	{
//     	  document.getElementById("showDetails").innerHTML = xhttp.responseText;
//   		}
// 	};
// 	//var cid = document.getElementById('cid').value;
// 	xhttp.open("POST", "Course/get_subjects.php", true);
// 	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 	xhttp.send("cid="+cid);
// }