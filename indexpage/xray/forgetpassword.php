<?php require_once('../Connections/cn.php'); ?>
<?php
		
$c=0;

?>
<?php

if(isset($_POST['recover']))
	{
		
		$emailid=$_POST['email'];
		$sql1="SELECT * FROM  `user` WHERE email = '$emailid'";
		if($q=mysql_query($sql1))
		{
		$n = mysql_num_rows($q);
		
		if($n > 0) 
		{
			$q1 = mysql_fetch_assoc($q);
			
				$sql="SELECT * FROM  `userlogin` WHERE uid =".$q1['uid'];
				$ww=mysql_query($sql);
				$qr=mysql_fetch_assoc($ww);
		
			$ToEmail= $q1['email'];
			$EmailSubject='About Forget Password';
			$mailheader='From: '.'info@infobizzs.com';
			$mailheader = 'Reply-To: '.$q1['email']; 
			$mailheader='Content-type: text/html; charset=iso-8859-1\r\n'; 
			$MESSAGE_BODY = 'User Name: '.$qr['username'].''; 
			$MESSAGE_BODY .= 'Password: '.$qr['password'].''; 
			mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or die ('Failure'); 
			
		//echo '<script language="javascript" type="application/javascript">alert("We Provide EmilId & Passeord In Mail");
		$ff=5;
		
		
		
		}
		else
		{
		
			/*echo '<script language="javascript" type="application/javascript">alert("Invalid Email ID");
			</script>>';	*/
			//header('location:index.php');
		$ff=3;
		}
	
	
	}	
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laboratry - Doct Connect</title>

    <!-- GLOBAL STYLES -->
    <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- PAGE LEVEL PLUGIN STYLES -->

    <!-- THEME STYLES -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins.css" rel="stylesheet">

    <!-- THEME DEMO STYLES -->
    <link href="css/demo.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body class="login">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-banner text-center">
                    <h1> Doct Connect</h1>
                </div>
                <div class="portlet portlet-green">
                    <div class="portlet-heading login-heading">
					 <div class="portlet-title">
                     <h4><strong>Forgot Password </strong></h4>
					 </div>
                        <div class="clearfix"></div>
                    </div>
                  <div class="portlet-body">
                        <form ACTION="forgetpassword.php" METHOD="POST" name="forpass" >
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" required="required" placeholder="Email ID" name="email" type="email">
                                </div>
                               <br/>
								<input type="submit"  class="btn btn-lg btn-green btn-block" name="recover" value="Recover"/>
								<br/>
							<?php if(isset($_POST['recover'])){?>
                          	<?php if($n==1) { ?>
						    <h6><strong class="alert alert-success">Password Recovered Succsesfully</strong></h6>
							<br/>
							<a href="login.php" style="font-size:12px;color:#0000FF;float:right">Back to login</a>
                         	<?php }	if ($n==0) { ?>
							<H6 class="text-red"><strong class="alert alert-danger">Sorry Invalid EmailID Please Try Again</strong></H6>
							<?php } ?>
						<?php	}?>
					   
        						</fieldset>
					  </form>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GLOBAL SCRIPTS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- HISRC Retina Images -->
    <script src="js/plugins/hisrc/hisrc.js"></script>

    <!-- PAGE LEVEL PLUGIN SCRIPTS -->

    <!-- THEME SCRIPTS -->
    <script src="js/flex.js"></script>

</body>


</html>
