<?php

		$en=10;//$_POST['key'];
		
		//$en=10;
		$con=mysql_connect("localhost","root","");
		mysql_select_db("student",$con);
		
		$result=mysql_query("select *from stu where no='".$en."'"); 
		//echo $result;
		$data = "";
		while($row=mysql_fetch_array($result))
		{
			$data = $data.$row['sname'] ;
			$data = $data.$row['mob'];
			$data = $data.$row['no'];
		}
		echo $data;
		mysql_close($con);
	
?>