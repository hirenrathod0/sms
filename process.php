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


if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO flat (block,flat_num,area,BHK,floor_no,price) VALUES ('".$_POST["block"]."', '".$_POST["flat_num"]."', '".$_POST["area"]."', '".$_POST["BHK"]."', '".$_POST["floor_no"]."', '".$_POST["price"]."')
		";
		$statement = $con->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "SELECT * FROM flat WHERE fid = '".$_POST["id"]."'";
		$statement = $con->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['block'] = $row['block'];
			$output['flat_num'] = $row['flat_num'];
			$output['area'] = $row['area'];
			$output['BHK'] = $row['BHK'];
			$output['floor_no'] = $row['floor_no'];
			$output['price'] = $row['price'];

		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "UPDATE flat SET block = '".$_POST["block"]."',flat_num = '".$_POST["flat_num"]."',area = '".$_POST["area"]."',BHK = '".$_POST["BHK"]."',floor_no = '".$_POST["floor_no"]."' ,	price = '".$_POST["price"]."',WHERE fid = '".$_POST["hidden_id"]."'	";
		$statement = $con->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM flat WHERE fid = '".$_POST["id"]."'";
		$statement = $con->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}


if(isset($_POST['insert_user_reg']))
{
	
	$query="INSERT into users(fullName,userEmail,password,contactNo,type,gender) VALUES('".$_POST["fullName"]."', '".$_POST["userEmail"]."', '".$_POST["password"]."', '".$_POST["contactNo"]."', '".$_POST["type"]."', '".$_POST["gender"]."')";
	$dummy=mysqli_insert_id($con);
	echo "$dummy";
	$query1="UPDATE flat SET uid = '".$dummy."',WHERE fid = '".$_POST["flat"]."'";
	$row=mysqli_query($con,$query);
	$row1=mysqli_query($con,$query1);
	// echo "$row";
	if(isset($row) && isset($row1))
	{		
		echo "<script>alert('inserted');</script>";		
		//header('location:user_reg.php');	
	}else{
		die('Could not Insert: '. mysql_error());		
	}
}
?>