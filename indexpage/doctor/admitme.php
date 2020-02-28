<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
$p=$_GET['pid'];
$cn=mysqli_connect("localhost","root","","doc_connect");
$q="insert into alert_admit(pid) values('$p')";

if(mysqli_query($cn,$q))
{
echo "<script> alert('Alert Send to Reception'); </script>";
echo "<script> window.location='index.php'; </script>";
}
?>
</body>
</html>
