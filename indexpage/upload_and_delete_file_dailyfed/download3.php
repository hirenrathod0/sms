<?php

	include "download2.php";
	mysql_connect('localhost','root',"");
	mysql_select_db("abc");
	$id=$_GET['id'];
	$query="select *from upload where id='$id'";
	$query1=mysql_query($query);
	while($ros=mysql_fetch_array($query1))
	{
		$path=$ros['path'];
		header('content-Disposition : attachment; filename = '.$path.'');
		header('content-type:application/octent-strem');
		header('content-length='.filesize($path));
		readfile($path);
	}
	
?>