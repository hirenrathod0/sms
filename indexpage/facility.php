
<html>
	<head>
	<meta charset="utf-8">
	<title>facility</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Admin Panel Template">
<meta name="author" content="Westilian: Kamrujaman Shohel">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3school.css">




<link rel="shortcut icon" type="image/x-icon" href="images/1.png" />


	<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-theme.css">
<link rel="stylesheet" href="bootstrap-theme.min.css">
<link href="bootstrap-toggle-bootstrap-toggle.min.css" rel="stylesheet">

<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/jquery-ui-1.8.16.custom.css" rel="stylesheet">
<link href="css/jquery.jqplot.css" rel="stylesheet">
<link href="css/prettify.css" rel="stylesheet">
<link href="css/elfinder.min.css" rel="stylesheet">
<link href="css/elfinder.theme.css" rel="stylesheet">
<link href="css/fullcalendar.css" rel="stylesheet">
<link href="js/plupupload/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/icons-sprite.css" rel="stylesheet">
<link id="themes" href="css/themes.css" rel="stylesheet">

<link rel="shortcut icon" href="img/alert.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">



<script src="bootstrap-toggle-bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="bootstrap.js"></script>
<script type="text/javascript" src="bootstrap.min.js"></script>
<script type="text/javascript" src="npm.js"></script>

<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
function myFunction(x) {
    x.classList.toggle("change");
}
</script>
	
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){$(".accBox").click(function(){$(".accContent").slideUp("fast");if($(this).next().is(":hidden")==true){$(this).next().slideDown("normal")}});$(".accContent").hide()});
	</script>
		<style>
		#accWrap {
	max-width: 800px;
	margin: 1em auto;	
	 padding: 0 1em;
	 
	 margin-bottom:20px;
	}
.accBox {	
  width:100%;	
	float: left;
	background: #eee;	
	font-size:.875em;
	font-weight:700;
	
	text-indent:2.5%;
	border:1px dotted #ccc;
	
	
	}
	body
	{
	background-color:#320d7f;
	}
	.accBox:hover {	
	background:rgb(255,51,138);
	
  cursor:pointer;
	}	
.accContent {	
	width: 100%;
	float: left;
  padding:2%;
	background-color:rgba(134,51,255,0.9);
	
  border-top:1px dotted #ccc;
 
	}
   
	#snowflakeContainer {
    position:absolute;
    left: 0px;
    top: 0px;
}
.snowflake {
    padding-left: 15px;
    font-family:Trebuchet MS;
    font-size: 14px;
    line-height: 24px;
    position: fixed;
    color: #FFFFFF;
    user-select: none;
    z-index: 1000;
}
.snowflake:hover {
    cursor: default;
}
p {
    font-family:Trebuchet MS;
    font-size: 24px;
    color: #CCC;
}


		.inline{
  display: inline-block;
}
.inline + .inline{
  margin-left:10px;
}
.radio{
   color: #AAAAAA;
  font-size:20px;
  position:relative;
}
.radio span{
  position:relative;
   padding-left:30px;
     cursor: pointer;
	   color: #AAAAAA;
}
.radio span:hover{
  position:relative;
 
     cursor: pointer;
	 color: #FFFFFF;
}

.radio span:after{
  content:'';
  width:15px;
  height:15px;
  border:3px solid;
  position:absolute;
  left:0;
  top:1px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
  box-sizing:border-box;
  -ms-box-sizing:border-box;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
}
.radio input[type="radio"]{
   cursor: pointer; 
  position:absolute;
  width:100%;
  height:100%;
  z-index: 1;
  opacity: 0;
  filter: alpha(opacity=0);
}
.radio input[type="radio"]:checked + span{
  color:rgb(74,255,51);  
    
}
.radio input[type="radio"]:checked + span:before{
    content:'';
  width:5px;
  height:5px;
  position:absolute;
  background:#4790d2;
  left:5px;
  top:6px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
    
}
.sub
{
	width:100%;
	height:30px;
}
input
{
	width:20px;
	height:20px;
}
ul li:hover label{
	color: #FFFFFF;
}
ul li:hover span{
	color: #FFFFFF;
}
.dept
{
color:rgb(255,61,138);font-size:20px;
 font-family:Trebuchet MS;
}
#accWrap .accBox:hover h3
{
	color:white;
}
.sub:hover
{
	background-color:green;
	color:white;
	border:none;
	
}
.sub{
font-family:Trebuchet MS;
color:green;
font-size:20px;
font-weight:bold;
}
.sel
{
	
	color:white;
	font-family:Trebuchet MS;
	text-decoration:underline;
	text-shadow: 1.5px 2px #320d7f;
	 font-size:25px;
	
	
}
.sq
{
color:white;
font-size:30px;
}
h1
{
	margin-top:5%;
	color:white;
	text-align:center;
	
	text-decoration:underline;
	font-family:Trebuchet MS;
	 font-size:25px;
	 margin-bottom:4%;
	 font-weight:500;
	
	 }
	 *
	 {
		padding:0;
		margin:0;
	 }
		@media only screen and (max-width: 500px) {
		h1{
			margin-top:30%;
		}
			
		body
		{
			
		background-color:#320d7f;
		}
		
	}
	
	.dashboard-widget
	{
		position:relative;
		margin-left:-200px;
	}
	
	.menubutton
{
	
	position:absolute;
}

