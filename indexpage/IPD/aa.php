<?php
mysql_select_db($database_cn, $cn);
$ll=$_GET['pid'];
$qq= "SELECT * FROM patient_admit where pid='$ll'";
$qq1= mysql_query($qq) or die(mysql_error());
$qq2 = mysql_fetch_assoc($qq1);
$qq4=$qq2['pid'];

$aa= "SELECT * FROM patient where pid='$qq4'";
$aa1= mysql_query($aa) or die(mysql_error());
$aa2 = mysql_fetch_assoc($aa1);

$bb= "SELECT * FROM sur_dtl where pid='$qq4'";
$bb1= mysql_query($bb) or die(mysql_error());
$bb2 = mysql_fetch_assoc($bb1);
//$totalRows_Recordset1 = mysql_num_rows($Recordset1); 
?>
<div class="row"> 
  <!-- begin LEFT COLUMN -->
  <div class="col-lg-12">
    <div class="row"> </div>
    <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-body" id="dta1"> </div>
    </div>
  </div>
</div>
<div class="row"> 
  <!-- begin LEFT COLUMN -->
  <div class="col-lg-12">
    <div class="row"> 
      <!-- Basic Form Example -->
      <div class="col-lg-12">
        <div class="portlet portlet-default">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h4 style="float:left"> Lab Reports </h4>
            </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample" class="panel-collapse collapse in">
            <?php 
 $cc= "SELECT * FROM doc_lab_report where pid='$ll'";
//exit;
$cc1= mysql_query($cc) or die(mysql_error());
$cc2 = mysql_fetch_assoc($cc1);
			  
			  ?>
            <div class="portlet-body">
              <table  class="table table-striped table-bordered table-hover table-green">
                <thead>
                  <tr>
                    <td>Report Name</td>
                    <td>Reading </td>
                    <td>Date</td>
                  </tr>
                </thead>
                <tbody>
                  <?php do { ?>
                  <tr>
                    <td><?php echo $cc2['sel_rep_name']; ?></td>
                    <td><?php echo $cc2['reading']; ?></td>
                    <td><?php echo $cc2['created_date']; ?></td>
                  </tr>
                  <?php } while ($cc2 = mysql_fetch_assoc($cc1)); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.portlet --> 
      </div>
    </div>
    <!-- /.row (nested) --> 
    
    <!-- Modal -->
    
    <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-body" id="dta1"> </div>
    </div>
  </div>
</div>
<div class="row"> 
  <!-- begin LEFT COLUMN -->
  <div class="col-lg-12">
    <div class="row"> 
      <!-- Basic Form Example -->
      <div class="col-lg-12">
        <div class="portlet portlet-default">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h4 style="float:left"> X-ray Details </h4>
            </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample" class="panel-collapse collapse in">
            <?php 
 $dd= "SELECT * FROM xray_dtl where pid='$ll'";
//exit;
$dd1= mysql_query($dd) or die(mysql_error());
$dd2 = mysql_fetch_assoc($dd1);
			  
			  ?>
            <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover table-green">
                <thead>
                  <tr>
                    <td>X-Ray Name</td>
                    <td>Date</td>
                  </tr>
                </thead>
                <tbody>
                  <?php do { ?>
                  <tr>
                    <td><?php echo $dd2['xname']; ?></td>
                    <td><?php echo $dd2['date']; ?></td>
                  </tr>
                  <?php } while ($dd2 = mysql_fetch_assoc($dd1)); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.portlet --> 
      </div>
    </div>
    <!-- /.row (nested) --> 
    
    <!-- Modal -->
    
    <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-body" id="dta1"> </div>
    </div>
  </div>
</div>
<div class="row"> 
  <!-- begin LEFT COLUMN -->
  <div class="col-lg-12">
    <div class="row"> 
      <!-- Basic Form Example -->
      <div class="col-lg-12">
        <div class="portlet portlet-default">
          <div class="portlet-heading">
            <div class="portlet-title">
              <h4 style="float:left"> Dressing Reports </h4>
            </div>
            <div class="clearfix"></div>
          </div>
          <div id="basicFormExample" class="panel-collapse collapse in">
            <?php 
 $ee= "SELECT * FROM dressing where pid='$ll' and status='pending'";
//exit;
$ee1= mysql_query($ee) or die(mysql_error());
$ee2 = mysql_fetch_assoc($ee1);
			  
			  ?>
            <div class="portlet-body">
              <table  class="table table-striped table-bordered table-hover table-green">
                <thead>
                  <tr>
                    <td>Remarks</td>
                    <td>Date</td>
                  </tr>
                </thead>
                <tbody>
                  <?php do { ?>
                  <tr>
                    <td><?php echo $ee2['remarks']; ?></td>
                    <td><?php echo $ee2['date']; ?></td>
                  </tr>
                  <?php } while ($ee2 = mysql_fetch_assoc($ee1)); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.portlet --> 
      </div>
    </div>
    <!-- /.row (nested) --> 
    
    <!-- Modal -->
    
    <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-body" id="dta1"> </div>
    </div>
  </div>
</div>

