<?php include 'header.php'; 


?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">
        
		<CENTER><h1>maintenance</h1></CENTER>
		<table class="table display" id="cattable" width="100%">
			<thead>
				<!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
				<tr><th>flat no</th><th>user id</th><th>generate bill</th><th>view bill</th></tr>
			</thead>
			<tbody>
				<?php 
				$query1="select fullName,fid,block,flat_num,uid from flat,users where uid IS NOT NULL && uid=id";
				$result=mysqli_query($con,$query1);

				if($result === FALSE) { 
				    die(mysql_error()); // TODO: better error handling
				}
				while($rows=$result->fetch_assoc())
				{
					?>
					<tr>
						<!-- <?php  //$id=$rows['catid']; ?> -->
						<td><?php echo (($rows["block"]." - ".$rows["flat_num"])); ?></td>											
						<td><?php echo $rows['fullName']; ?></td>						
						<td><a href="maintain_details.php?uid=<?php echo $rows['uid']; ?>" >bill</a></td>
						<td><a href="viewbill1.php?uid=<?php echo $rows['uid']; ?>" >View</a></td>
					</tr>	
					<?php 
				}
				?>
			</tbody>
		</table>    
			
                        
					
				
				</div>
			</div>	
			
			<!-- <div class="form-group row">        
				<div class="col-sm-offset-3 col-sm-9" style="padding-left:26% ">
					<button type="submit" class="btn btn-primary " name="insert_user_reg">Submit</button>
					<button type="reset" class="btn btn-primary">Reset</button>
				</div>				
			</div> -->
		</form>

	</div><!-- /.container-fluid -->
</section>
</div>
<?php include 'footer.php'; ?>