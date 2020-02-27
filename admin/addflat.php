<?php include 'header.php'; 

if(isset($_POST['insert_user_reg']))
{
	$query="INSERT into flat(block,flat_num,area,BHK,floor_no,price) VALUES( '".$_POST["block"]."', '".$_POST["flat_num"]."', '".$_POST["area"]."', '".$_POST["BHK"]."','".$_POST["floor_no"]."', '".$_POST["price"]."')";
	$row=mysqli_query($con,$query);
	
//	$dummy=mysqli_insert_id($con);

	//echo "$dummy";

	//$query1="UPDATE flat SET fid = '".$dummy."' WHERE fid = '".$_POST["flat"]."'";
	//$row1=mysqli_query($con,$query1);
	// echo "$row";
	if(isset($row))
	{		
		echo "<script>alert('flat inserted');</script>";		
		//header('location:user_reg.php');	
	}else{
		die('Could not Insert: '. mysql_error());		
	}
}
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Add Flat Details</h1></CENTER>
		<form class="form-horizontal" name="user_reg" method="post" style="padding-left:5%">
			
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Block</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter Block" name="block">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Flat No.</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter Flat No" name="flat_num">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter area:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter area" name="area">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter BHK:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter BHK" name="BHK">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Floor No</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter floor number" name="floor_no">
				</div>
			</div>
			
			
			
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Price</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" placeholder="Enter price" name="price">
				</div>
			</div>
			
			
			
			
			
			
			
		<!--	<div class="form-group row">
				<label class="control-label col-sm-3" for="email">User 	BHK:</label>
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
			</div>	-
			<div class="form-group row">
				<label class="control-label col-sm-3" for="email">Select Flat:</label>
				<div class="col-sm-7">
					<select class="form-control" id="sel1" name="flat">
						<option>Select Option</option>
						<?php
							$result=mysqli_query($con,"select fid,block,flat_num from flat where uid IS NULL");						
							// $row=$result->fetch_assoc();	
							while($row=mysqli_fetch_assoc($result)):; 	?>
								<option value="<?php printf("%s",$row['fid']);  ?>"><?php printf("%s",($row["block"]." - ".$row["flat_num"])); ?></option>
							<?php endwhile;?>
					</select>
				</div>
			</div>	-->
			
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