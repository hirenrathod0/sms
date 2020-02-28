<?php

	$en=$_POST["key"];
	mysqli_select_db()
?>
<?php
$conn=mysqli_connect("localhost","root","","kundan");
if(!($conn)){
	echo "connection failed".mysqli_error();
}
else{
 
		$con=mysql_connect("localhost","root","");
		mysql_select_db("student",$con);
		
		$result=mysql_query("select *from stu where no='".$en."'");
		while($row=mysql_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$row['no']."</td>";
			echo "<td>".$row['sname']."</td>";
			echo "<td>".$row['mob']."</td>";
			echo "</tr>";
		
		} >
		echo 
   	
		mysql_close($con);
?>
	
	
	
	

?>