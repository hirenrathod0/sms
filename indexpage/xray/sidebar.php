<?php require_once('../Connections/cn.php'); ?>
<?php 

if(!isset($_SESSION['MM_xray']))
{
header('login.php');
}
mysql_select_db($database_cn, $cn);
$query = "SELECT ul.uid,user.fullname FROM userlogin as ul JOIN user ON user.uid = ul.uid WHERE username='".strtoupper($_SESSION['MM_xray'])."'";
$Recordset1 = mysql_query($query,$cn);
$user_name = mysql_fetch_array($Recordset1);
?>

<nav class="navbar-side" role="navigation">
  <div class="navbar-collapse sidebar-collapse collapse">
    <ul id="side" class="nav navbar-nav side-nav">
      <!-- begin SIDE NAV USER PANEL -->
      <?php /*?><li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#charts">
                            <i class="fa fa-bar-chart-o"></i> Category <i class="fa fa-caret-down"></i>                        </a>
                        <ul class="collapse nav" id="charts">
                            <li>
                                <a href="category.php">
                                    <i class="fa fa-angle-double-right"></i> Manage Category                                 </a>                            </li>
                            
                        </ul>
                    </li><?php */?>
      <?php /*?><li>
                        <a class="active" href="sel-lab-cat.php">
                            <i class="fa fa-bar-chart-o"></i> X-Ray Report                    </a> </li>
					<li>
                        <a class="active" href="running_queue.php">
                            <i class="fa fa-bar-chart-o"></i> Running Queue                   </a>                    </li>
							
							
							
							<li>
                        <a class="active" href="all_xray.php">
                            <i class="fa fa-bar-chart-o"></i> Manage X-ray Billing                   </a>                    </li>
							<?php */?>
      <?php /*?><li>
                        <a class="active" href="viewuser.php?id=<?php echo $user_name["uid"]; ?>">
                            <i class="fa fa-bar-chart-o"></i>  User Profile                   </a>                    </li><?php */?>
      
      <!-- end PAGES DROPDOWN -->
    </ul>
    <!-- /.side-nav --> 
  </div>
  <!-- /.navbar-collapse --> 
</nav>
