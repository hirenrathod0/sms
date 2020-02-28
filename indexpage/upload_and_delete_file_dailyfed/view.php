<?php
	mysql_connect("localhost","root","");
mysql_select_db("abc");
	$id=isset($_GET['id'])? $_GET['id'] : "";
	$stat=$dbh->prepare("select *from upload where id=?");
	$stat->bindParam(1,$id);
		$stat->execute();
		
		

?>