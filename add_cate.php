
<?php include('header.php'); ?>
<div class="container">		
		<form class="form-horizontal" name="category"  method="post" action="process.php">
		<h1>Add Category</h1>
			<input type="hidden"  name="catid" value="" >
			<div class="form-group row">
				<label class="control-label col-sm-3" for="email">Category Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" value="" id="categoryn" required placeholder="Enter Category name" name="categoryname">
				</div>
			</div>			

			<div class="form-group row">        
				<div class="col-sm-9 col-sm-offset-3">
					
					<button type="submit" class="dt-button buttons-copy buttons-html5" id="catsubmit" name="insert_category">Submit</button>

					<button type="reset" class="dt-button buttons-copy buttons-html5">Reset</button>
				</div>				
			</div>
		</form>
	</div>
<?php include('footer.php'); ?>