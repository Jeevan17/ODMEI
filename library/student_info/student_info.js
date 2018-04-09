function bookReturned(rno,book_id)
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
      if (this.readyState == 4 && this.status == 200)
      {
        document.getElementById("book_r").innerHTML = xhttp.responseText;
      }
  }
  // var rno = document.getElementById('rno').value;
  // document.write(rno);
  // document.write(book_id);
  xhttp.open("POST", "student_info/book_returned.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("rno="+rno+"&bid="+book_id);
}