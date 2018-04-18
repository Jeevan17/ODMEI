<?php include '../dataConnections.php'; 
	session_start();
	if(!isset($_SESSION['library'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$currentPage = 'Home';
	$uname=$_SESSION['library'];
	include 'header.php';
	$hod_name = explode('_', $uname);
?>
<div>
	<center>
		<form action='library.php' method='POST'>
			<label for='rno'>Enter Roll Number</label>
			<input type='text' class='form-control' id='rno' placeholder='eg:- 160114733094' name='rollno' required style=' width: 200px;     display: initial;'>
			<input type='submit' value='Search' name='submit' class='btn ml-3 btn-outline-primary btn-sm' style='display: initial;'>
		</form>
	</center>
</div>

			
<!--***********************************************-->
<?php
	if(isset($_POST["submit"]))
	{
		if($_POST['rollno']!=null)
		{
			//session_start();
			if(!isset($_SESSION['library'])){
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
	<hr>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-3'>
				<ul class='nav nav-pills flex-column' role='tablist'>
					<li class='nav-item'>
						<a class='nav-link active' data-toggle='pill' href='#current_books'>Current Books</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' data-toggle='pill' href='#issue_books'>Issue Books</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' data-toggle='pill' href='#books_history'>Books History</a>
					</li>
				</ul>
			</div>
			<div class='col-sm-8'>
				<div class='tab-content'>
					<div id='current_books' class='container tab-pane active'>
						<?php
						$sql = "SELECT * from library NATURAL JOIN student_takes_books WHERE student_takes_books.RollNumber='$rno' AND student_takes_books.ReturnedDate IS NULL";
						$retval = mysqli_query($conn, $sql); 
						?>
							<h2>
								<mark>
									Current Books Taken--<?php echo $rno?>
								</mark>
							</h2><br>
							<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
								<tr>
								<th>SNo</th>
								<th>BookID</th>
								<th>Title</th>
								<th>Author</th>
								<th>CheckedOutDate</th>
								</tr>
								<?php
								$count=0;
								while($row = mysqli_fetch_array($retval))
								{
									$count++;
									?>
									<tr>
										<td><?php echo $count ?></td>
										<td><?php echo $row['BookID'] ?></td>
										<td><?php echo $row['Title'] ?></td>
										<td><?php echo $row['Author'] ?></td>
										<td><?php echo $row['CheckedOutDate'] ?></td>
										<td>
											<input type="submit" onclick="bookReturned('<?php echo $rno ?>','<?php echo $row['BookID'] ?>')" class='btn btn-outline-info pl-5 pr-5' id="<?php echo $row['BookID'] ?>" name="submit" value="<?php echo $row['BookID']."--Returned" ?>">
										</td>
									</tr>
								<?php
								}
								?>
								</table>
				  	<?php 
				  		}
				  		echo "<hr><h4>Total books taken: $count<h4><hr><br><br>"; 
				  	?>
				  	<div id="book_r">
				  	</div>
					</div>
					<div id='issue_books' class='container tab-pane fade'>
					    <h2><mark>Issue new books -- <?php echo $rno?></mark></h2><br>
						<?php
							$max = 4-$count;
							echo "<h3>$max"." more books can be issued</h3><hr>";
							for($i=1;$i<=$max;$i++)
							{
								echo "
									<input type=\"text\" class=\"form-control\" placeholder=\"Enter Book ID\" id='bi' name='bi'>
									<input type=\"button\" onclick=\"bookIssue('$rno')\" class='btn btn-outline-info pl-5 pr-5' value=\"Issue\"><br><br>
								";
							}
						?>
					<div id="book_i">
					</div>
					</div>
					<div id='books_history' class='container tab-pane fade'>
						<h2><mark>Books History -- <?php echo $rno?></mark></h2><br>
						<?php
						$sql = "SELECT * from library NATURAL JOIN student_takes_books WHERE student_takes_books.RollNumber='$rno' AND student_takes_books.ReturnedDate IS NOT NULL";
						$retval = mysqli_query($conn, $sql); 
						?>
							<table class='table table-bordered table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl'>
								<tr>
								<th>SNo</th>
								<th>BookID</th>
								<th>Title</th>
								<th>Author</th>
								<th>CheckedOutDate</th>
								<th>ReturnedDate</th>
								</tr>
								<?php
								$count=0;
								while($row = mysqli_fetch_array($retval))
								{
									$count++;
									?>
									<tr>
										<td><?php echo $count ?></td>
										<td><?php echo $row['BookID'] ?></td>
										<td><?php echo $row['Title'] ?></td>
										<td><?php echo $row['Author'] ?></td>
										<td><?php echo $row['CheckedOutDate'] ?></td>
										<td><?php echo $row['ReturnedDate'] ?></td>
									</tr>
								<?php
								}
								?>
								</table>
				  	<?php 
				  		echo "<hr><h4>Total books taken so far: $count<h4><hr><br><br>"; 
				  	?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		}
	?>
</div>
</div>
	<script src="student_info/student_info.js"></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'></script>
	</body>
</html>