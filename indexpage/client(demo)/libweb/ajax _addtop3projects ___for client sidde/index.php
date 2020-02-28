<html>
 <head>
  <title>Live Add Edit Delete Datatables Records using PHP Ajax</title>
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
   <h1 align="center">Top 3 Projects Details</h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
<!--     <button type="button" name="add" id="add" class="btn btn-info">Add</button>-->
    </div>
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Sr.</th>
       <th>Department</th>
       <th>ProjectDefinationRank 1</th>
       <th>StudentName 1</th>
       <th>Erno 1</th>
       <th>ProjectDefinationRank 2</th>
       <th>StudentName 2</th>
       <th>Erno 2</th>
       <th>ProjectDefinationRank 3</th>
       <th>StudentName 3</th>
       <th>Erno 3</th>
      
       <th>Year</th>
	   
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
// --------------------------------------------------------------------------------------------------------  
 /*function update_data(id, column_name, value)
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
   html += '<td contenteditable id="data10"></td>';
   html += '<td contenteditable id="dat11"></td>';
   html += '<td contenteditable id="data12"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var sr = $('#data1').text();
   var department = $('#data2').text();
   var projectdefinationrank1 = $('#data3').text();
   var studentname1 = $('#data4').text();
   var erno1 = $('#data5').text();
   var projectdefinationrank2 = $('#data6').text();
   var studentname2 = $('#data7').text();
   var erno2 = $('#data8').text();
   var projectdefinationrank3 = $('#data9').text();
   var studentname3 = $('#data10').text();
   var erno3 = $('#data11').text();
   var year = $('#data12').text();
   
   if(department != '' )
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{sr:sr, department:department, projectdefinationrank1:projectdefinationrank1 ,studentname1:studentname1 ,erno1:erno1,projectdefinationrank2:projectdefinationrank2,studentname2:studentname2,erno2:erno2,projectdefinationrank3:projectdefinationrank3,studentname3:studentname3,erno3:erno3,year},
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
 
 ---------------------------------------------------------------*/
</script>
