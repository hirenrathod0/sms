<?php include 'header.php';
	$query="select * from member_detail where mid='".$_REQUEST['mid']."'";
	$r=mysqli_query($con,$query);
	$row = mysqli_fetch_array($r);	
	if(isset($row))
	{		
		echo "<script>alert($query);</script>";		
		//header('location:user_reg.php');	
	}



?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Add members detalis</h1></CENTER>
		<form class="form-horizontal" name="user_reg" method="post" style="padding-left:5%">
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Full Name:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" value="<?php echo $row['name'];?>" name="fullName"/>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">birth date:</label>
				<div class="col-sm-7">
					<input type="date" class="form-control" id="email" value="<?php echo $row['birthdate'];?>" name="bdate">
				</div>
			</div>
            <div class="form-group row">
				<label class="control-label col-sm-3" for="">gender:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" value="<?php echo $row['gender'];?>" name="gender">
				</div>
			</div>
			
				
			
			<div class="form-group row">        
				<div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
					<button type="submit" class="btn btn-primary " name="insert_user_reg">Submit</button>
                    <a href="user_reg.php" class="btn btn-primary " name="bill_id" >complete</a>
                    
				</div>				
			</div>
		</form>

	</div><!-- /.container-fluid -->
</section>
</div>
<?php 
if(isset($_POST['insert_user_reg']))
{
	$tn = $_POST['fullName'];
	$plc = $_POST['bdate'];
	$nos = $_POST['gender'];
		$qur=mysqli_query($con,"update member_detail set name='".$tn."',birthdate='".$plc."',gender='".$nos."' where mid='".$_REQUEST['mid']."'");
        //header("location:home.php");
    
	//header('location:memberview.php');
}
	
              include 'footer.php'; ?>