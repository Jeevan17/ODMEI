<?php include '../dataConnections.php'; 

  session_start();
  if(!isset($_SESSION['Placement'])){
    echo "<script language='javascript'>window.location='../index.php';</script>";
  }
  $currentPage = 'Branch wise Details';

  include 'header.php';
?>                  
<center>
  <label for='bname'>Enter Branch Name</label>
    <input type='text' class='form-control' id='bname' placeholder='eg:- CSE' name='branch_name' required style=' width: 200px;     display: initial;'>
    <input type='button' name='Search' value='Search' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;' onclick='loadBranch()'>
</center>
<div id='branch_details'>
</div>

</div>
</div>
  <script>
    function loadBranch()
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
      var x = document.getElementById("bname").value; 
      xhttp.open("POST", "Branch_Search.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("bname="+x);
      xhttp.send();
    }
  </script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>