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
  xhttp.open("POST", "StudentResult/studentResult.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("cname="+x);
}