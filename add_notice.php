<?php include('header.php'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">	
      	<center><h1>Notice</h1></center>
      	<form class="form-horizontal style-form" method="post" action="process.php" name="notice" >

									<div class="form-group">
										<label class="col-sm-2 col-sm-2 control-label">Title</label>
										<div class="col-sm-4">
											<input type="text" name="title" required="required" value="" required="" class="form-control">
										</div>

									</div>

									<div class="form-group">
										<label class="col-sm-2 col-sm-2 control-label">Description</label>
										<div class="col-sm-4">
											<textarea  name="descr" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
										</div>

									</div>									


									<div class="form-group">
										<div class="col-sm-10" style="padding-left:25% ">
											<button type="submit" name="submit_notice" class="btn btn-primary">Submit</button>
										</div>
									</div>

								</form>
      </div>
      </div>     
      </div>


<?php include('footer.php'); ?>