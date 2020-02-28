<?php require_once('../Connections/cn.php'); ?>
<?php
// *** Validate request to login to this site.
$c=0;
if (!isset($_SESSION)) {
  session_start();
}
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['un'])) {
  $loginUsername=$_POST['un'];
  $password=$_POST['pw'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_cn, $cn);
  
  $LoginRS__query=sprintf("SELECT  *  FROM userlogin WHERE username='$loginUsername' AND password='$password' AND type=' DOCTOR '");
   	$qq=mysql_query("insert into login_history (username)values('$loginUsername')"); 
  // exit;
  $LoginRS = mysql_query($LoginRS__query, $cn) or die(mysql_error());
  
  //$qq=mysql_query("insert into login_history (username)values('$loginUsername')");
  $doctor = mysql_fetch_assoc($LoginRS);
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
	$_SESSION['nm']=$doctor['username'];
  echo  $_SESSION['MM_DOCTOR'] = $doctor['uid']; 
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
	$c=1;
   //header("Location: ". $MM_redirectLoginFailed );
 	  
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/hisrc/hisrc.js"></script>
    <script src="js/flex.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Doctor- Doct Connect</title>
    <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins.css" rel="stylesheet">
    <link href="css/demo.css" rel="stylesheet">
	<style>
	#three-d  {
	color: #fff;
	text-shadow: 0px 1px 0px #999, 0px 2px 0px #888, 0px 3px 0px #777, 0px 4px 0px #666, 0px 5px 0px #555, 0px 6px 0px #444, 0px 7px 0px #333, 0px 8px 7px #001135;
	font: 80px 'ChunkFiveRegular';
}
}
</style>
</head>
<body class="login" style="background-image:url(../admin/img/Medicine.jpg);opacity:0.8">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-banner text-center" id="three-d">
                    <h2><strong>Doct Connect</strong><br/></h2>
                </div>
                <div class="portlet portlet-dark-blue">
                    <div class="portlet-heading login-heading">
                        <div class="portlet-title">
                          	<?php if($c==0) { ?>
						    <h4><strong>Doctor Login </strong></h4>
                         	<?php }	if ($c==1) { ?>
							<h4 class="text-white" >Login Failed.. please try again</h4>
							<?php } ?>
					    </div>
                      
                        <div class="clearfix"></div>
                    </div>
                  <div class="portlet-body">
                        <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="signin" accept-charset="UTF-8" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" required placeholder="User Name" name="un" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required placeholder="Password" name="pw" type="password" >
                                </div>
                                <br>
								<input type="submit"  class="btn btn-lg btn-blue btn-block" name="login" value="Sign In"/>
                               
                            </fieldset>
					</form>
                            <br>
                            <p class="small">
                                <a href="forgetpassword.php">Forgot your password?</a>                            </p>
                      </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>