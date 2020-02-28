<?php include 'header.php'; ?>
  <div class="content-wrapper">
 
 <section class="content-header">
      <div class="container-fluid">

    	<table class="table display" id="flat_allot_tbl" width="100%">
			<thead>
				<tr style="text-align: center;"><th colspan="11"><h2>Flat Allotment List</h2></th></tr>
				<tr><th>User Name</th><th>Contact No</th><th>Gender</th><th>DOB</th><th>Area</th><th>BHK</th><th>price</th><th>Block</th><th>Floor No.</th><th>Flat No.</th><th>Action</th></tr>
			</thead>
			<tbody>
				<?php 
				$query1="select fullName,id,contactNo,gender,dob,fid,area,BHK,price,block,flat_num,floor_no,uid from users u,flat f where id=uid ";
				$result=mysqli_query($con,$query1);

				if($result === FALSE) { 
				    die(mysql_error()); // TODO: better error handling
				}
				while($rows=$result->fetch_assoc())
				{
					?>
					<tr>
						<!-- <?php  //$id=$rows['catid']; ?> -->
						<td><?php echo $rows['fullName']; ?></td>						
						<td><?php echo $rows['contactNo']; ?></td>						
						<td><?php echo $rows['gender']; ?></td>						
						<td><?php echo $rows['dob']; ?></td>						
						<td><?php echo $rows['area']; ?></td>						
						<td><?php echo $rows['BHK']; ?></td>						
						<td><?php echo $rows['price']; ?></td>						

						<td><?php echo $rows['block']; ?></td>						
						<td><?php echo $rows['floor_no']; ?></td>						
						<td><?php echo $rows['flat_num']; ?></td>						
						<td><!-- <a href="add_labcabin.php?edit_lab=<?php //echo $rows['labno']; ?>" class="btn btn-info btn_space" >Edit</a> --><a href="flat_allot_tbl.php?delete_flat_allot=<?php echo $rows['fid']; ?>" onclick="return confirm('Are you Sure?');" class="btn btn-danger">Delete</a></td>	
						<!-- <td><a href="add_catspec.php?edit_cat=<?php //echo $rows['catid']; ?>" class="btn btn-info btn_space" >Edit</a><a href="add_catspec.php?delete_cat=<?php //echo $rows['catid']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" >Delete</a></td> -->
					</tr>	
					<?php 
				}
				?>
			</tbody>
		</table>    


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php 
	if(isset($_GET['delete_flat_allot']))
	{ 	
		$id=$_GET['delete_flat_allot'];
		// echo "$id";
		// echo "<script>alert('".$_GET['delete_lab']."');</script>";

		$row=mysqli_query($con,"update flat set uid=NULL where fid = '".$id."'");

		if(isset($row))
		{
			echo "<script>alert('Deallotment is Done'); location.href='flat_allot_tbl.php'</script>";

		}else{
			die('Could not Delete: '. mysql_error());		
		}

	}
	?>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$(document).ready( function () {
		$('#flat_allot_tbl').DataTable({			        
			"aoColumns": [                    
			null,
			null,			
			null,			
			null,			
			{ "bSortable": false,"bSearchable": false}                                      
			],	
			buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'  ],
			dom: 'lBfrtip',
			"lengthChange": true
		});
	});
</script>