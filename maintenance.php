<?php include 'header.php'; 


?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">
        
		<CENTER><h1>maintenance</h1></CENTER>
		<table class="table display" id="cattable" width="100%">
			<thead>
				<!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
				<tr><th>flat no</th><th>user id</th><th>generate bill</th></tr>
			</thead>
			<tbody>
				<?php 
				$query1="select fid,block,flat_num,uid from flat where uid IS NOT NULL";
				$result=mysqli_query($con,$query1);

				if($result === FALSE) { 
				    die(mysql_error()); // TODO: better error handling
				}
				while($rows=$result->fetch_assoc())
				{
					?>
					<tr>
						<!-- <?php  //$id=$rows['catid']; ?> -->
						<td><?php echo $rows['name']; ?></td>						
						<td><?php echo $rows['cno']; ?></td>						
						<td><?php echo $rows['email']; ?></td>						
						<td><?php echo $rows['fullName']; ?></td>						
						<td><?php echo $rows['time']; ?></td>												
						<!-- <td><a href="add_catspec.php?edit_cat=<?php //echo $rows['catid']; ?>" class="btn btn-info btn_space" >Edit</a><a href="add_catspec.php?delete_cat=<?php //echo $rows['catid']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" >Delete</a></td> -->
					</tr>	
					<?php 
				}
				?>
			</tbody>
		</table>    
			
                        
						<?php
							$result=mysqli_query($con,"select fid,block,flat_num,uid from flat where uid IS NOT NULL");						
							// $row=$result->fetch_assoc();	
							while($row=mysqli_fetch_assoc($result)):; 	?>
                            <tr>
                        <td><?php //printf("%s",$row['fid']);   
                        printf("%s",($row["block"]." - ".$row["flat_num"])); ?>
                            </td>
                        <td><?php printf("%s",$row['uid']);?></td>
                                <td><a href="maintain_details.php?uid=<?php echo $row['uid']; ?>" >bill</a></td>
                        </tr>
							<?php endwhile;?>
                        
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