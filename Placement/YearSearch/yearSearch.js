function loadYear(x)
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
  //var x = document.getElementById("yname").value; 
  xhttp.open("POST", "YearSearch/Year_Search.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("yname="+x);
}