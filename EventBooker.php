<?php
include('header.php');
?>

<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-9 ">
            <!-- general form elements -->
            <div class="card card-primary">   
            <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="event" action="" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="userid">Your ID</label>    
                                <input type="text" class="form-control" id="userid" placeholder="Example AB101">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="username">Name</label>
                                <input type="text" class="form-control" id="username" placeholder="Jon Snow">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Event Title</label>
                                <input type="text" class="form-control" id="eventtitle" placeholder="Birthday Party">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Place</label>
                                <select class="form-control select2"  style="width: 100%;"  id="place">
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
                        <textarea class="form-control" rows="3" placeholder="Birthday party on Jon's 5th BirthDay" id="eventdetails"></textarea>
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
                                        <input type="text" class="form-control float-right" id="reservation" placeholder="new date">
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
                                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker"  id="start" />
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
                                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker1" id="end"  />
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
                                <button type="button" class="btn btn-primary" onclick="SubmitEvent()">Submit</button>
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
</div>    


<?php
include('footer.php');
?>

<script>
    
$(function (){
  //Date range picker
  $('#reservation').daterangepicker({
      minDate: new Date()
  })
      
  
    //Timepicker
    $('#timepicker').datetimepicker({
        format: 'LT'
    })
    //Timepicker
    $('#timepicker1').datetimepicker({
      format: 'LT'
    })
})

function formatchanger(dd)
{
    var time = dd;
    var hours = Number(time.match(/^(\d+)/)[1]);
    var minutes = Number(time.match(/:(\d+)/)[1]);
    var AMPM = time.match(/\s(.*)$/)[1];
    if(AMPM == "PM" && hours<12) hours = hours+12;
    if(AMPM == "AM" && hours==12) hours = hours-12;
    var sHours = hours.toString();
    var sMinutes = minutes.toString();
    if(hours<10) sHours = "0" + sHours;
    if(minutes<10) sMinutes = "0" + sMinutes;
    return sHours + ":" + sMinutes;
}

function SubmitEvent()
{
    var id = document.getElementById('userid').value;
    var name = document.getElementById('userid').value;
    var title = document.getElementById('eventtitle').value;
    var date = document.getElementById('reservation').value;
    var starttime = document.getElementById('start').value;
    var endtime = document.getElementById('end').value;
    var details = document.getElementById('eventdetails').value;
    var place = document.getElementById('place').value;
    var status = true;
//not null constraints
    if(id.length == 0 || name.length == 0 || title.length == 0)
    {
        //status=false;
    }
//fetching startdate enddate from date
    var datearr = date.split(' - ');
    var startdate = new Date(datearr[0].trim());
    var enddate = new Date(datearr[1].trim());
    var cd = new Date();
    
    starttime = formatchanger(starttime);
    endtime = formatchanger(endtime);
    
    if(status == true)
    {
        var myobj = {
            memid: '1',
            dayofbooking: cd.getFullYear() + "-" + (cd.getMonth() + 1) + "-" + cd.getDate() + " " + cd.getHours() + ":" + cd.getMinutes() +":" + cd.getSeconds(),
            place: place,
            title: title,
            details: details,
            starttime: startdate.getFullYear() + "-" + (startdate.getMonth() + 1) + "-" + startdate.getDate() + " " + starttime + ":00",
            endtime: enddate.getFullYear() + "-" + (enddate.getMonth() + 1) + "-" + enddate.getDate() + " " + endtime + ":00"
        };

        $.ajax({
           type: "POST",
           url: 'dbservices/eventbooking/insert.php',
           data: myobj,
           success: function(data)
           {
               // alert(data);
               if (data) {
                alert("Event Booked");
               } else {
                alert("Not inserted");
               }
           }
         });
        
    }
}
</script>
