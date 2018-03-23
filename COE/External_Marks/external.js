function loadCourses()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("show_courses").innerHTML = xhttp.responseText;
  		}
	};
	var rno = document.getElementById('rno').value;
	xhttp.open("POST", "External_Marks/getCourses.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("rno="+rno);
}
// function loadInsert()
// {
// 	var xhttp = new XMLHttpRequest();
// 	xhttp.onreadystatechange = function()
// 	{
//     	if (this.readyState == 4 && this.status == 200)
//     	{
//     	  document.getElementById("get_insert").innerHTML = xhttp.responseText;
//   		}
// 	};
// 	var test = document.getElementsByName('cid');
// 	alert(test[0].value);
// 	xhttp.open("POST", "Mid_marks/insert.php", true);
// 	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 	xhttp.send("cid="+JSON.stringify(test));
// }