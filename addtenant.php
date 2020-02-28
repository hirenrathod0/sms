<?php include 'header.php'; 

if(isset($_POST['insert_user_reg']))
{
	$query="INSERT into users(fullName,userEmail,password,contactNo,type,gender) VALUES('".$_POST["fullName"]."', '".$_POST["userEmail"]."', '".$_POST["password"]."', '".$_POST["contactNo"]."', '".$_POST["type"]."', '".$_POST["gender"]."')";
	$row=mysqli_query($con,$query);
	
	$dummy=mysqli_insert_id($con);

	//echo "$dummy";

	$query1="UPDATE flat SET uid = '".$dummy."' WHERE fid = '".$_POST["flat"]."'";
	$row1=mysqli_query($con,$query1);
	// echo "$row";
	if(isset($row) && isset($row1))
	{		
		echo "<script>alert($dummy);</script>";		
		//header('location:user_reg.php');	
	}else{
		die('Could not Insert: '. mysql_error());		
	}
}
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Tenant Registration</h1></CENTER>
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
						<option value="tenant" selected>tenant</option>						
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
							$result=mysqli_query($con,"select fid,block,flat_num from flat where uid=".$_SESSION['uid']."");						
							// $row=$result->fetch_assoc();	
							while($row=mysqli_fetch_assoc($result)):; 	?>
								<option value="<?php printf("%s",$row['fid']);  ?>"><?php printf("%s",($row["block"]." - ".$row["flat_num"])); ?></option>
							<?php endwhile;?>
					</select>
				</div>
			</div>	
			
			<div class="form-group row">        
				<div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
					<button type="reset" class="btn btn-primary">Reset</button>
                    <?php $sql=mysqli_query($con,"select id from users order by id desc limit 1");
	while($row1=mysqli_fetch_array($sql)){?>
                    <a href="addmember.php?uid=<?php echo $row1['id'];?>" class="btn btn-primary" name="insert_user_reg" >submit</a>
                    <?php 
				}
				?>
				</div>				
			</div>
		</form>

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>