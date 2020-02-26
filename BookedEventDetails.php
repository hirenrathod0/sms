<?php
include('header.php');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-lg">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Event Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modalbody">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <?php
  include('footer.php')
  ?>
  
  <!-- Page specific script -->
<script>
  $(function () {
//Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      //Random default events
      events    : 'dbservices/eventbooking/load.php',
      editable  : false,
      droppable : false, // this allows things to be dropped onto the calendar !!!
      eventClick: function(info){
                  

            var myobj = {
              bookingid: info.event.id            
            };
            
            $.ajax({
            type: "POST",
            url: 'dbservices/eventbooking/eventDetails.php',
            data: myobj,
            success: function(data)
                {
                    //alert(data);
                    var arr = data.split(',');
                    var title = arr[0];
                    var details = arr[1];
                    var start = arr[2];
                    var end = arr[3];
                    var place = arr[4];                
                
                    var newdata = 
                    title + "<br>" +
                    "<em>" + details + "</em><br>" +
                    "on Date: " + start.substr(0,10) + "<br>" +
                    "Starts at " + start.substr(11,5) + "<br>" +
                    "Ends at " + end.substr(11,5) + "<br>" +
                    "Venue " + place;

                    document.getElementById('modalbody').innerHTML = newdata;
                }
            })

        $("#modal-lg").modal('show');
      }  
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    
  })
</script>
