<html>
 <head>
  <title>Staff</title>
  <script src="jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css" />
  <script rel="stylesheet" src="bootstrap_min.css"></script>
  <script src="bmj.js"></script>
  <link rel="stylesheet" href="bootstrap-datepicker.css" />
  <script src="bootstrap-datepicker.js"></script>
  <script src="jquery_dataTables.js"></script>
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  </style>
 </head>
 <body>
  <div class="container box">
   <h1 align="center"> Staff</h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
    </div>
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       
       <th>Staff Id</th>
       <th>Staff Name</th>
       <th>Address</th>
       <th>Contact NO</th>
       <th>Birthdate</th>
       <th>Date Of Joining</th>
       <th>Designation</th>
       <th>Aadhar Card NO</th>
       <th>Passbook No</th>
	   
       <th></th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
 </body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td contenteditable id="data5"></td>';
   html += '<td contenteditable id="data6"></td>';
   html += '<td contenteditable id="data7"></td>';
   html += '<td contenteditable id="data8"></td>';
   html += '<td contenteditable id="data9"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var staffid = $('#data1').text();
   var staffname = $('#data2').text();
   var address = $('#data3').text();
   var contactno = $('#data4').text();
   var birthdate = $('#data5').text();
   var dateofjoining = $('#data6').text();
   var designation = $('#data7').text();
   var aadharcard = $('#data8').text();
   var passbookno = $('#data9').text();
   if(staffname != '' )
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{staffid:staffid, staffname:staffname ,address:address,contactno:contactno,birthdate:birthdate,dateofjoining:dateofjoining,designation:designation ,aadharcard:aadharcard,passbookno:passbookno},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
 
 //$columns = array('staffid', 'staffname', 'address' ,'contactno', 'birthdate', 'dateofjoining','designation','aadharcard' ,'passbookno');
</script>