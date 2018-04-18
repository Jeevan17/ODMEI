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

function bookIssue(rno)
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
      if (this.readyState == 4 && this.status == 200)
      {
        document.getElementById("book_i").innerHTML = xhttp.responseText;
      }
  }
  var bi = document.getElementById('bi').value;
  //var rno = document.getElementById('rno').value;
  // document.write(rno);
  // document.write(bi);
  xhttp.open("POST", "student_info/book_issue.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("rno="+rno+"&bi="+bi);
}

function checkBID()
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
      if (this.readyState == 4 && this.status == 200)
      {
        document.getElementById("check_bid").innerHTML = xhttp.responseText;
      }
  };
  var bid = document.getElementById('bid').value;
  xhttp.open("POST", "student_info/check_bookid.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("bid="+bid);
}

function addBook()
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function()
  {
      if (this.readyState == 4 && this.status == 200)
      {
        document.getElementById("addbook").innerHTML = xhttp.responseText;
      }
  };
  var bid = document.getElementById('bid').value;
  var btitle = document.getElementById('btitle').value;
  var bauthor = document.getElementById('bauthor').value;
  var bpub = document.getElementById('bpub').value;
  var bedition = document.getElementById('bedition').value;
  var bisbn = document.getElementById('bisbn').value;
  xhttp.open("POST", "student_info/add_new_book.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("bid="+bid+"&btitle="+btitle+"&bauthor="+bauthor+"&bpub="+bpub+"&bedition="+bedition+"&bisbn="+bisbn);
}