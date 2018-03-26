function validateTP()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("val_tp").innerHTML = xhttp.responseText;
  		}
	};
	var tp = document.getElementById('tp').value;
	var regex = /[A-Za-z]{2,10}\-[0-9]{4}$/;
	var flag=1;
	if(regex.test(tp) == false)
	{
		flag=0;
	}
	tp=flag;
	xhttp.open("POST", "Timeperiod/val_tp.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("tp="+tp);
}
function checkTP()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
    	if (this.readyState == 4 && this.status == 200)
    	{
    	  document.getElementById("check_tp").innerHTML = xhttp.responseText;
  		}
	};
	var tp = document.getElementById('tp').value;
	xhttp.open("POST", "Timeperiod/check_tp.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("tp="+tp);
}