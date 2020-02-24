<?php include('header.php'); ?>

<section id="container" >

	<section id="main-content">
		<section class="wrapper">
			<h3><i class="fa fa-angle-right"></i> Register Complaint</h3>

			<!-- BASIC FORM ELELEMNTS -->
			<div class="row mt">
				<div class="col-lg-12">
					<div class="form-panel">					
								<form class="form-horizontal style-form" method="post" action="process.php" name="complaint" enctype="multipart/form-data" >

									<div class="form-group">
										<label class="col-sm-2 col-sm-2 control-label">Category</label>
										<div class="col-sm-4">
											<select name="category" id="category" class="form-control" onChange="getCat(this.value);" required="">
												<option value="">Select Category</option>
												<?php $sql=mysqli_query($con,"select id,categoryName from category ");
												while ($rw=mysqli_fetch_array($sql)) {
													?>
													<option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['categoryName']);?></option>
													<?php 
												}
												?>
											</select>
										</div>

									</div>

									<div class="form-group">
										<label class="col-sm-2 col-sm-2 control-label">title of Complaint</label>
										<div class="col-sm-4">
											<input type="text" name="noc" required="required" value="" required="" class="form-control">
										</div>

									</div>

									<div class="form-group">
										<label class="col-sm-2 col-sm-2 control-label">Complaint Details (max 2000 words) </label>
										<div class="col-sm-6">
											<textarea  name="complaindetails" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
										</div>
									</div>
									


									<div class="form-group">
										<div class="col-sm-10" style="padding-left:25% ">
											<button type="submit" name="submit" class="btn btn-primary">Submit</button>
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>



				</section>
			</section>

		</section>

		<?php include('footer.php'); ?>