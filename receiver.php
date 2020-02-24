
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">    
    <!-- Google Font: Source Sans Pro -->
    <!--link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"-->
 
    <title>
        View The Notices
    </title>
</head>
<body>
<section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Admin Messages
                <small>Simple and fast</small>
              </h3>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->

          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
      <div class="row">
          <div class="col-md-6">
                <div id="msg_box"></div>              
          </div>
      </div>
    </section>
    <!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function(){
            alert('1');
            var msgbox = document.getElementById('msg_box');
            alert('12');
            $.ajax({
                url     : "getmessage.php",
                type    : "POST",
                success : function(data)
                {
                    alert('123');
                    msgbox.innerHTML = data;
                    alert('1234');
                }
            })

        })


    </script>

</body>
</html>