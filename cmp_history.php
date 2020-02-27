<?php include('header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Your Complaint Hstory</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">

        
      	<div class="col-lg-12">
					<div class="content-panel">
						<section id="unseen">
							<table class="table table-bordered table-striped table-condensed display" id="cmphisttable" width="100%">
								<thead>
									<tr style="text-align: center">
										<th style="text-align: center">Complaint Number</th>
										<th style="text-align: center">Reg Date</th>
										<th style="text-align: center">last Updation date</th>
										<th style="text-align: center">Status</th>
										<th style="text-align: center">Action</th>

									</tr>
								</thead>
								<tbody>
									<?php $_SESSION['id']=2;
									$query=mysqli_query($con,"select * from tblcomplaints where userId='".$_SESSION['uid']."' ORDER BY regDate DESC");
									while($row=mysqli_fetch_array($query))
									{
										?>
										<tr>
											<td align="center"><?php echo htmlentities($row['complaintNumber']);?></td>
											<td align="center"><?php echo htmlentities($row['regDate']);?></td>
											<td align="center"><?php echo  htmlentities($row['lastUpdationDate']);

											?></td>
											<td align="center"><?php 
											$status=$row['status'];
											if($status=="" or $status=="NULL")
												{ ?>
													<button type="button" class="btn btn-theme04">Not Process Yet</button>
												<?php }
												if($status=="in process"){ ?>
													<button type="button" class="btn btn-warning">In Process</button>
												<?php }
												if($status=="closed") {
													?>
													<button type="button" class="btn btn-success">Closed</button>
												<?php } ?>
												<td align="center">
													<a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']);?>">
														<button type="button" class="btn btn-primary">View Details</button></a>
													</td>
												</tr>
											<?php } ?>

										</tbody>
									</table>
								</section>
							</div><!-- /content-panel -->
						</div><!-- /col-lg-4 -->			
					</div><!-- /row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include('footer.php'); ?>
<script type="text/javascript">
	$(document).ready( function () {
		$('#cmphisttable').DataTable({			        
				
			buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'  ],
			dom: 'lBfrtip',
			"lengthChange": true
		});
	});
</script>