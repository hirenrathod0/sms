<?php include('header.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Add Category</h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid" style="padding-left: 3%">

			<form class="form-horizontal" name="category"  method="post" action="process.php">
				<input type="hidden"  name="catid" value="" >
				<div class="form-group row">
					<label class="control-label col-sm-2" for="email">Category Name:</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" value="" id="categoryn" required placeholder="Enter Category name" name="categoryname">
					</div>
				</div>      

				<div class="form-group row">        
					<div class="col-sm-9 col-sm-offset-3" style="padding-left: 17% ">

						<button type="submit" class="btn btn-primary" id="catsubmit" name="insert_category">Submit</button>

						<button type="reset" class="btn btn-primary">Reset</button>
					</div>        
				</div>
			</form>


		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('footer.php') ?>

