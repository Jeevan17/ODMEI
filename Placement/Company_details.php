<?php include '../dataConnections.php'; 

  session_start();
  if(!isset($_SESSION['Placement'])){
    echo "<script language='javascript'>window.location='../index.php';</script>";
  }
  $currentPage = 'Company Details';

  include 'header.php';
?>
  <center>
    <label for='cname'>Enter Company Name: </label>
    <input type='text' class='form-control' id='cname' placeholder='eg:- Google' name='company_name' required style=' width: 200px;     display: initial;' onkeyup="loadCompany(this.value)">
    <!-- <input type='button' name='Search' value='Search' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;' onclick='loadCompany()'> -->
    </form>
  </center>
  <div id='company_details'>
  </div>

</div>
</div>
<script src="CompanySearch/companySearch.js"></script>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>