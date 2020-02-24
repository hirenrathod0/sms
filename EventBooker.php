<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Book An Event</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!--link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"-->
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Theme style -->
    <!--link rel="stylesheet" href="../../dist/css/adminlte.min.css"-->
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">

    
</head>
<body>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6 ">
            <!-- general form elements -->
            <div class="card card-primary">   
            <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Your ID</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Example AB101">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Jon Snow">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Event Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Birthday Party">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Place</label>
                                <select class="form-control select2"  style="width: 100%;">
                                    <option selected="selected">Large Hall</option>
                                    <option>Small Hall</option>
                                    <option>Club House</option>
                                    <option>Common Plot</option>
                                    <option>Garden</option>
                                    <option>Terrace</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>About this event</label>
                        <textarea class="form-control" rows="3" placeholder="Birthday party on Jon's 5th BirthDay"></textarea>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Date range -->
                                <div class="form-group">
                                    <label>Date range:</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation">
                                    </div>
                  <!-- /.input group -->
                                </div>
                <!-- /.form group -->
                        </div>
                        <div class="col-md-3">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker"/>
                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                    <!-- /.form group -->
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>End Time:</label>
                                    <div class="input-group date" id="timepicker1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker1"/>
                                        <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                    <!-- /.form group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div class="card-footer">
                                <button type="Reset" class="btn btn-primary">Reset</button>
                            </div>
                        </div>
                    </div>



                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
</section>
    
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>



<script>
    
$(function (){
  //Date range picker
  $('#reservation').daterangepicker()
      
  
    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    //Timepicker
    $('#timepicker1').datetimepicker({
      format: 'LT'
    })
})


</script>

</body>
</html>