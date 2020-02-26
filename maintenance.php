<?php include 'header.php'; 


?>
  <div class="content-wrapper">

<section class="content-header">
	<div class="container-fluid">
        
		<CENTER><h1>maintenance</h1></CENTER>
		<form class="form-horizontal" name="user_reg" method="post" style="padding-left:5%" action="maintain_details.php">
            <div class="form-group row">
				<label class="control-label col-sm-3" for="email">Select Flat:</label>
				<div class="col-sm-7">
					<table border="2" align="center" width="50%" >
		<tr>
			<th>flat no</th>
            <th>user id</th>
            <th>generate bill</th>
        </tr>
                        
						<?php
							$result=mysqli_query($con,"select fid,block,flat_num,uid from flat where uid IS NOT NULL");						
							// $row=$result->fetch_assoc();	
							while($row=mysqli_fetch_assoc($result)):; 	?>
                            <tr>
                        <td><?php printf("%s",$row['fid']);  ?>"><?php printf("%s",($row["block"]." - ".$row["flat_num"])); ?>
                            </td>
                        <td><?php printf("%s",$row['uid']);?></td>
                                <td><a href="maintain_details.php?uid=<?php echo $row['uid']; ?>" >bill</a></td>
                        </tr>
							<?php endwhile;?>
                        
                    </table>
				
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