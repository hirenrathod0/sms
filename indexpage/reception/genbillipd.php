<div class="col-lg-12">
  <div class="row">
    <div class="col-lg-6">
      <div class="portlet portlet-default">
        <div class="portlet-heading">
          <div class="portlet-title">
            <h4 style="float:left">Insert Bill Detail </h4>
          </div>
          <div class="portlet-widgets"> </div>
          <div class="clearfix"></div>
        </div>
        <div id="basicFormExample" class="panel-collapse collapse in">
          <div class="portlet-body" style="height:300px">
            <form action="<?php echo $editFormAction; ?>" name="frm" method="POST">
              <table class="table">
                <tr>
                  <td><div id="container"> <br />
                      <br />
                      <?php  
$d=$_GET["pid"]; ?>
                      <select data-placeholder="Select Charge.." style="width:100%;height:auto" name="name" value=""  onchange="n(this.value,<?php echo $d; ?>)"class="chosen-select" style="width:350px;" tabindex="2">
                      <option value=""></option>
                      <option value="">Select Charge</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_fee['name']; ?>"  <?php if(isset($_GET['name'] )){  if($row_fee['name']==$_GET['name']){  echo "selected"; } } ?> ><?php echo $row_fee['name']?></option>
                      <?php
} while ($row_fee = mysql_fetch_assoc($fee));
  $rows = mysql_num_rows($fee);
  if($rows > 0) {
      mysql_data_seek($fee, 0);
	  $row_fee = mysql_fetch_assoc($fee);
}
?>
                      </select>
                    </div></td>
                </tr>
                <tr>
                  <td><?php if (isset($_GET['name'])) 
{
 if($totalRows_price<=0)
							  {
								  ?>
                    <input type="text" value="--"  />
                    <?php }  else {	?>
                    <div   class="input-prepend input-append">
                      <input type="text" style="height:auto" class="form-control" readonly="readonly" name="price" value="<?php echo $row_price['price']; ?>" />
                    </div>
                    <br />
                    <div class="input-prepend input-append">
                      <input type="text" style="height:auto" class="form-control"  name="txtdays" value="1" placeholder="Enter No Of Days" />
                    </div>
                    <?php               
do {  
?>
                    <?php
} while ($row_price = mysql_fetch_assoc($price));
							  }}
							  
?></td>
                </tr>
                <tr>
                  <td><input type="hidden" id="pid" name="pid" value="<?php $_GET['pid'] ?>" />
                    <input type="submit" class="btn btn-success" /></td>
                </tr>
              </table>
              <input type="hidden" name="MM_insert" value="frm" />
            </form>
          </div>
        </div>
      </div>
      <!-- /.portlet --> 
    </div>
    
    <!-- /.row (nested) --> 
    <!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-body" id="dta"> </div>
    </div>
    <!-- begin MAIN PAGE ROW --> 
    <!-- begin LEFT COLUMN --> 
    <!-- Basic Form Example -->
    <div class="col-lg-6">
      <div class="portlet portlet-default">
        <div class="portlet-heading">
          <div class="portlet-title">
            <h4 style="float:left"> Bill Details </h4>
          </div>
          <div class="portlet-widgets"> </div>
          <div class="clearfix"></div>
        </div>
        <div id="basicFormExample" class="panel-collapse collapse in">
          <div class="portlet-body" style="overflow:scroll; text-align:center">
            <form action="<?php echo $editFormAction; ?>" name="ins" method="POST" >
              <?php if($totalRows_Recordset1>0) {  ?>
              <table   class="table table-striped table-bordered table-hover table-green">
                <thead>
                  <tr>
                    <td>Name</td>
                    <td>Price</td>
                    <td>Days </td>
                    <td>Total </td>
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php $total=0; do { ?>
                    <tr>
                      <?php $row_Recordset1['id']; ?>
                      <input  type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>"/>
                      <td><?php echo $row_Recordset1['name']; ?>
                        <input  type="hidden" name="name" value="<?php echo $row_Recordset1['name']; ?>"/></td>
                      <td><?php echo $row_Recordset1['price']; ?>
                        <input  type="hidden" name="price" value="<?php echo $row_Recordset1['id']; ?>"/>
                        <input  type="hidden" name="pid" value="<?php echo $_GET['pid']; ?>"/>
                        <input  type="hidden" name="date" value="<?php echo date('d-m-Y') ?>"/></td>
                      <td><?php echo $row_Recordset1['numofd']; ?></td>
                      <td><?php echo $row_Recordset1['total']; ?></td>
                      <td><a href="deltempbill1.php?id=<?php echo $row_Recordset1['id']; ?>&pid=<?php echo $_GET['pid']; ?>" class="btn-danger btn">Delete</a></td>
                    </tr>
                    <?php  $total = $total+$row_Recordset1['total']; ?>
                    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                  <tr>
                    <td colspan="5"><div align="right" style="margin-right:25%"> Total :- <?php echo $total; ?>
                        <input  type="hidden" name="total" value="<?php echo $total; ?>"/>
                      </div></td>
                  </tr>
                </tbody>
              </table>
              <input  type="submit" class="btn btn-success"/>
              <?php    } else 
					{  ?>
              <label class="alert-danger"> NO DATA FOUND </label>
              <?php } ?>
              <input type="hidden" name="MM_insert" value="ins" />
            </form>
          </div>
        </div>
      </div>
      <!-- /.portlet --> 
    </div>
  </div>
  
  <!-- /.row (nested) --> 
  <!-- Modal -->
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-body" id="dta"> </div>
  </div>
</div>
