<?php include 'header.php'; 
if(isset($_POST['insert_user_reg']))
{
	$query="INSERT into maintenance_bill(fid,bill_date,water_charges,property_tax,elec_charges,parking_charges,other,due_date,flat_charges) VALUES('".$_REQUEST['uid']."','".$_POST["bill_date"]."', '".$_POST["water_charges"]."', '".$_POST["property_tax"]."', '".$_POST["elec_charges"]."', '".$_POST["parking_charges"]."', '".$_POST["other"]."','".$_POST["due_date"]."','".$_POST["flat_charges"]."')";
	$row=mysqli_query($con,$query);
	
	$sql=mysqli_query($con,"select * from maintenance_bill order by bid desc limit 1");
	while($row1=mysqli_fetch_array($sql))
	{
		$billid=$row1['bid'];
		$totall=$row1['property_tax']+$row1['water_charges']+$row1['flat_charges']+$row1['parking_charges']+$row1['other']+$row1['elec_charges'];
	}
	
	// echo "$dummy";

	//$query1="UPDATE flat SET uid = '".$dummy."' WHERE fid = '".$_POST["flat"]."'";
	//$row1=mysqli_query($con,$query1);
	// echo "$row";
	if(isset($row))
	{		
		// echo "<script>alert('Bill Generated');</script>";		
	echo "<script> alert('Bill Generated Total Charges ".$totall." Rs.'); location.href='bill_detail.php?bill_no=".$billid."&total=".$totall."';</script>";

		//header('location:user_reg.php');	
	}else{
		//die('Could not Insert: '. mysql_error());		
	}
}

?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Maintenance Details</h1></CENTER>
		<form class="form-horizontal" name="user_reg" method="post" style="padding-left:5%">
			<div class="form-group row">
                <?php $row = mysqli_fetch_array(mysqli_query($con,"select * from users where id='".$_REQUEST['uid']."'"));	?>
				<label class="control-label col-sm-3" for="">Full Name:</label>
				<div class="col-sm-7">
                    <input type="text" class="form-control" id="email" name="fullName" value="<?php echo $row['fullName'];?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Email:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email"  name="userEmail" value="<?php echo $row['userEmail'];?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for=""> Contact No:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" name="contactNo"value="<?php echo $row['contactNo'];?>" />
				</div>
            </div>
				<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter billdate:</label>
				<div class="col-sm-7">
					<input type="date" class="form-control" id="email" name="bill_date">
				</div>
            </div>
                    <div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter water charges:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" name="water_charges">
				</div>
            </div>
			  <div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter property tax:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" name="property_tax">
				</div>
            </div>
            <div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter flat charges:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" name="flat_charges">
				</div>
            </div>
			  <div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter electric charge:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" name="elec_charges">
				</div>
            </div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter parking charges:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" name="parking_charges">
				</div>
            </div>
            <div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter other charges:</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" name="other">
				</div>
            </div>
            <div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter due date:</label>
				<div class="col-sm-7">
					<input type="date" class="form-control" id="email" name="due_date">
				</div>
            </div>
			
			
			<div class="form-group row">        
				<div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
					<button type="submit" class="btn btn-primary " name="insert_user_reg">Submit</button>
					<button type="reset" class="btn btn-primary">Reset</button>
                    <input type="sumit" class="btn btn-primary" name="bill_id" onClick="location.href='viewbill.php'" value='view bills'>
				</div>				
			</div>
            
		</form>

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>