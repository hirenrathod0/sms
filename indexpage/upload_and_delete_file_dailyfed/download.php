<?php
mysql_connect("localhost","root","");
mysql_select_db("abc");
$query=mysql_query("select *from upload");
$rowcount=mysql_num_rows($query);
?>
<table border="1">
	<tr>
		<td>Download</td>
	</tr>
<?php
	for($i=1;$i<=$rowcount;$i++)
	{
		$row=mysql_fetch_array($query);
?>
<tr>
	<td><a href="upload/<?php echo $row["file"];?>"><?php echo $row["file"]; ?></a></td>
</tr>
<?php	
	}
	
?>
</table>