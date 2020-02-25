<?php include('header.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Register Complaint</h1>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">

        
        
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


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer.php') ?>

