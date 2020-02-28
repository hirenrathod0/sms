<html>
<body>
<?php
	include "config.php";
	$conn=mysql_connect("localhost","root");
	mysql_select_db("abc");
	$delcode=$_GET['id'];
	$qry="delete from upload where id='".$delcode."'";
	mysql_query($qry,$conn);
	echo "row deleted";
	mysql_close($conn);
?>
<br>
<a href="upload.php">go back</a>
</body>
</html>
