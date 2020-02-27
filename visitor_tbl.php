<?php include 'header.php'; ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Visitor History</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">

        <table class="table display" id="cattable" width="100%">
			<thead>
				<!-- <tr style="text-align: center;"><th colspan="5"><h2>Flat Allotment List</h2></th></tr> -->
				<tr><th>Visitor Name</th><th>Visitor Contact No.</th><th>Visitor Email</th><th>House Owner Name</th><th>Time</th></tr>
			</thead>
			<tbody>
				<?php 
				$query1="select fullName,id,vid,name,cno,email,ref,time from users,visitor where id=ref ";
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
        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php include 'footer.php'; ?>