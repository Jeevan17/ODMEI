<!DOCTYPE html>
  <html>
    <head>
      <title>Placement</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>

    <body>
      <div class="container">
        <div class='row pt-1'>
          <div class='col-sm-2'>
          </div>
          <div class='col-sm-8'>
            <img src='../images/header.jpg' class='img-fluid'>
          </div>
          <div class='col-sm-1'>
          </div>
          <div class='col-sm-1 pt-3 pl-5'>
            <a href='../index.php' class='btn btn-danger btn-sm'>Logout</a>
          </div>
        </div>
        <div class='container pt-3'>
          <div class='row'>
            <div class='col-sm-12'>
              <ul class='nav nav-tabs nav-justified'>
                <li class='nav-item'>
                  <a class='nav-link' href='Placement.php'>Home</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link active' href='Company_details.php'>Company Details</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link ' href='Branch_details.php'>Branch wise Details</a>
                </li>
              </ul>
              <div class='tab-content'>
                <div class='container tab-pane active'><br>
                  <div>
                    <center>
                      <label for='cname'>Enter Company Name</label>
                      <input type='text' class='form-control' id='cname' placeholder='eg:- Google' name='company_name' required style=' width: 200px;     display: initial;'>
                      <input type='button' name='Search' value='Search' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;' onclick='loadCompany()'>
                      </form>
                    </center>
                  </div>
                  <div id='company_details'>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
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
          xhttp.open("POST", "Company_Search.php", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("cname="+x);
        }
      </script>    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>