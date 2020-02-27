<?php include 'header.php'; ?>
  <div class="content-wrapper">
 <section class="content-header">
      <div class="container-fluid">

        <table class="table display" id="cattable" width="100%">
			<thead>
				<tr style="text-align: center;"><th colspan="7"><h2>Event Booking List</h2></th></tr>
				<tr><th>User Name</th><th>Start Time</th><th>End Time</th><th>Place</th><th>Function Title</th><th>Function Details</th><th>Action</th></tr>
			</thead>
			<tbody>
				<?php 
				$query1="select fullName,id,booking_id,mem_id,start_time,end_time,place,fun_details,fun_title from users u,booking f where id=mem_id ORDER BY start_time DESC";
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
						<td><?php echo $rows['start_time']; ?></td>						
						<td><?php echo $rows['end_time']; ?></td>						
						<td><?php echo $rows['fun_title']; ?></td>						
						<td><?php echo $rows['fun_details']; ?></td>						
						<td><?php echo $rows['place']; ?></td>						
						<td><!-- <a href="add_labcabin.php?edit_lab=<?php //echo $rows['labno']; ?>" class="btn btn-info btn_space" >Edit</a> --><a href="event_book_tbl.php?delete_event=<?php echo $rows['booking_id']; ?>" onclick="return confirm('Are you Sure?');" class="btn btn-danger">Delete</a></td>	
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
	if(isset($_GET['delete_event']))
	{ 	
		$id=$_GET['delete_event'];
		// echo "$id";
		// echo "<script>alert('".$_GET['delete_lab']."');</script>";

		$row=mysqli_query($con,"delete from booking where booking_id = '".$id."'");

		if(isset($row))
		{
			echo "<script>alert('Event is deleted'); location.href='event_book_tbl.php'</script>";

		}else{
			die('Could not Delete: '. mysql_error());		
		}

	}
	?>
<?php include 'footer.php'; ?>