<?php
  $dbhost = 'localhost';
  $dbuser = 'admin';
  $dbpass = 'cbit';
  
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbitdb');
  session_start();
  if(!isset($_SESSION['principal'])){
    echo "<script language='javascript'>window.location='../index.php';</script>";
  }
   
  if(! $conn )
  {
    echo "
      <div class='alert alert-danger'>
        <strong>Not connected to database." . mysqli_error();"</strong>
      </div>";
  }
?>


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
                  <a class='nav-link active ' href='Placement.php'>Home</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link ' href='Company_details.php'>Company Details</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link ' href='Student_details.php'>Student wise Details</a>
                </li>
              </ul>
              <div class='tab-content'>
                <div class='container tab-pane active'><br><br>
                  <div class='display-1'>

                    <?php
                      if(!isset($_SESSION['Placement']))
                      {
                        echo "<script language='javascript'>window.location='index.php';</script>";
                      }
                      $rno = $_POST['rollno'];
                      $sql = "select * from student where RollNumber='$rno'";
                      $retval = mysqli_query($conn, $sql);
                      if(! $retval )
                      {
                        echo "<script>alert('Entered RollNo does not exist!')</script>";
                        die('Could not get data: ' . mysqli_error());
                      } 
                    ?>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>