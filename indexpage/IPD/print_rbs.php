<?php require_once('../Connections/cn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$ii=$_GET['pid'];
$dt1=$_GET['dt1'];
mysql_select_db($database_cn, $cn);
$query_Recordset1 = "SELECT * FROM rbs_chart where pid=$ii and date='$dt1'";
$Recordset1 = mysql_query($query_Recordset1, $cn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$aa=$row_Recordset1['pid'];


mysql_select_db($database_cn, $cn);
$query_Recordset2 = "SELECT * FROM patient where pid='$ii'";
$Recordset2 = mysql_query($query_Recordset2, $cn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   
<meta charset="utf-8"> <title> Doct connect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="../nurse_female/css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="../nurse_female/css/charisma-app.css" rel="stylesheet">
    <link href='../nurse_female/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='../nurse_female/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='../nurse_female/bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='../nurse_female/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='../nurse_female/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='../nurse_female/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='../nurse_female/css/jquery.noty.css' rel='stylesheet'>
    <link href='../nurse_female/css/noty_theme_default.css' rel='stylesheet'>
    <link href='../nurse_female/css/elfinder.min.css' rel='stylesheet'>
    <link href='../nurse_female/css/elfinder.theme.css' rel='stylesheet'>
    <link href='../nurse_female/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='../nurse_female/css/uploadify.css' rel='stylesheet'>
    <link href='../nurse_female/css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="../nurse_female/bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="../nurse_female/img/favicon.ico">

</head>

<body style="margin-top:30px;">
    <!-- topbar starts -->
    
	
     
<table border="1" align="center"  width="100%" style="border:none">
  <tr>
    <td colspan="7" style="text-align:center;">CHOVIS GAM SACHCHIDANAND MEDICAL & RESEARCH CENTER,SANCHALIT</td>
  </tr>
  <tr>
    <td width="119"><img src="../images/vihar logo.png" width="150px" height="100px" /></td>
    <td colspan="7" ><div style="text-align:center;font-size:32px;" ><b > SHRADDHA HOSPITAL</b></div>
      <div style="text-align:center;font-size:20px;">
     VAHERA-388 540,Borsad,Dist.Anand(Guj.) 
      Ph.(02696)223333, 329409 <br />
      <b>RBS CHART</b>
      </td>
      </div>
  </tr>
  
  <tr >
  <td colspan="6" style="border:none">Name: <?php echo $row_Recordset2['fname'].' '. $row_Recordset2['mname'].' '. $row_Recordset2['lname']; ?> 
  </td>
  
  
  
  
  <td style="border:none">OPD NO: <?php echo $row_Recordset2['pid']; ?></td>

  </tr>
  

                    <tr>
                     
                      <th>DATE</th>
					  <th>FBS</th>
					  <th>PRE.LUNCH</th>
					  <th>INWARD PP2BS </th>
					  <th>LAB.PP2BS</th>
					  <th>PRE.DINNER</th>
					  <th>POST DINNER</th>
					  
					 
                    </tr>
					
					<tbody>
                    <?php do { ?>
                      <tr>
                       
                       
						<td><?php echo $row_Recordset1['date']; ?></td>
						<td><?php echo $row_Recordset1['fbs']; ?></td>
                        <td><?php echo $row_Recordset1['pre_lanch']; ?></td>
						<td><?php echo $row_Recordset1['lab_pp2bs']; ?></td>
		 <td><?php echo $row_Recordset1['inward_pp2bs']; ?></td>
         <td><?php echo $row_Recordset1['pre_dinner']; ?></td>
         <td><?php echo $row_Recordset1['post_dinner']; ?></td>
         
         
         
         
       
					</tr>
                  
                  
            
                  
                      <?php } while ($row_Recordset1 = mysql_fetch_array($Recordset1)); ?>
					  </tbody>
                    
                    
                    
                    
                    
                    
                    
                    
  
</table>
   
    
   

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
