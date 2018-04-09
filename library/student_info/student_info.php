<?php include '../../dataConnections.php';
	session_start();
	if(!isset($_SESSION['library'])){
		echo "<script language='javascript'>window.location='../index.php';</script>";
	}
	$uname=$_SESSION['library'];
	if (array_key_exists('rno', $_POST))
	{
		$rno = $_POST['rno'];
		echo "<hr>";
		$sql = "SELECT * from library NATURAL JOIN student_takes_books WHERE student_takes_books.RollNumber='$rno'";
		$retval = mysqli_query($conn, $sql);
		$aff_rows = mysqli_affected_rows($conn);
?>
<form action="student_info/student_info.php" method="POST">
	<table border="1">
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
				<td><input type="submit" id="<?php echo $row['BookID'] ?>" name="<?php echo $row['BookID'] ?>" value="<?php echo $row['BookID']."--Returned" ?>"></td>
			</tr>

<?php
}
?>
</table>
</form>
<?php
echo "<hr><h4>Total books taken: $count<h4><hr>";
if($count>=4)
{
	echo "<input type=button value=\"Issue book\" disabled>";
}
else
{
	echo "<input type=button value=\"Issue book\">";
}
}
if(isset($_POST["submit"]))
{
	$book_id=$_POST['submit'];
	var_dump($book_id);
}
?>
