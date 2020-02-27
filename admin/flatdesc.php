<?php include 'header.php'; 

if(isset($_POST['insert_user_reg']))
{
	$query="update flat set uid='".$_POST['user']."' where fid='".$_POST['flat']."'";
	$row=mysqli_query($con,$query);

	if(isset($row))
	{		
		echo "<script>alert('Flat allocated successfully');</script>";			
	}else{
		die('Could not Insert: '. mysql_error());		
	}
}
?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">

		<CENTER><h1>Decription of Flats</h1></CENTER>
		<form class="form-horizontal" name="user_reg" method="post" style="padding-left:5%">
				
				<div class="form-group row">
				<label class="control-label col-sm-3" for="email">Unoccupied Flats</label>
				<div class="col-sm-7">
					<select class="form-control" id="flat" name="flat">
						<option>Select Option</option>
						<?php
							$result=mysqli_query($con,"select fid,block,flat_num from flat where uid IS NULL");						
							// $row=$result->fetch_assoc();	
							while($row=mysqli_fetch_assoc($result)):; 	?>
								<option value="<?php printf("%s",$row['fid']); ?>"><?php printf("%s",($row["block"]." - ".$row["flat_num"])); ?></option>
							<?php endwhile;?>
					</select>
				</div>
			</div>
				
				<!--$result=mysqli_query($con,"select fullname from users,flat where users.id!=flat.uid");-->						
				
			
				<div class="form-group row">
				<label class="control-label col-sm-3" for="email">Unoccupied Users</label>
				<div class="col-sm-7">
					<select class="form-control" id="user" name="user">
						<option>Select Option</option>
						<?php
							//$result=mysqli_query($con,"select fid,block,flat_num from flat where uid IS NULL");						
							// $row=$result->fetch_assoc();	
							$result=mysqli_query($con,"select id,fullName from users where id not in(select uid from flat where uid IS NOT NULL)");						
							while($row=mysqli_fetch_assoc($result)):; 	?>
								<option value="<?php printf("%s",$row['id']);?>"><?php printf("%s",$row['fullName']);?></option>
							<?php endwhile;?>
					</select>
				</div>
			</div>
			
			
			<div class="form-group row">        
				<div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
					<button type="submit" class="btn btn-primary " name="insert_user_reg">Submit</button>
				</div>				
			</div>
		</form>

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>