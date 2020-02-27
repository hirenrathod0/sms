<?php include 'config.php'; 


			 $id = $_POST['id'];
			 $query="select block,flat_num from flat where uid=".$id;
			 $result=mysqli_query($con,$query);
			 $row=mysqli_fetch_assoc($result);
             $flatno=$row['block']." - ".$row['flat_num'];
             echo $flatno;
		
?>