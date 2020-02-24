<?php include('header.php'); ?>
//html code without html tag
<!DOCTYPE html>
<html>

<head>
   
    <!-- Google Font: Source Sans Pro -->
    <!--link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"-->
 
    <title>
        Broadcast a Message
    </title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Bootstrap WYSIHTML5
                <small>Simple and fast</small>
              </h3>
              <!-- tools box -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <form action="messenger.php" method="POST">
            <div class="card-body pad">
              <div class="mb-3">
                <textarea class="textarea" placeholder="Place some text here" rows="10" name="message"></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-info">Sign in</button>
            </form>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
<!-- jQuery -->

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote();
  })
</script>

</body>



<?php include('footer.php'); ?>