.foot{
	margin-top:12%;
	color:black;
	
	
}

	
	</style>
	</head>
	<body>
	
	
	<script src="js/google.js" type="text/javascript"></script>
<script src="ckeditor/ckeditor.js"></script>

	
	
	
<!--	<div class="w3-sidebar w3-bar-block w3-animate-left " style="display:none;z-index:5" id="mySidebar">
					  <button class="w3-bar-item w3-button w3-large " onclick="w3_close()">Close &times;</button>
					  <a href="mainadminpagedemo.php" class="w3-bar-item w3-button">Add Details</a>
					  <a href="mainadminpageSEARCHdemo.php" class="w3-bar-item w3-button">Search Details</a>
					  <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
</div>
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<div>-->



	
	
	
	
	
	<h1><b>Facilities</b></h1>
	
	
	<div class="dashboard-widget" style="padding-left:30%;padding-top:0%;">
      <div class="row-fluid">
        <div class="span2">
          <div class="dashboard-wid-wrap" style="width:100%;">
		  
		  
		  
             <div class="dashboard-wid-content"> <a href="sweeper.php"><img src="sweeper.png" width="40"> <span class="dasboard-icon-title"><b>Sweeper</b></span> </a> </div>
			</div>
        </div>
        <div class="span2" style="margin-left:50px;">
          <div class="dashboard-wid-wrap">
            <div class="dashboard-wid-content"> <a href="plumber.php"><img src="inventory.jpg" width="60"> <span class="dasboard-icon-title"><b>Plumber</b></span> </a> </div>
          </div>
        </div>
        <div class="span2" style="margin-left:50px;">
          <div class="dashboard-wid-wrap">
            <div class="dashboard-wid-content"> <a href="electrician.php"><img src="client.png" width="40" > <span class="dasboard-icon-title"><b>Electrician</b></span> </a> </div>
          </div>
        </div>
       
	    <div class="span2" style="margin-left:70px;">
          <div class="dashboard-wid-wrap">
            <div class="dashboard-wid-content"> <a href="mason.php"> <img src="itemdata2.jpg" width="90" height="80">  <span class="dasboard-icon-title"><b>Mason</b></span> </a> </div>
          </div>
        </div>
       
	   



	   </div>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <div class="row-fluid">                   
		 
		 <div class="span2" style="margin-left:90px;">
          <div class="dashboard-wid-wrap">
                        <div class="dashboard-wid-content"> <a href="colorman.php"> <img src="staff.png" width="40"> <span class="dasboard-icon-title"><b>Color Work</b> </span> </a> </div>
												<!--<a href="file_upload_and_download/upload and delete file/download1.php">  </a>   -->
		<!--<a href="upload_and_delete_file_dailyfed/upload.php"> <img src="adddailyfed.jpg" width="40">  <span class="dasboard-icon-title"><b>Add Dailyfed</b></span> </a> </div>
        -->  </div>
        </div>
    
		 
		 
		 
        <div class="span2" style="margin-left:70px;">
          <div class="dashboard-wid-wrap">
            <div class="dashboard-wid-content"> <a href="eventmanager.php"> <img src="adddonar.png" width="55"> <span class="dasboard-icon-title"><b>Event Manager</b> </span> </a> </div>
          </div>
        </div>
        <div class="span2" style="margin-left:70px;">
          <div class="dashboard-wid-wrap">
            <div class="dashboard-wid-content"> <a href="vehiclerepairer.php"> <img src="addinventory.png" width="40">  <span class="dasboard-icon-title"><b>Vehicle Repairing</b></span> </a> </div>
          </div>
        </div>
               
      </div>
    </div>


</div>
	<div id="snowflakeContainer">
    <p class="snowflake">.</p>
	</div>
	
	

	<script src="fallingsnow_v6.js"></script>
<script src="prefixfree.min.js"></script>

<script src="js/jquery.js"></script>
<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/prettify.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/jquery-dynamic-form.js"></script>
<script src="js/fullcalendar.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/jquery.cleditor.min.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/ColVis.min.js"></script>
<script src="js/plupload.full.js"></script>
<script src="js/elfinder/elfinder.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="../../../../bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
<script src="js/plupupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>
<script src="js/chart/jqplot.highlighter.min.js"></script>
<script src="js/chart/jqplot.cursor.min.js"></script>
<script src="js/chart/jqplot.dateAxisRenderer.min.js"></script>
<script src="js/custom-script.js"></script>
<script src="js/respond.min.js"></script>
<script src="js/ios-orientationchange-fix.js"></script>


<script>
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

		

	</body>
</html>