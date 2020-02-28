<?php require_once('../Connections/cn.php'); ?>
<?php 

if(!isset($_SESSION['MM_LAB']))
{
header('login.php');
}
mysql_select_db($database_cn, $cn);
$query = "SELECT ul.uid,user.fullname FROM userlogin as ul JOIN user ON user.uid = ul.uid WHERE username='".strtoupper($_SESSION['MM_LAB'])."'";
$Recordset1 = mysql_query($query,$cn);
$user_name = mysql_fetch_array($Recordset1);
?>
<nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                   
							<?php /*?><li>
                        <a class="active" href="viewuser.php?id=<?php echo $user_name["uid"]; ?>">
                            <i class="fa fa-bar-chart-o"></i>  User Profile                   </a>                    </li><?php */?>
							
              
                    <!-- end PAGES DROPDOWN -->
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
