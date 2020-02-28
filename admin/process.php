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

	$complaintitle=$_POST['complaintitle'];
	$complaindetails=$_POST['complaindetails'];



	$query=mysqli_query($con,"insert into tblcomplaints(userId,category,complaintTitle,complaintDetails) values('$uid','$category','$complaintitle','$complaindetails')");

// code for show complaint number
	$sql=mysqli_query($con,"select complaintNumber from tblcomplaints  order by complaintNumber desc limit 1");
	while($row=mysqli_fetch_array($sql))
	{
		$cmpn=$row['complaintNumber'];
	}
	$complainno=$cmpn;
		
	echo "<script> alert('Your complain has been successfully filled and your complaintno is  $complainno'); location.href='cmp_reg.php';</script>";

}

if(isset($_POST['submit_notice']))
{
	// print_r($_POST);
	$_SESSION['id']=2;
	$title=$_POST['title'];
	$descr=$_POST['descr'];
	$query="select userEmail from users";
	$r=mysqli_query($con,$query);
	
$subject = $title;
$from = 'bhaktisanjaybhai@gmail.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">'.$descr.'</h1>';
//$message .= '<p style="color:#080;font-size:18px;">Will you marry me?</p>';
//$message .= 

$message .= '</body></html>';
 while($row=mysqli_fetch_array($r))
 {

$to = $row['userEmail'];
 
//$to = 'bhaktisanjaybhai@gmail.com';
// Sending email
mail($to, $subject, $message, $headers);
}
}	
	
	//}
	
	// $query1=mysqli_query($con,"insert into notice(title,descr) values('$title','$descr')");
	// if(isset($query1))
	// {		
	// 	echo "<script>alert('inserted');</script>";		
	// 	header('location:add_notice.php');	
	// }else{
	// 	die('Could not Insert: '. mysql_error());		
	// }

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO flat (block,flat_num,area,BHK,floor_no,price,owner,ownercno,owneremail) VALUES ('".$_POST["block"]."', '".$_POST["flat_num"]."', '".$_POST["area"]."', '".$_POST["BHK"]."', '".$_POST["floor_no"]."', '".$_POST["price"]."', '".$_POST["owner"]."', '".$_POST["ownercno"]."', '".$_POST["owneremail"]."')
		";
		$statement = $con->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		
		$query = "SELECT * FROM flat WHERE fid =:fid ";

		$statement = $dbh->prepare($query);
		
		$statement->execute(  
			array(
            ':fid' => $_POST['id']
			)
		);
		$result = $statement->fetchAll();
		$data = "";
		foreach($result as $row)
		{
			$data = $row['block'].",".$row['flat_num'].",".$row['area'].",".$row['BHK'].",".$row['floor_no'].",".$row['price'].",".$row['owner'].",".$row['ownercno'].",".$row['owneremail'];
		}
		echo $data;
	}
	if($_POST["action"] == "update")
	{
		$query = "UPDATE flat SET area=:area, BHK=:bhk, floor_no=:floor_no, price=:price where fid=:fid";
		$statement = $dbh->prepare($query);
		$result=$statement->execute(
			array(
				'area' =>$_POST['area'],
				'bhk' =>$_POST['BHK'],
				'floor_no' =>$_POST['floor_no'],
				'price' =>$_POST['price'],
				'owner' =>$_POST['owner'],
				'ownercno' =>$_POST['ownercno'],
				'owneremail' =>$_POST['owneremail'],
				'fid' =>$_POST['hidden_id'],
			)
		);
		echo $result.'  Data Updated';

	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM flat WHERE fid = '".$_POST["id"]."'";
		$statement = $con->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}


// if(isset($_POST['insert_user_reg']))
// {
	
// 	$query="INSERT into users(fullName,userEmail,password,contactNo,type,gender) VALUES('".$_POST["fullName"]."', '".$_POST["userEmail"]."', '".$_POST["password"]."', '".$_POST["contactNo"]."', '".$_POST["type"]."', '".$_POST["gender"]."')";
// 	$dummy=mysqli_insert_id($con);
// 	echo "$dummy";
// 	$query1="UPDATE flat SET uid = '".$dummy."',WHERE fid = '".$_POST["flat"]."'";
// 	$row=mysqli_query($con,$query);
// 	$row1=mysqli_query($con,$query1);
// 	// echo "$row";
// 	if(isset($row) && isset($row1))
// 	{		
// 		echo "<script>alert('inserted');</script>";		
// 		//header('location:user_reg.php');	
// 	}else{
// 		die('Could not Insert: '. mysql_error());		
// 	}
// }
?>