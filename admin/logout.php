<?php include 'config.php'; 

if(isset($_SESSION['fullName']))
{
	session_destroy();
		
	echo "<script>location.href='login.php';</script>";
}else{
	echo "<script>location.href='login.php';</script>";
}
 ?>
<!-- category -->
</div>
</div>


?>
