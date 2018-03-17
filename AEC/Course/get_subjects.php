<?php include '../../dataConnections.php';
    session_start();
    if(!isset($_SESSION['AEC'])){
        echo "<script language='javascript'>window.location='../index.php';</script>";
    }
    $s1=$_REQUEST["n"];
    
    $select_query="select * from courses where CourseName like '%".$s1."%'";
    $sql=mysqli_query($conn,$select_query);
    $s="";
    while($row=mysqli_fetch_array($sql))
    {
    	$s=$s."
    	<a class='link-p-colr' href='view.php?product=".$row['CourseID']."'>
    		<div class='live-outer'>
                    <div class='live-product-det'>
                    	<div class='live-product-name'>
                        	<p>".$row['CourseName']."</p>
                        </div>
                    </div>
                </div>
    	</a>
    	"	;
    }
    echo $s;
//<a href='pview.php?id=".$row['id']."&productname=".$row['productname']."'>".$row['productname']."></a>
//<p>".$row['productname']."</p><br>	<p>".$row['producttotalprice']."</p>
?>