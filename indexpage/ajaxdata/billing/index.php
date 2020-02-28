<html>
 <head>
  <title>billing</title>
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
   <h1 align="center"> Billing</h1>
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
       
       <th>Bill Id</th>
       <th>Invoice date</th>
       <th>Invoice NO</th>
       <th>Reverse Charge</th>
       <th>State</th>
       <th>City Code</th>
       <th>Client Name</th>
       <th>Client Address</th>
       <th>Gstn Id</th>
       <th>Gstn State</th>
       <th>Gstn CityCOde</th>
       <th>Product</th>
       <th>Product desc</th>
       <th>Price</th>
       <th>Loads</th>
       <th>Total Item</th>
       <th>Total Loads</th>
       <th>Total Price</th>
       
	   
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
   html += '<td contenteditable id="data10"></td>';
   html += '<td contenteditable id="data11"></td>';
   html += '<td contenteditable id="data12"></td>';
   html += '<td contenteditable id="data13"></td>';
   html += '<td contenteditable id="data14"></td>';
   html += '<td contenteditable id="data15"></td>';
   html += '<td contenteditable id="data16"></td>';
   html += '<td contenteditable id="data17"></td>';
   html += '<td contenteditable id="data18"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var billid = $('#data1').text();
   var invoicedate = $('#data2').text();
   var invoiceno = $('#data3').text();
   var reversecharge = $('#data4').text();
   var state = $('#data5').text();
   var citycode = $('#data6').text();
   var clientname = $('#data7').text();
   var clientaddress = $('#data8').text();
   var gstnid = $('#data9').text();
   var gstnstate = $('#data10').text();
   var gstncitycode = $('#data11').text();
   var product = $('#data12').text();
   var productdesc = $('#data13').text();
   var price = $('#data14').text();
   var loads = $('#data15').text();
   var totalitem = $('#data16').text();
   var totalloads = $('#data17').text();
   var totalprice = $('#data18').text();
   if(clientname != '' )
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{billid:billid,invoicedate:invoicedate,invoiceno:invoiceno,reversecharge:reversecharge,state:state,citycode:citycode,clientname:clientname,clientaddress:clientaddress,gstnid:gstnid,gstnstate:gstnstate,gstncitycode:gstncitycode,product:product,productdesc:productdesc,price:price,loads:loads,totalitem:totalitem ,totalloads:totalloads,totalprice:totalprice},
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
 
// $columns = array('billid', 'invoicedate', 'invoiceno' ,'reversecharge' ,'state','citycode','clientname','clientaddress','gstnid','gstnstate','gstncitycode','product','productdesc','price','loads','totalitem','totalloads','totalprice');
</script>
