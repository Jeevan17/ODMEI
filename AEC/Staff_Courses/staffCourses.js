function loadCourses()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("courses").innerHTML = xhttp.responseText;
  		}
	};
	var staff = document.getElementById('staff').value; 
	xhttp.open("POST", "Staff_Courses/get_Courses.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("staff="+staff);
}
function loadInsert()
{

}
