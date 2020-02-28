<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Examination-Doct Connect</title>
<link href="css/plugins/pace/pace.css" rel="stylesheet">
<link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<link href="css/plugins/messenger/messenger.css" rel="stylesheet">
<link href="css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet">
<link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
<link href="css/plugins/morris/morris.css" rel="stylesheet">
<link href="css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet">
<link href="css/plugins/datatables/datatables.css" rel="stylesheet">
<!-- THEME STYLES - Include these on every page. -->
<link href="css/style.css" rel="stylesheet">
<link href="css/plugins.css" rel="stylesheet">
<link href="css/demo.css" rel="stylesheet">
<link rel="stylesheet" href="../chosen_v1.1.0/chosen.css">
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="js/plugins/popupoverlay/defaults.js"></script>
<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/advanced-tables-demo.js"></script>
<script src="new/throttle-debounce-min.js"></script>
<script src="new/extensions.js"></script>
<script src="../ckeditor/ckeditor.php"></script>
<style>
.gett
{
position:absolute;
	top:10%;
	left:50%;
	
}

</style>
</head>
<body>
<?php include("header.php")?>
<?php include("sidebar.php")?>
<div id="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <h1> Patient Examination </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> Patient Examination </li>
          </ol>
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- end PAGE TITLE ROW -->
    <!-- begin MAIN PAGE ROW -->
    <div class="row">
      <div class="col-lg-9">
        <div class="portlet portlet-default">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h4 style="float:left">Special Room</h4>
            </div>
            <div class="portlet-widgets"> </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample" class="panel-collapse collapse in">
            <div class="portlet-body">
              	    <ul class="nav nav-tabs" id="examination_tabs">
						<li class="active"><a href="#problems">Problems</a></li>
						<li><a href="#physical">Physical</a></li>
						<li><a href="#system">System</a></li>
					</ul>
						 
					<div class="tab-content">
						<div class="tab-pane active" id="problems">
							<table id="example-table" class="table table-striped table-bordered table-hover table-green dataTable" aria-describedby="example-table_info" style="width: 425px; ">
								  <tr>
									<th scope="row"><label>CURRENT MEDICAL PROBLEMS</label></th>
								  </tr>
								  <tr>
									<th scope="row"><label>Chief Comaplaints</label></th>
								  </tr>
								  <tr>
									<th scope="row"><textarea id="" name=""></textarea></th>
								  </tr>
								  <tr>
									<th scope="row">Past Illness or Operation</th>
								  </tr>
								  <tr>
									<th scope="row"><textarea id="" name=""></textarea></th>
								  </tr>
								  <tr>
									<th scope="row"><label>Family History</label></th>
								  </tr>
								  <tr>
									<th scope="row"><textarea id="" name=""></textarea></th>
								  </tr>
								  <tr>
									<th scope="row"><label>Paersonal Habit :Smoking/Alcohol etc.</label></th>
								  </tr>
								  <tr>
									<th scope="row"><textarea id="" name=""></textarea></th>
								  </tr>
								  <tr>
									<th scope="row"><label>Obs/Gyn History</label></th>
								  </tr>
								  <tr>
									<th scope="row"><textarea id="" name=""></textarea></th>
								  </tr>
								  <tr>
									<th scope="row"><label>Adverse Drug Reaction</label></th>
								  </tr>
								  <tr>
									<th scope="row"><textarea id="" name=""></textarea></th>
								  </tr>
								  <tr>
									<th scope="row"><label>Personal Drugs</label></th>
								  </tr>
								  <tr>
									<th scope="row"><textarea id="" name=""></textarea></th>
								  </tr>
								  
							</table>
						</div>
						<div class="tab-pane" id="physical">...</div>
						<div class="tab-pane" id="system">...</div>
					</div>
     
    <script>
	    $('#examination_tabs a').click(function (e) {
    		e.preventDefault();
		    $(this).tab('show');
    	})
    
    </script>
              
            </div>
          </div>
        </div>
        <!-- /.portlet -->
      </div>
      </div>
         
        </div>
        <!-- /.row (nested) -->

      </div>
    </div>
  </div>
</div>

<!--end hover data -->
<script src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/popupoverlay/defaults.js"></script>
<script src="js/plugins/popupoverlay/logout.js"></script>
<!-- HISRC Retina Images -->
<script src="js/plugins/hisrc/hisrc.js"></script>
<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<!-- HubSpot Messenger -->
<script src="js/plugins/messenger/messenger.min.js"></script>
<script src="js/plugins/messenger/messenger-theme-flat.js"></script>
<!-- Date Range Picker -->
<script src="js/plugins/daterangepicker/moment.js"></script>
<script src="js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Morris Charts -->
<script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="js/plugins/morris/morris.js"></script>
<!-- Flot Charts -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<!-- Sparkline Charts -->
<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- Moment.js -->
<script src="js/plugins/moment/moment.min.js"></script>
<!-- jQuery Vector Map -->
<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<script src="js/demo/map-demo-data.js"></script>
<!-- Easy Pie Chart -->
<script src="js/plugins/easypiechart/jquery.easypiechart.min.js"></script>
<!-- DataTables -->
<script src="js/plugins/datatables/jquery.dataTables.js"></script>
<script src="js/plugins/datatables/datatables-bs3.js"></script>
<!-- THEME SCRIPTS -->
<script src="js/flex.js"></script>
<script src="js/demo/dashboard-demo.js"></script>
<script src="../chosen_v1.1.0/chosen.jquery.js"></script>
<script src="../chosen_v1.1.0/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
</body>
</html>