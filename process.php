<?php 
include('config.php');
if(isset($_POST['insert_category']))
{
	$categoryname =$_POST["categoryname"]; 
	// echo "<script>alert('$categoryname');</script>";
	
	$_SESSION['message']="Record has been saved!..";
	$_SESSION['msg_type']="success";

	$query="INSERT into category(categoryName) VALUES('$categoryname')";
	$row=mysqli_query($con,$query);
	// echo "$row";
	if(isset($row))
	{		
		echo "<script>alert('inserted');</script>";		
		header('location:add_cate.php');	
	}else{
		die('Could not Insert: '. mysql_error());		
	}
}


if(isset($_POST['submit']))
{
	// print_r($_POST);
	$_SESSION['id']=2;
	$uid=$_SESSION['id'];
	$category=$_POST['category'];

	$noc=$_POST['noc'];
	$complaintdetials=$_POST['complaindetails'];



	$query=mysqli_query($con,"insert into tblcomplaints(userId,category,noc,complaintDetails) values('$uid','$category','$noc','$complaintdetials')");

// code for show complaint number
	$sql=mysqli_query($con,"select complaintNumber from tblcomplaints  order by complaintNumber desc limit 1");
	while($row=mysqli_fetch_array($sql))
	{
		$cmpn=$row['complaintNumber'];
	}
	$complainno=$cmpn;
	echo '<script> alert("Your complain has been successfully filled and your complaintno is  "+"'.$complainno.'")</script>';
		header('location:cmp_reg.php');	

}

if(isset($_POST['submit_notice']))
{
	// print_r($_POST);
	$_SESSION['id']=2;
	$title=$_POST['title'];
	$descr=$_POST['descr'];
	

	$query1=mysqli_query($con,"insert into notice(title,descr) values('$title','$descr')");
	if(isset($query1))
	{		
		echo "<script>alert('inserted');</script>";		
		header('location:add_notice.php');	
	}else{
		die('Could not Insert: '. mysql_error());		
	}

}

?>