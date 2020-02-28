<?php include 'header.php'; 
if (isset($_GET['id'])) {
		// echo "<script>alert('".$_GET['id']."');</script>";		
	$query1="delete from user_buffer where id =".$_GET['id']."";
	$row1=mysqli_query($con,$query1);
	// echo "$row";
	if( isset($row1))
	{		
		echo "<script>alert('Request is Deleted'); location.href='user_reg.php';</script>";		
		//header('location:user_reg.php');	
	}else{
		die('Could not Insert: '. mysql_error());		
	}
}

if (isset($_REQUEST['insert_users'])) {
		// echo "<script>alert('".$_REQUEST['insert_users']."');</script>";	
	$query1="select * from user_buffer where id='".$_REQUEST['insert_users']."'";
				$result=mysqli_query($con,$query1);
				$dumm1fullName="";
					$dumm1userEmail="";
					$dumm1contactNo="";
					$dumm1password="";
					
					$dumm1type="";
					$dumm1gender="";
					$dumm1dob="";
				if($result === FALSE) { 
				    die(mysql_error()); // TODO: better error handling
				}
				while($rows=$result->fetch_assoc())
				{
					$dumm1id=$rows['id'];
					$dumm1fid=$rows['fid'];

					$dumm1fullName=$rows['fullName'];
					$dumm1userEmail=$rows['userEmail'];
					$dumm1contactNo=$rows['contactNo'];
					$dumm1password=$rows['password'];
					
					$dumm1type=$rows['type'];
					$dumm1gender=$rows['gender'];
					$dumm1dob=$rows['dob'];
				}
		// echo "<script>alert('".$dumm1fullName.	$dumm1userEmail.$dumm1contactNo.$dumm1password.$dumm1type.$dumm1gender.$dumm1dob."'); </script>";		

	$query="update flat set uid =".$dumm1id." where fid=".$dumm1fid."";
	$row=mysqli_query($con,$query);
	// echo "$row";
	
	$query4=mysqli_query($con,"select * from user_buffer order by id desc limit 1");
	while($row3=mysqli_fetch_array($query4))
	{
		$cmpn=$row3['id'];
	}
	$idd=$cmpn;

	$query3="insert into users(id,fullName,userEmail,password,contactNo,type,gender,dob) values('$idd','$dumm1fullName','$dumm1userEmail','$dumm1password','$dumm1contactNo','$dumm1type','$dumm1gender','$dumm1dob')";
	$row2=mysqli_query($con,$query3);
	

	$query2="delete from user_buffer where id =".$_REQUEST['insert_users']."";
	$row1=mysqli_query($con,$query2);
	if( isset($row1) && isset($row) && isset($row2))
	{		
		echo "<script>alert('Request is Approved'); location.href='user_reg.php';</script>";		
		//header('location:user_reg.php');	
	}else{
		die('Could not Insert: '. mysql_error());		
	}	
	
}
// if(isset($_POST['insert_user_reg']))
// {
// 	$query="INSERT into users(fullName,userEmail,password,contactNo,type,gender) VALUES('".$_POST["fullName"]."', '".$_POST["userEmail"]."', '".$_POST["password"]."', '".$_POST["contactNo"]."', '".$_POST["type"]."', '".$_POST["gender"]."')";
// 	$row=mysqli_query($con,$query);
	
// 	$dummy=mysqli_insert_id($con);

// 	//echo "$dummy";

// 	$query1="UPDATE flat SET uid = '".$dummy."' WHERE fid = '".$_POST["flat"]."'";
// 	$row1=mysqli_query($con,$query1);
// 	// echo "$row";
// 	if(isset($row) && isset($row1))
// 	{		
// 		echo "<script>alert($dummy);</script>";		
// 		//header('location:user_reg.php');	
// 	}else{
// 		die('Could not Insert: '. mysql_error());		
// 	}
// }
?>
  <div class="content-wrapper">

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Request List</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<section class="content-header">
	<div class="container-fluid">

		<table class="table display" id="usertable" width="100%">
			<thead>
				<!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
				<tr><th>Name</th><th>Email</th><th>	Contact No</th><th>Reg. Date</th><th>Type</th><th>Gender</th><th>DOB</th><th>Flat Num</th><th>Take Action</th></tr>
			</thead>
			<tbody>
				<?php 
				$query1="select u.id,fullName,userEmail,contactNo,regDate,type,gender,dob,u.fid,f.block,f.flat_num from user_buffer u,flat f where u.fid=f.fid ORDER BY regDate DESC";
				$result=mysqli_query($con,$query1);

				if($result === FALSE) { 
				    die(mysql_error()); // TODO: better error handling
				}
				while($rows=$result->fetch_assoc())
				{
					?>
					<tr>
						<!-- <?php  //$id=$rows['catid']; ?> -->
						<td><?php echo $rows['fullName']; ?></td>						
						<td><?php echo $rows['userEmail']; ?></td>						
						<td><?php echo $rows['contactNo']; ?></td>						
						<td><?php echo $rows['regDate']; ?></td>						
						<td><?php echo $rows['type']; ?></td>												
						<td><?php echo $rows['gender']; ?></td>												
						<td><?php echo $rows['dob']; ?></td>																
						<td><?php echo ($rows['block']." - ".$rows['flat_num']); ?></td>																					
						<td><a href="user_reg.php?insert_users=<?php echo $rows['id']; ?>" class="btn btn-info btn_space" >Approved</a><a href="user_reg.php?id=<?php echo $rows['id']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" >Delete</a></td>
					</tr>	
					<?php 
				}
				?>
			</tbody>
		</table>    
		<!-- <CENTER><h1>User Registration</h1></CENTER>
		<form class="form-horizontal" name="user_reg" method="post" style="padding-left:5%">
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Full Name:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter Ful lName" name="fullName">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Email:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter email" name="userEmail">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Password:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter Password" name="password">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Contact No:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter Contact no" name="contactNo">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="email">User 	Type:</label>
				<div class="col-sm-7">
					<select class="form-control" id="sel1" name="type">
						<option>Select Option</option>
						<option value="admin">Admin</option>						
						<option value="user">User</option>						
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="email">Gender:</label>
				<div class="col-sm-7">
					<select class="form-control" id="sel1" name="gender">
						<option>Select Option</option>
						<option value="Male">Male</option>						
						<option value="Female">Female</option>						
					</select>
				</div>
			</div>	
			<div class="form-group row">
				<label class="control-label col-sm-3" for="email">Select Flat:</label>
				<div class="col-sm-7">
					<select class="form-control" id="sel1" name="flat">
						<option>Select Option</option>
						<?php
							//$result=mysqli_query($con,"select fid,block,flat_num from flat where uid IS NULL");						
							// $row=$result->fetch_assoc();	
							//while($row=mysqli_fetch_assoc($result)):; 	?>
								<option value="<?php// printf("%s",$row['fid']);  ?>"><?php// printf("%s",($row["block"]." - ".$row["flat_num"])); ?></option>
							<?php //endwhile;?>
					</select>
				</div>
			</div>	
			
			<div class="form-group row">        
				<div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
					<button type="reset" class="btn btn-primary">Reset</button>
                    <?php// $sql=mysqli_query($con,"select id from users order by id desc limit 1");
	//while($row1=mysqli_fetch_array($sql)){?>
                    <a href="addmember.php?uid=<?php// echo $row1['id'];?>" class="btn btn-primary" name="insert_user_reg" >submit</a>
                    <?php 
			//}
				?>
				</div>				
			</div>
		</form> -->

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>