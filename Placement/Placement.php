<?php include '../dataConnections.php'; 

  session_start();
  if(!isset($_SESSION['Placement'])){
    echo "<script language='javascript'>window.location='../index.php';</script>";
  }
  $currentPage = 'Home';
  include 'header.php';

  $max = "SELECT Batch_name from placement_batch order by id asc";
  $batch='';
  if($res=mysqli_query($conn,$max))
  {
    while($row = mysqli_fetch_row($res))
    {
      $batch=$row[0];
    }
  }
?>
  <h2>Placement Batch: <mark><?php echo"$batch";?></mark></h2><br>
    <?php
      $sql="SELECT student_attend_placements.CompanyName, bsp_code.Branch ,count(bsp_code.Branch) as Count FROM student INNER JOIN student_attend_placements ON student.RollNumber=student_attend_placements.RollNumber INNER JOIN bsp_code ON student.BSP=bsp_code.BSP where student_attend_placements.Result='Placed' and PBatch= (select id from placement_batch order by id desc) GROUP BY student_attend_placements.CompanyName, bsp_code.Branch ORDER BY student_attend_placements.CompanyName";
      $retval = mysqli_query($conn, $sql);
      $data = array();
      $brch = array('CSE','IT');
      while($row = mysqli_fetch_array($retval))
      {
        for ($i=0; $i<2 ; $i++)
        { 
          $data[$row['CompanyName']][$brch[$i]] = '-';
        }
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>