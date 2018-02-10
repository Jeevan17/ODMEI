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
                  <a class='nav-link ' href='Branch_details.php'>Branch wise Details</a>
                </li>
              </ul>
              <div class='tab-content'>
                <div class='container tab-pane active'><br><br>
                  <h2>Placement Batch: <mark>2017-2018</mark></h2><br>
                  <?php
                    $sql="SELECT student_attend_placements.CompanyName, bsp_code.Branch ,count(bsp_code.Branch) as Count
                      FROM student 
                      INNER JOIN student_attend_placements ON student.RollNumber=student_attend_placements.RollNumber 
                      INNER JOIN bsp_code ON student.BSP=bsp_code.BSP 
                      where student_attend_placements.Result='Placed' and PBatch='2017-2018'
                      GROUP BY student_attend_placements.CompanyName, bsp_code.Branch
                      ORDER BY student_attend_placements.CompanyName";
                    $retval = mysqli_query($conn, $sql);
                    
                    $data = array();
                    $brch = array('CSE','ECE','IT');
                    while($row = mysqli_fetch_array($retval))
                    {
                      for ($i=0; $i<3 ; $i++)
                      { 
                        $data[$row['CompanyName']][$brch[$i]] = '-';
                      }
                      //$data[$row['CompanyName']][$row['Branch']] = (int)$row['Count'];
                    }
                    $retval = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($retval))
                    {
                      $data[$row['CompanyName']][$row['Branch']] = (int)$row['Count'];
                    }
                    echo "
                      <table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
                        <thead class='thead-dark'>
                          <tr>
                            <th>Company Name</th>
                            <th>CSE</th>
                            <th>ECE</th>
                            <th>IT</th>
                          </tr>
                        </thead>
                        <tbody class='table-secondary'>
                    ";
                    foreach ($data as $companyname => $value)
                    {
                      echo "
                        <tr>
                          <td>$companyname</div>
                      ";
                      foreach ($value as $branch => $count)
                      {
                        echo "
                          <td>$count</td>
                        ";  
                      }
                      echo "</tr>";
                    }
                    echo "</tbody>
                      </table>
                      ";
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