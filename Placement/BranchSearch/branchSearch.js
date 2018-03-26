function loadBranch(x)
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
  //var x = document.getElementById("bname").value;
  xhttp.open("POST", "BranchSearch/Branch_Search.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("bname="+x); 
  
}