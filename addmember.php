<?php include 'header.php';
if(isset($_POST['insert_user_reg']))
{
	$query="INSERT into member_detail(name,birthdate,gender,uid) VALUES('".$_POST["fullName"]."', '".$_POST["bdate"]."', '".$_POST["gender"]."',".$_SESSION['uid'].")";
	$row=mysqli_query($con,$query);
	
	if(isset($row))
	{		
		echo "<script>alert($query);</script>";		
		//header('location:user_reg.php');	
	}else{
		//die('Could not Insert: '. mysql_error());		
	}
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
					<input type="text" class="form-control" id="email" placeholder="Enter Full lName" name="fullName">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">birth date:</label>
				<div class="col-sm-7">
					<input type="date" class="form-control" id="email" placeholder="Enter birth date" name="bdate">
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
				<div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
					<button type="submit" class="btn btn-primary " name="insert_user_reg">Submit</button>
					<button type="reset" class="btn btn-primary">Reset</button>

                    
				</div>				
			</div>
		</form>

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>