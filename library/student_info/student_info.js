function loadStudentInfo()
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
      if (this.readyState == 4 && this.status == 200)
      {
        document.getElementById("result").innerHTML = xhttp.responseText;
      }
  };
  var rno = document.getElementById('rno').value;
  xhttp.open("POST", "student_info/student_info.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("rno="+rno);
}