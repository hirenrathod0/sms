<?php include 'header.php'; ?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>User Registration</h1></CENTER>
		<form class="form-horizontal" name="user_reg" method="post" action="process.php">
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Full Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" placeholder="Enter Ful lName" name="fullName">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Email:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" placeholder="Enter email" name="userEmail">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Password:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" placeholder="Enter Password" name="password">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="">Enter Contact No:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" placeholder="Enter Contact no" name="contactNo">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="email">User 	Type:</label>
				<div class="col-sm-9">
					<select class="form-control" id="sel1" name="type">
						<option>Select Option</option>
						<option value="admin">Admin</option>						
						<option value="user">User</option>						
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-3" for="email">Gender:</label>
				<div class="col-sm-9">
					<select class="form-control" id="sel1" name="gender">
						<option>Select Option</option>
						<option value="male">Male</option>						
						<option value="female">Female</option>						
					</select>
				</div>
			</div>	
			<div class="form-group row">
				<label class="control-label col-sm-3" for="email">Select Flat:</label>
				<div class="col-sm-9">
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
			</div>	
			
			<div class="form-group row">        
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="dt-button buttons-copy buttons-html5 " name="insert_user_reg">Submit</button>
					<button type="reset" class="dt-button buttons-copy buttons-html5">Reset</button>
				</div>				
			</div>
		</form>

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>