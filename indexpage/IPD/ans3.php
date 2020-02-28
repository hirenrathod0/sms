<?php require_once('../Connections/cn.php'); ?><?php 
if(isset($_GET['id']))
{
	$tt=$_GET['id'];
	$mid=$_GET['mid'];
		 $pid=$_GET['pid'];
    $rr="UPDATE evening SET status='Done' where mid='$tt'" ;
	//exit;
	mysql_query($rr);
	header('location:detailpatients.php?mid='.$mid.'&pid='.$pid.'&id='.$tt.'');
	
}

?>