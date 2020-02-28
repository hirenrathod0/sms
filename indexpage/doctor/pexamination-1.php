<?php require_once('../Connections/cn.php'); ?>
<?php 
session_start();
if(!isset($_SESSION['MM_DOCTOR']))
{
	header("location:login.php");
}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
mysql_select_db($database_cn, $cn);
	$q = "SELECT pid FROM exam_patient WHERE pid=".$_GET['pid'];
	$Result1 = mysql_query($q, $cn) or die(mysql_error());
	$row_c = mysql_num_rows($Result1);

if($row_c > 0){
	mysql_select_db($database_cn, $cn);
	$q1 = "SELECT * FROM e_problem_data as pd JOIN e_alimentary_system as es ON es.exid=pd.exid JOIN e_cardio_system as cs ON cs.exid=es.exid JOIN e_nerves_system as ns ON ns.exid=cs.exid JOIN e_other_data as od ON od.exid=ns.exid JOIN e_physical_data as phd ON phd.exid=od.exid JOIN e_problem_data as prd ON prd.exid=phd.exid JOIN e_respiratory_system as rs ON rs.exid=prd.exid JOIN e_sensory_system as ss ON ss.exid=rs.exid JOIN cardio_ausc as ca ON ca.exid=ss.exid WHERE pd.exid=".$_GET['pid'];
	$Result2 = mysql_query($q1, $cn) or die(mysql_error());
	$row = mysql_fetch_assoc($Result2);
	
}
	
	
if(isset($_POST['MM_Examination'])){
	if($row_c == 0){ 
	mysql_select_db($database_cn, $cn);
	$insertQuery = "INSERT INTO exam_patient(pid,exid) VALUES('".$_GET['pid']."','".$_GET['pid']."')";
	mysql_query($insertQuery, $cn) or die(mysql_error());
	
	mysql_select_db($database_cn, $cn);	
	$insertQuery1 = "INSERT INTO e_problem_data(exid,chief_complaint,past_illness,family_history,habit,OG_history,adverse_drug,personal_drug)VALUES('".$_GET['pid']."','".$_POST['complaints']."','".$_POST['past_data']."','".$_POST['family_data']."','".$_POST['habit_data']."','".$_POST['OG_data']."','".$_POST['reaction_data']."','".$_POST['personal_drug_data']."')";
	mysql_query($insertQuery1, $cn) or die(mysql_error());
	
	mysql_select_db($database_cn, $cn);
	$insertQuery2 = "INSERT INTO e_physical_data(exid,vital_data,temp,pulse,respiratory_rate,blood_pressure,spo2,height,weight,BMI,IBW,SHNO,ENT,EPSO,OC,NTO,breast,lymph_node,edema,CC,others,caratoid_r,caratoid_l,brachial_r,brachial_l,radial_r,radial_l,femoral_r,
	femoral_l,popliteal_r,popliteal_l,PT_r,PT_l,DP_r,DP_l)VALUES('".$_GET['pid']."','".$_POST['vital_data']."','".$_POST['temp_data']."','".$_POST['pulse_data']."','".$_POST['RR_data']."','".$_POST['BP_data']."','".$_POST['spo2_data']."','".$_POST['height_data']."','".$_POST['weight_data']."','".$_POST['BMI_data']."','".$_POST['IBW_data']."','".$_POST['SHNO_data']."','".$_POST['ENT_data']."','".$_POST['EPSO_data']."','".$_POST['OC_data']."','".$_POST['NTO_data']."','".$_POST['breast_data']."','".$_POST['LN_data']."','".$_POST['edema_data']."','".$_POST['CC_data']."','".$_POST['others_data']."','".$_POST['carotid_r']."','".$_POST['carotid_l']."','".$_POST['brachial_r']."','".$_POST['brachial_l']."','".$_POST['radial_r']."','".$_POST['radial_l']."','".$_POST['femoral_r']."','".$_POST['femoral_l']."','".$_POST['popliteal_r']."','".$_POST['popliteal_l']."','".$_POST['pt_r']."','".$_POST['pt_l']."','".$_POST['dp_r']."','".$_POST['dp_l']."')";
	mysql_query($insertQuery2, $cn) or die(mysql_error());

	mysql_select_db($database_cn, $cn);
	$insertQuery3 = "INSERT INTO cardio_ausc(exid,s1ma,s1ta,s1aa,s1pa,s2ma,s2ta,s2aa,s2pa,s3ma,s3ta,s3aa,s3pa,s4ma,s4ta,s4aa,s4pa,marmurama,marmurta,marmuraa,marmurpa,clickta,clickma,clickaa,clickpa)VALUES('".$_GET['pid']."','".$_POST['ausc_ma_s1']."','".$_POST['ausc_ta_s1']."','".$_POST['ausc_aa_s1']."','".$_POST['ausc_pa_s1']."','".$_POST['ausc_ma_s2']."','".$_POST['ausc_ta_s2']."','".$_POST['ausc_aa_s2']."','".$_POST['ausc_pa_s2']."','".$_POST['ausc_ma_s3']."','".$_POST['ausc_ta_s3']."','".$_POST['ausc_aa_s3']."','".$_POST['ausc_pa_s3']."','".$_POST['ausc_ma_s4']."','".$_POST['ausc_ta_s4']."','".$_POST['ausc_aa_s4']."','".$_POST['ausc_pa_s4']."','".$_POST['ausc_ma_mar']."','".$_POST['ausc_ta_mar']."','".$_POST['ausc_aa_mar']."','".$_POST['ausc_pa_mar']."','".$_POST['ausc_ma_click']."','".$_POST['ausc_ta_click']."','".$_POST['ausc_aa_click']."','".$_POST['ausc_pa_click']."')";
		mysql_query($insertQuery3, $cn) or die(mysql_error());


	
	mysql_select_db($database_cn, $cn);
	$insertQuery4 = "INSERT INTO e_respiratory_system(exid,SOC,AB,CD,treacha,movements,percussation,auscultation)VALUES('".$_GET['pid']."','".$_POST['insp_shape']."','".$_POST['insp_AB']."','".$_POST['insp_CD']."','".$_POST['insp_treacha']."','".$_POST['palp_movements']."','".$_POST['resp_percussation']."','".$_POST['resp_ausc']."')";
		mysql_query($insertQuery4, $cn) or die(mysql_error());

		mysql_select_db($database_cn, $cn);
	$insertQuery5 = "INSERT INTO e_cardio_system(exid,precedium,visible_pulsation,apex_beat,parasternal,impulse,RHB,LHB,ICS,auscultation)VALUES('".$_GET['pid']."','".$_POST['insp_precedium']."','".$_POST['insp_pulsation']."','".$_POST['palp_AB']."','".$_POST['palp_para']."','".$_POST['palp_impulse']."','".$_POST['resp_RHB']."','".$_POST['resp_LHB']."','".$_POST['resp_ICS']."','NULL')";
		mysql_query($insertQuery5, $cn) or die(mysql_error());

		mysql_select_db($database_cn, $cn);
	    $insertQuery6 = "INSERT INTO e_alimentary_system(exid,inspection,palpation,a_percussation,a_auscultation,external_genetalia,rectal_exam,musc_hands,musc_elbow,musc_shoulder,musc_back,musc_hip,musc_knee,musc_foot)VALUES('".$_GET['pid']."','".$_POST['alim_insp']."','".$_POST['alim_palp']."','".$_POST['alim_percu']."','".$_POST['alim_ausc']."','".$_POST['alim_genifi']."','".$_POST['alim_rectal']."','".$_POST['alim_musc_hands']."','".$_POST['alim_musc_elbow']."','".$_POST['alim_musc_shoulder']."','".$_POST['alim_musc_back']."','".$_POST['alim_musc_hip']."','".$_POST['alim_musc_knee']."','".$_POST['alim_musc_foot']."')";
		mysql_query($insertQuery6, $cn) or die(mysql_error());

		mysql_select_db($database_cn, $cn);
	    $insertQuery7 = "INSERT INTO e_nerves_system(exid,apperance,intellictual,speech,memory,other_functions,cranial_nerves,tone,power,coordination,Imovements)VALUES('".$_GET['pid']."','".$_POST['CNS_AB']."','".$_POST['CNS_GI']."','".$_POST['CNS_SPEECH']."','".$_POST['CNS_MEM']."','".$_POST['CNS_OF']."','".$_POST['CNS_nerves']."','".$_POST['CNS_TN']."','".$_POST['CNS_power']."','".$_POST['CNS_coord']."','".$_POST['CNS_IM']."')";
		mysql_query($insertQuery7, $cn) or die(mysql_error());

		mysql_select_db($database_cn, $cn);
	    $insertQuery8 = "INSERT INTO e_sensory_system(exid,pain,temperature,joint_position,cortical_sensation,cerebillium,
		irritation,reflexes,biceps_r,biceps_l,a_r,a_l,b_r,b_l,c_r,c_l,d_r,d_l,e_r,e_l,f_r,f_l,g_r,g_l)VALUES('".$_GET['pid']."','".$_POST['SS_pain']."','".$_POST['SS_temp']."','".$_POST['SS_vibration']."','".$_POST['SS_CS']."','".$_POST['SS_CG']."','".$_POST['SS_signs']."','".$_POST['SS_reflexes']."','".$_POST['biceps_r']."','".$_POST['biceps_l']."','".$_POST['a_r']."','".$_POST['a_l']."','".$_POST['b_r']."','".$_POST['b_l']."','".$_POST['c_r']."','".$_POST['c_l']."','".$_POST['d_r']."','".$_POST['d_l']."','".$_POST['e_r']."','".$_POST['e_l']."','".$_POST['f_r']."','".$_POST['f_l']."','".$_POST['g_r']."','".$_POST['g_l']."')";
	mysql_query($insertQuery8, $cn) or die(mysql_error());

	mysql_select_db($database_cn, $cn);
	$insertQuery9 = "INSERT INTO e_other_data(exid,ECG,RBUS,Xray,USG,echo,CM,diagnosis) VALUES('".$_GET['pid']."','".$_POST['ECG']."','".$_POST['RBS']."','".$_POST['x-ray']."','".$_POST['USG']."','".$_POST['echo']."','".$_POST['CT']."','".$_POST['diagnosis']."')";
		mysql_query($insertQuery9, $cn) or die(mysql_error());
} else{

	mysql_select_db($database_cn, $cn);	
	$insertQuery1 = "UPDATE e_problem_data SET chief_complaint='".$_POST['complaints']."',past_illness='".$_POST['past_data']."',family_history='".$_POST['family_data']."',habit='".$_POST['habit_data']."',OG_history='".$_POST['OG_data']."',adverse_drug= '".$_POST['reaction_data']."',personal_drug='".$_POST['personal_drug_data']."' WHERE exid='".$_GET['pid']."'";
	mysql_query($insertQuery1, $cn) or die(mysql_error());

	mysql_select_db($database_cn, $cn);
	$insertQuery2 = "UPDATE e_physical_data SET vital_data='".$_POST['vital_data']."',temp='".$_POST['temp_data']."',pulse='".$_POST['pulse_data']."',respiratory_rate='".$_POST['RR_data']."',blood_pressure='".$_POST['BP_data']."',spo2='".$_POST['spo2_data']."',height='".$_POST['height_data']."',weight='".$_POST['weight_data']."',BMI='".$_POST['BMI_data']."',IBW='".$_POST['IBW_data']."',SHNO='".$_POST['SHNO_data']."',ENT='".$_POST['ENT_data']."',EPSO='".$_POST['EPSO_data']."',OC='".$_POST['OC_data']."',NTO='".$_POST['NTO_data']."',breast='".$_POST['breast_data']."',lymph_node='".$_POST['LN_data']."',edema='".$_POST['edema_data']."',CC='".$_POST['CC_data']."',others='".$_POST['others_data']."',caratoid_r='".$_POST['carotid_r']."',caratoid_l='".$_POST['carotid_l']."',brachial_r='".$_POST['brachial_r']."',brachial_l='".$_POST['brachial_l']."',radial_r='".$_POST['radial_r']."',radial_l='".$_POST['radial_l']."',femoral_r='".$_POST['femoral_r']."',
	femoral_l='".$_POST['femoral_l']."',popliteal_r='".$_POST['popliteal_r']."',popliteal_l='".$_POST['popliteal_l']."',PT_r='".$_POST['pt_r']."',PT_l='".$_POST['pt_l']."',DP_r='".$_POST['dp_r']."',DP_l='".$_POST['dp_l']."' WHERE exid='".$_GET['pid']."'";
	mysql_query($insertQuery2, $cn) or die(mysql_error());

mysql_select_db($database_cn, $cn);
	$insertQuery3 = "UPDATE cardio_ausc SET s1ma='".$_POST['ausc_ma_s1']."',s1ta='".$_POST['ausc_ta_s1']."',s1aa='".$_POST['ausc_aa_s1']."',s1pa='".$_POST['ausc_pa_s1']."',s2ma='".$_POST['ausc_ma_s2']."',s2ta='".$_POST['ausc_ta_s2']."',s2aa='".$_POST['ausc_aa_s2']."',s2pa='".$_POST['ausc_pa_s2']."',s3ma='".$_POST['ausc_ma_s3']."',s3ta='".$_POST['ausc_ta_s3']."',s3aa='".$_POST['ausc_aa_s3']."',s3pa='".$_POST['ausc_pa_s3']."',s4ma='".$_POST['ausc_ma_s4']."',s4ta='".$_POST['ausc_ta_s4']."',s4aa='".$_POST['ausc_aa_s4']."',s4pa='".$_POST['ausc_pa_s4']."',marmurama='".$_POST['ausc_ma_mar']."',marmurta='".$_POST['ausc_ta_mar']."',marmuraa='".$_POST['ausc_aa_mar']."',marmurpa='".$_POST['ausc_pa_mar']."',clickta='".$_POST['ausc_ta_click']."',clickaa='".$_POST['ausc_aa_click']."',clickma='".$_POST['ausc_ma_click']."',clickpa='".$_POST['ausc_pa_click']."' WHERE exid='".$_GET['pid']."'";
		mysql_query($insertQuery3, $cn) or die(mysql_error());


mysql_select_db($database_cn, $cn);
	$insertQuery4 = "UPDATE e_respiratory_system SET SOC='".$_POST['insp_shape']."',AB='".$_POST['insp_AB']."',CD='".$_POST['insp_CD']."',treacha='".$_POST['insp_treacha']."',movements='".$_POST['palp_movements']."',percussation='".$_POST['resp_percussation']."',auscultation='".$_POST['resp_ausc']."' WHERE exid='".$_GET['pid']."'";
		mysql_query($insertQuery4, $cn) or die(mysql_error());

		mysql_select_db($database_cn, $cn);
	$insertQuery5 = "UPDATE e_cardio_system SET precedium='".$_POST['insp_precedium']."',visible_pulsation='".$_POST['insp_pulsation']."',apex_beat='".$_POST['palp_AB']."',parasternal='".$_POST['palp_para']."',impulse='".$_POST['palp_impulse']."',RHB='".$_POST['resp_RHB']."',LHB='".$_POST['resp_LHB']."',ICS='".$_POST['resp_ICS']."',auscultation='NULL' WHERE exid='".$_GET['pid']."'";
		mysql_query($insertQuery5, $cn) or die(mysql_error());
	
	mysql_select_db($database_cn, $cn);
	    $insertQuery6 = "UPDATE e_alimentary_system SET inspection='".$_POST['alim_insp']."',palpation='".$_POST['alim_palp']."',a_percussation='".$_POST['alim_percu']."',a_auscultation='".$_POST['alim_ausc']."',external_genetalia='".$_POST['alim_genifi']."',rectal_exam='".$_POST['alim_rectal']."',musc_hands='".$_POST['alim_musc_hands']."',musc_elbow='".$_POST['alim_musc_elbow']."',musc_shoulder='".$_POST['alim_musc_shoulder']."',musc_back='".$_POST['alim_musc_back']."',musc_hip='".$_POST['alim_musc_hip']."',musc_knee='".$_POST['alim_musc_knee']."',musc_foot='".$_POST['alim_musc_foot']."' WHERE exid='".$_GET['pid']."'";
		mysql_query($insertQuery6, $cn) or die(mysql_error());

		mysql_select_db($database_cn, $cn);
	    $insertQuery7 = "UPDATE e_nerves_system SET apperance='".$_POST['CNS_AB']."',intellictual='".$_POST['CNS_GI']."',speech='".$_POST['CNS_SPEECH']."',memory='".$_POST['CNS_MEM']."',other_functions='".$_POST['CNS_OF']."',cranial_nerves='".$_POST['CNS_nerves']."',tone='".$_POST['CNS_TN']."',power='".$_POST['CNS_power']."',coordination='".$_POST['CNS_coord']."',Imovements='".$_POST['CNS_IM']."' WHERE exid='".$_GET['pid']."'";
		mysql_query($insertQuery7, $cn) or die(mysql_error());

		mysql_select_db($database_cn, $cn);
	    $insertQuery8 = "UPDATE e_sensory_system SET pain='".$_POST['SS_pain']."',temperature='".$_POST['SS_temp']."',joint_position='".$_POST['SS_vibration']."',cortical_sensation='".$_POST['SS_CS']."',cerebillium='".$_POST['SS_CG']."',
		irritation='".$_POST['SS_signs']."',reflexes='".$_POST['SS_reflexes']."',biceps_r='".$_POST['biceps_r']."',biceps_l='".$_POST['biceps_l']."',a_r='".$_POST['a_r']."',a_l='".$_POST['a_l']."',b_r='".$_POST['b_r']."',b_l='".$_POST['b_l']."',c_r='".$_POST['c_r']."',c_l='".$_POST['c_l']."',d_r='".$_POST['d_r']."',d_l='".$_POST['d_l']."',e_r='".$_POST['e_r']."',e_l='".$_POST['e_l']."',f_r='".$_POST['f_r']."',f_l='".$_POST['f_l']."',g_r='".$_POST['g_r']."',g_l='".$_POST['g_l']."' WHERE exid='".$_GET['pid']."'";
	mysql_query($insertQuery8, $cn) or die(mysql_error());

	mysql_select_db($database_cn, $cn);
	$insertQuery9 = "UPDATE e_other_data SET ECG='".$_POST['ECG']."',RBUS='".$_POST['RBS']."',Xray='".$_POST['x-ray']."',USG='".$_POST['USG']."',echo='".$_POST['echo']."',CM='".$_POST['CT']."',diagnosis='".$_POST['diagnosis']."' WHERE exid='".$_GET['pid']."'";
		mysql_query($insertQuery9, $cn) or die(mysql_error());
}	
	if(mysql_query($insertQuery9))
	{
		header('location=examPDF-1.php?pid='.$_GET["pid"]);
	}
}
//exit;
?>


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
<script src="../ckeditor/ckeditor.js"></script>
<style>
.gett
{
position:absolute;
	top:10%;
	left:50%;
	
}
.small-input{
width:55px;
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
          <h1> <?php 
mysql_select_db($database_cn, $cn);
$query_Recordset1h = "SELECT * FROM patient where pid='".$_GET['pid']."'";
$Recordset1h = mysql_query($query_Recordset1h, $cn) or die(mysql_error());
$row_Recordset1h = mysql_fetch_assoc($Recordset1h);
$totalRows_Recordset1h = mysql_num_rows($Recordset1h); 
 echo $row_Recordset1h['fname']. "  ".$row_Recordset1h['mname']."  ".$row_Recordset1h['lname'] ; ?> </h1>
          <?php include('button.php');?>
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
              <h4 style="float:left">Examination</h4>
			</div>
            <div class="portlet-widgets"> <a href="examPDF-1.php?pid=<?php echo $_GET["pid"];?>"  class="pull-right btn-orange btn"> Generate PDF </a> </div>
                
            <div class="clearfix"></div>
          </div>
		  <form name="exam_form" method="post" action="<?php echo $editFormAction;?>">
          <div id="basicFormExample" class="panel-collapse collapse in">
            <div class="portlet-body">

              	    <ul class="nav nav-tabs" id="examination_tabs">
					
					<li><a href="#physical">Physical</a></li>
						<li><a href="#problems">Problems</a></li>
						
						<li><a href="#system">System</a></li>
						<li><a href="#other">Other</a></li>
					</ul>
					<div class="tab-content">
					
					
					<div class="tab-pane" id="physical">
							<div class="portlet-body">
									 <table class="table table-striped table-bordered table-hover table-green">
										  <tr>
											<td colspan="4" align="center"><label>PHYSICAL EXAMINATION</label></td>
										  </tr>
										  <tr>
											<td align="left" colspan="4"><label>General Examination</label></td>
										  </tr>
										  <tr>
											<td><label>Vital Data :</label></td>
											<td><input name="vital_data" type="text" value="<?php echo ($row_c > 0) ? $row['vital_data']: "";?>"/></td>
											<td><label>Skin/Hairs/Nails/Others :</label></td>
											<td><input name="SHNO_data" type="text" value="<?php echo ($row_c > 0) ? $row['SHNO']: "";?>"/></td>
										  </tr>
										  <tr>
											<td><label>Temp :</label></td>
											<td><input name="temp_data" type="text" value="<?php echo ($row_c > 0) ? $row['temp']: "";?>"/></td>
											<td><label>Ear/Nose/Throat :</label></td>
											<td><input name="ENT_data" type="text" value="<?php echo ($row_c > 0) ? $row['ENT']: "";?>"/></td>
										  </tr>
										  <tr>
											<td><label>Pulse :</label></td>
											<td><input name="pulse_data" type="text" value="<?php echo ($row_c > 0) ? $row['pulse']: "";?>"/></td>
											<td><label>Eye/Pupils/Sclera/Others</label></td>
											<td><input name="EPSO_data" type="text" value="<?php echo ($row_c > 0) ? $row['EPSO']: "";?>"/></td>
										  </tr>
										  <tr>
											<td><label>Respiratory Rate :</label></td>
											<td><input name="RR_data" type="text" value="<?php echo ($row_c > 0) ? $row['respiratory_rate']: "";?>"/></td>
											<td><label>Oral Cavity :</label></td>
											<td><input name="OC_data" type="text" value="<?php echo ($row_c > 0) ? $row['OC']: "";?>"/></td>
										  </tr>
										  <tr>
											<td><label>Blood Pressure :</label></td>
											<td><input name="BP_data" type="text" value="<?php echo ($row_c > 0) ? $row['blood_pressure']: "";?>"/></td>
											<td><label>Neck Veins/Thyroid/Others :</label></td>
											<td><input name="NTO_data" type="text" value="<?php echo ($row_c > 0) ? $row['NTO']: "";?>"/></td>
										  </tr>
										  <tr>
											<td><label>SpO2 :</label></td>
											<td><input name="spo2_data" type="text" value="<?php echo ($row_c > 0) ? $row['spo2']: "";?>"/></td>
												<td><label>Breast :</label></td>
											<td><input name="breast_data" type="text" value="<?php echo ($row_c > 0) ? $row['breast']: "";?>"/></td>
										  </tr>
										  <tr>
											<td><label>Height</label></td>
											<td><input name="height_data" type="text" value="<?php echo ($row_c > 0) ? $row['height']: "";?>"/></td>
											<td><label>Lymph Nodes</label></td>
											<td><input name="LN_data" type="text" value="<?php echo ($row_c > 0) ? $row['lymph_node']: "";?>"/></td>
										  </tr>
										  <tr>
											<td><label>Weight :</label></td>
											<td><input name="weight_data" type="text" value="<?php echo ($row_c > 0) ? $row['weight']: "";?>"/></td>
											<td><label>Edema :</label></td>
											<td><input name="edema_data" type="text" value="<?php echo ($row_c > 0) ? $row['edema']: "";?>"/></td>
										  </tr>
										  <tr>
											<td><label>BMI :</label></td>
											<td><input name="BMI_data" type="text" value="<?php echo ($row_c > 0) ? $row['BMI']: "";?>"/></td>
											<td><label>Clubbing/Cynosis :</label></td>
											<td><input name="CC_data" type="text" value="<?php echo ($row_c > 0) ? $row['CC']: "";?>"/></td>
										  </tr>
										  <tr>
											<td><label>Ideal Body Weight :</label></td>
											<td><input name="IBW_data" type="text" value="<?php echo ($row_c > 0) ? $row['IBW']: "";?>"/></td>
											<td><label>Others :</label></td>
											<td><input name="others_data" type="text" value="<?php echo ($row_c > 0) ? $row['others']: "";?>"/></td>
										  </tr>
									 </table>
									  <table class="table table-striped table-bordered table-hover table-green">
									 <tr>
										<td align="left" colspan="3"><label>Peripheral Pulsations :</label></td>
									 </tr>
									 <tr>
									 <td></td>
									 <td><label>Right</label></td>
									 <td><label>Left</label></td>
									 </tr>
									  <tr>
										<td><label>Carotid</label></td>
										<td><input name="carotid_r" type="text" value="<?php echo ($row_c > 0) ? $row['caratoid_r']: "";?>"/></td>
										<td><input name="carotid_l" type="text" value="<?php echo ($row_c > 0) ? $row['caratoid_l']: "";?>"/></td>
									  </tr>
									  <tr>
										<td><label>Brachial</label></td>
										<td><input name="brachial_r" type="text" value="<?php echo ($row_c > 0) ? $row['brachial_r']: "";?>"/></td>
										<td><input name="brachial_l" type="text" value="<?php echo ($row_c > 0) ? $row['brachial_l']: "";?>"/></td>
									  </tr>
									  <tr>
										<td><label>Radial</label></td>
										<td><input name="radial_r" type="text" value="<?php echo ($row_c > 0) ? $row['radial_r']: "";?>"/></td>
										<td><input name="radial_l" type="text" value="<?php echo ($row_c > 0) ? $row['radial_l']: "";?>"/></td>
									  </tr>
									  <tr>
										<td><label>Femoral</label></td>
										<td><input name="femoral_r" type="text" value="<?php echo ($row_c > 0) ? $row['femoral_r']: "";?>"/></td>
										<td><input name="femoral_l" type="text" value="<?php echo ($row_c > 0) ? $row['femoral_l']: "";?>"/></td>
									  </tr>
									  <tr>
										<td><label>Popliteal</label></td>
										<td><input name="popliteal_r" type="text" value="<?php echo ($row_c > 0) ? $row['popliteal_r']: "";?>"/></td>
										<td><input name="popliteal_l" type="text" value="<?php echo ($row_c > 0) ? $row['popliteal_l']: "";?>"/></td>
									  </tr>
									  <tr>
										<td><label>PT</label></td>
										<td><input name="pt_r" type="text" value="<?php echo ($row_c > 0) ? $row['PT_r']: "";?>"/></td>
										<td><input name="pt_l" type="text" value="<?php echo ($row_c > 0) ? $row['PT_l']: "";?>"/></td>
									  </tr>
									  <tr>
										<td><label>DP</label></td>
										<td><input name="dp_r" type="text" value="<?php echo ($row_c > 0) ? $row['DP_r']: "";?>"/></td>
										<td><input name="dp_l" type="text" value="<?php echo ($row_c > 0) ? $row['DP_l']: "";?>"/></td>
									  </tr>
									  
									  <tr>
									 	<td colspan="3"><a href="#" id="next" class="btn-info btn pull-right" align="middle" style="margin-right:20px; width:70px;">Next</a>
										</td>
									 </tr>	
									  
									  
									  
									</table>
							</div>	
						</div>
					
					
					
					
					
						<div class="tab-pane active" id="problems">
								<div class="portlet-body">
									 <table class="table table-striped table-bordered table-hover table-green">
									   <tr>
										<td align="center"><label>CURRENT MEDICAL PROBLEMS</label></td>
									  </tr>
									  <tr>
										<td><label>Chief Comaplaints</label></td>
									  </tr>
									  <tr>
										<td><textarea id="complaints" name="complaints" style="line-height:40px;padding-right:500px;"></textarea></td> 								  </tr>
									
									  <tr>
										<td><label>Past Illness or Operation</label></td>
									  </tr>
									  <tr>
										<td><textarea id="past_data" name="past_data" style="line-height:40px;padding-right:500px;"></textarea></td>
									  </tr>
									 
									  <tr>
										<td><label>Family History</label></td>
									  </tr>
									  <tr>
										<td><textarea id="family_data" name="family_data" style="line-height:40px;padding-right:500px;"></textarea></td>
									  </tr>
									  
									  <tr>
										<td><label>Personal Habit :Smoking/Alcohol etc.</label></td>
									  </tr>
									  <tr>
										<td><textarea id="habit_data" name="habit_data" style="line-height:40px;padding-right:500px;"></textarea></td>
									  </tr>
									  
									  <tr>
										<td><label>Obs/Gyn History</label></td>
									  </tr>
									  <tr>
										<td><textarea id="OG_data" name="OG_data" style="line-height:40px;padding-right:500px;"></textarea></td>
									  </tr>
									 
									  <tr>
										<td><label>Adverse Drug Reaction</label></td>
									  </tr>
									  <tr>
										<td><textarea id="reaction_data" name="reaction_data" style="line-height:40px;padding-right:500px;"></textarea></td>
									  </tr>
									  
									  <tr>
										<td><label>Personal Drugs</label></td>
									  </tr>
									  <tr>
											<td><textarea id="personal_drug_data" name="personal_drug_data" style="line-height:40px;padding-right:500px;"></textarea></td>
									  </tr>
									  	
									<tr>
									  <td colspan="3">
									  	<a href="#" id="next1" class="btn-info btn pull-right" style="margin-right:5px;width:75px;">Next</a>
										<a href="#" id="prev1" class="btn-info btn pull-right"  style="margin-right:17px;">Previous</a>
									  </td>
									  </tr>				 
									 </table>
									
								</div>				
						</div>
						
						<div class="tab-pane" id="system">
						<div class="portlet-body">
							<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        Respiratory System
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse">
      <div class="accordion-inner">
        <table class="table table-striped table-bordered table-hover table-green">
		<tr><td colspan="3" align="center"><label>Respiratory System</label></td></tr>
		<tr><td rowspan="4"><label>Inspection :</label></td>
			<td><label>Shape of Chest :</label></td>
			<td><input name="insp_shape" type="text" value="<?php echo ($row_c > 0) ? $row['SOC']: "";?>"/></td>
		</tr>
		<tr><td>AB</td>
			<td><input name="insp_AB" type="text" value="<?php echo ($row_c > 0) ? $row['AB']: "";?>"/></td>
		</tr>
		<tr><td>CD</td>
			<td><input name="insp_CD" type="text" value="<?php echo ($row_c > 0) ? $row['CD']: "";?>"/></td>
		</tr>
		<tr><td><label>Treacha</label></td>
			<td><input name="insp_treacha" type="text" value="<?php echo ($row_c > 0) ? $row['treacha']: "";?>"/></td>
		</tr>
		<tr><td><label>Palpation :</label></td>
			<td><label>Resp.Movements</label></td>
			<td><input name="palp_movements" type="text" value="<?php echo ($row_c > 0) ? $row['movements']: " ";?>"/></td>
		</tr>
		<tr><td><label>Percussaion:</label></td>
			<td></td>
			<td><input name="resp_percussation" type="text" value="<?php echo ($row_c > 0) ? $row['a_percussation']: "";?>"/></td></tr>
		<tr><td><label>Auscultation :</label></td>
			<td></td>
			<td><input name="resp_ausc" type="text" value="<?php echo ($row_c > 0) ? $row['a_auscultation']: "";?>"/></td>
		</tr>
		
</table>
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        Cardiovascular System
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner">
        <table class="table table-striped table-bordered table-hover table-green">
		<tr><td colspan="3" align="center"><label>Cardiovascular System</label></td></tr>
		<tr><td rowspan="2"><label>Inspection :</label></td>
			<td><label>Precedium :</label></td>
			<td><input name="insp_precedium" type="text" value="<?php echo ($row_c > 0) ? $row['precedium']: "";?>"/></td>
		</tr>
		<tr><td><label>Visible Pulsation</label></td>
			<td><input name="insp_pulsation" type="text" value="<?php echo ($row_c > 0) ? $row['visible_pulsation']: "";?>"/></td>
		</tr>
		<tr><td rowspan="3"><label>Palpation :</label></td>
			<td><label>Apex Beat :</label></td>
			<td><input name="palp_AB" type="text" value="<?php echo ($row_c > 0) ? $row['apex_beat']: "";?>"/></td>
		</tr>
		<tr><td><label>Parasternal :</label></td>
			<td><input name="palp_para" type="text" value="<?php echo ($row_c > 0) ? $row['parasternal']: "";?>"/></td>
		</tr>
		<tr><td><label>Impulse :</label></td>
			<td><input name="palp_impulse" type="text" value="<?php echo ($row_c > 0) ? $row['impulse']: "";?>"/></td>
		</tr>
		<tr><td rowspan="3"><label>Percussaion:</label></td>
			<td><label>Right Heart Border :</label></td>
			<td><input name="resp_RHB" type="text" value="<?php echo ($row_c > 0) ? $row['RHB']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Left Heart Border :</label></td>
			<td><input name="resp_LHB" type="text" value="<?php echo ($row_c > 0) ? $row['LHB']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Left 3rd ICS :</label></td>
			<td><input name="resp_ICS" type="text" value="<?php echo ($row_c > 0) ? $row['ICS']: "";?>"/></td>
		</tr>

		<tr><td><label>Auscultation :</label></td>
			<td colspan="2"></td>
		</tr>
		<tr>
		<table class="table table-striped table-bordered table-hover table-green">

		  <tr>
			<th scope="col">&nbsp;</th>
			<th scope="col"><label>S1</label></th>
			<th scope="col"><label>S2</label></th>
			<th scope="col"><label>S3</label></th>
			<th scope="col"><label>S4</label></th>
			<th scope="col"><label>Marmur</label></th>
			<th scope="col"><label>Click</label></th>
		 </tr>
		  <tr>
			<th scope="row"><label>MA</label></th>
			<td><input name="ausc_ma_s1" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s1ma']: "";?>"/></td>
			<td><input name="ausc_ma_s2" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s2ma']: "";?>"/></td>
			<td><input name="ausc_ma_s3" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s3ma']: "";?>"/></td>
			<td><input name="ausc_ma_s4" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s4ma']: "";?>"/></td>
			<td><input name="ausc_ma_mar" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['marmurama']: "";?>"/></td>
			<td><input name="ausc_ma_click" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['clickma']: "";?>"/></td>
		  </tr>
		  <tr>
			<th scope="row"><label>TA</label></th>
			<td><input name="ausc_ta_s1" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s1ta']: "";?>"/></td>
			<td><input name="ausc_ta_s2" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s2ta']: "";?>"/></td>
			<td><input name="ausc_ta_s3" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s3ta']: "";?>"/></td>
			<td><input name="ausc_ta_s4" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s4ta']: "";?>"/></td>
			<td><input name="ausc_ta_mar" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['marmurta']: "";?>"/></td>
			<td><input name="ausc_ta_click" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['clickta']: "";?>"/></td>
		  </tr>
		  <tr>
			<th scope="row"><label>AA</label></th>
			<td><input name="ausc_aa_s1" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s1aa']: "";?>"/></td>
			<td><input name="ausc_aa_s2" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s2aa']: "";?>"/></td>
			<td><input name="ausc_aa_s3" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s3aa']: "";?>"/></td>
			<td><input name="ausc_aa_s4" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s4aa']: "";?>"/></td>
			<td><input name="ausc_aa_mar" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['marmuraa']: "";?>"/></td>
			<td><input name="ausc_aa_click" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['clickaa']: "";?>"/></td>
		  </tr>
		  <tr>
			<th scope="row"><label>PA</label></th>
			<td><input name="ausc_pa_s1" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s1pa']: "";?>"/></td>
			<td><input name="ausc_pa_s2" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s2pa']: "";?>"/></td>
			<td><input name="ausc_pa_s3" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s3pa']: "";?>"/></td>
			<td><input name="ausc_pa_s4" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['s4pa']: "";?>"/></td>
			<td><input name="ausc_pa_mar" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['marmurpa']: "";?>"/></td>
			<td><input name="ausc_pa_click" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['clickpa']: "";?>"/></td>
		  </tr>
		</table>



		</tr>
		
</table>
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
        Alimentary System
      </a>
    </div>
    <div id="collapseThree" class="accordion-body collapse">
      <div class="accordion-inner">
        <table class="table table-striped table-bordered table-hover table-green">
		<tr><td colspan="3" align="center"><label>Alimentary System</label></td></tr>
		<tr><td><label>Inspection :</label></td>
			<td></td>
			<td><input name="alim_insp" type="text" value="<?php echo ($row_c > 0) ? $row['inspection']: "";?>"/></td>
		</tr>
		<tr><td><label>Palpation :</label></td>
			<td></td>
			<td><textarea name="alim_palp"><?php echo ($row_c > 0) ? $row['palpation']: "";?>"</textarea></td>
		</tr>
		<tr><td><label>Percussaion:</label></td>
			<td></td>
			<td><input name="alim_percu" type="text" value="<?php echo ($row_c > 0) ? $row['percussation']: "";?>"/></td></tr>
		<tr><td><label>Auscultation :</label></td>
			<td></td>
			<td><input name="alim_ausc" type="text" value="<?php echo ($row_c > 0) ? $row['auscultation']: "";?>"/></td>
		</tr>
		<tr><td><label>External Genitalia :</label></td>
			<td></td>
			<td><input name="alim_genifi" type="text" value="<?php echo ($row_c > 0) ? $row['external_genetalia']: "";?>"/></td>
		</tr>
		<tr><td><label>Rectal Examination :</label></td>
			<td></td>
			<td><input name="alim_rectal" type="text" value="<?php echo ($row_c > 0) ? $row['rectal_exam']: "";?>"/></td>
		</tr>
		<tr><td rowspan="7"><label>Muscaloskeletan Examination:</label></td>
			<td><label>Hands/Wrist</label></td>
			<td><input name="alim_musc_hands" type="text" value="<?php echo ($row_c > 0) ? $row['musc_hands']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Elbow</label></td>
			<td><input name="alim_musc_elbow" type="text" value="<?php echo ($row_c > 0) ? $row['musc_elbow']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Shoulder</label></td>
			<td><input name="alim_musc_shoulder" type="text" value="<?php echo ($row_c > 0) ? $row['musc_shoulder']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Back/Spine</label></td>
			<td><input name="alim_musc_back" type="text" value="<?php echo ($row_c > 0) ? $row['musc_back']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Hip</label></td>
			<td><input name="alim_musc_hip" type="text" value="<?php echo ($row_c > 0) ? $row['musc_hip']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Knee</label></td>
			<td><input name="alim_musc_knee" type="text" value="<?php echo ($row_c > 0) ? $row['musc_knee']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Anklet/Foot</label></td>
			<td><input name="alim_musc_foot" type="text" value="<?php echo ($row_c > 0) ? $row['musc_foot']: "";?>"/></td>
		</tr>
		
</table>
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
        Central Nervous System
      </a>
    </div>
    <div id="collapseFour" class="accordion-body collapse">
      <div class="accordion-inner">
        <table class="table table-striped table-bordered table-hover table-green">
		<tr><td colspan="3"><label>Central Nervous System</label></td></tr>
		<tr>
			<td rowspan="5"><label>Higher Functions</label></td>
			<td><label>Apperance/Behaviour</label></td>
			<td><input type="text" name="CNS_AB" value="<?php echo ($row_c > 0) ? $row['apperance']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Genreal Intelliectual :</label></td>
			<td><input type="text" name="CNS_GI" value="<?php echo ($row_c > 0) ? $row['intellictual']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Speech :</label></td>
			<td><input type="text" name="CNS_SPEECH" value="<?php echo ($row_c > 0) ? $row['speech']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Memory :</label></td>
			<td><input type="text" name="CNS_MEM" value="<?php echo ($row_c > 0) ? $row['memory']: "";?>"/></td>
		</tr>
<tr>
			<td><label>Other Functions :</label></td>
			<td><input type="text" name="CNS_OF" value="<?php echo ($row_c > 0) ? $row['other_functions']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Cranial Nerves :</label></td>
			<td></td>
			<td><input type="text" name="CNS_nerves" value="<?php echo ($row_c > 0) ? $row['cranial_nerves']: "";?>"/></td>
		</tr>
		<tr>
			<td rowspan="4"><label>Motor Functions :</label></td>
			<td><label>Tone/Nutrition</label></td>
			<td><input type="text" name="CNS_TN" value="<?php echo ($row_c > 0) ? $row['tone']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Power :</label></td>
			<td><input type="text" name="CNS_power" value="<?php echo ($row_c > 0) ? $row['power']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Coordination :</label></td>
			<td><input type="text" name="CNS_coord" value="<?php echo ($row_c > 0) ? $row['coordination']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Involuntary Movements :</label></td>
			<td><input type="text" name="CNS_IM" value="<?php echo ($row_c > 0) ? $row['Imovements']: "";?>"/></td>
		</tr>
		
</table>
      </div>
    </div>
  </div>
    <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
        Sensory System
      </a>
    </div>
    <div id="collapseFive" class="accordion-body collapse">
      <div class="accordion-inner">
        <table class="table table-striped table-bordered table-hover table-green">
		<tr><td colspan="3"align="center"><label>Sensory System</label></td></tr>
		<tr>
			<td><label>Fine Touch/Pain</label></td>
			<td><input type="text" name="SS_pain" value="<?php echo ($row_c > 0) ? $row['pain']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Temperature :</label></td>
			<td><input type="text" name="SS_temp" value="<?php echo ($row_c > 0) ? $row['temperature']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Vibration/Joint Position :</label></td>
			<td><input type="text" name="SS_vibration" value="<?php echo ($row_c > 0) ? $row['joint_position']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Cortical Sensations :</label></td>
			<td><input type="text" name="SS_CS" value="<?php echo ($row_c > 0) ? $row['cortical_sensation']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Cerebullium/Gait :</label></td>
			<td><input type="text" name="SS_CG" value="<?php echo ($row_c > 0) ? $row['cerebillium']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Signs of Menigeal Irritation :</label></td>
			<td><input type="text" name="SS_signs" value="<?php echo ($row_c > 0) ? $row['irritation']: "";?>"/></td>
		</tr>
		<tr>
			<td><label>Reflexes(Superficial Deep):</label></td>
			<td><input type="text" name="SS_reflexes" value="<?php echo ($row_c > 0) ? $row['reflexes']: "";?>"/></td>
		</tr>
		<tr>
		<table class="table table-striped table-bordered table-hover table-green">
		<tr>
			<th scope="col">&nbsp;</th>
			<th scope="col"><label>Biceps</label></th>
			<th scope="col"><label>T</label></th>
			<th scope="col"><label>A</label></th>
			<th scope="col"><label>B</label></th>
			<th scope="col"><label>C</label></th>
			<th scope="col"><label>D</label></th>
			<th scope="col"><label>F</label></th>
			<th scope="col"><label>G</label></th>
		  </tr>
		  <tr>
			<th scope="row"><label>Right</label></th>
			<td><input name="biceps_r" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['biceps_r']: "";?>"/></td>
			<td><input name="a_r" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['a_r']: "";?>"/></td>
			<td><input name="b_r" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['b_r']: "";?>"/></td>
			<td><input name="c_r" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['c_r']: "";?>"/></td>
			<td><input name="d_r" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['d_r']: "";?>"/></td>
			<td><input name="e_r" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['e_r']: "";?>"/></td>
			<td><input name="f_r" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['f_r']: "";?>"/></td>
			<td><input name="g_r" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['g_r']: "";?>"/></td>
		  </tr>
		  <tr>
			<th scope="row"><label>Left</label></th>
			<td><input name="biceps_l" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['vital_data']: "";?>"/></td>
			<td><input name="a_l" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['a_l']: "";?>"/></td>
			<td><input name="b_l" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['b_l']: "";?>"/></td>
			<td><input name="c_l" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['c_l']: "";?>"/></td>
			<td><input name="d_l" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['d_l']: "";?>"/></td>
			<td><input name="e_l" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['e_l']: "";?>"/></td>
			<td><input name="f_l" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['f_l']: "";?>"/></td>
			<td><input name="g_l" type="text" class="small-input" value="<?php echo ($row_c > 0) ? $row['g_l']: "";?>"/></td>
		  </tr>
		</table>
	</tr>		
</table>
      </div>
	</div>
	</div>
	</div>
	<a href="#" id="next3" class="btn-info btn pull-right" style="margin-right:5px;width:75px;">Next</a>
										<a href="#" id="prev3" class="btn-info btn"  style="margin-left:560px;">Previous</a>
</div>
</div>
			<div class="tab-pane" id="other">
							<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover table-green">
				  <tr>
					<td><label>ECG :</label></td>
					<td><input name="ECG" type="text" value="<?php echo ($row_c > 0) ? $row['ECG']: "";?>"/></td>
				  </tr>
				  <tr>
					<td><label>RBS/Urine Sugar :</label></td>
					<td><input name="RBS" type="text" value="<?php echo ($row_c > 0) ? $row['RBUS']: "";?>"/></td>
				  </tr>
				  <tr>
					<td><label>X-Ray Chess Screening:</label></td>
					<td><input name="x-ray" type="text" value="<?php echo ($row_c > 0) ? $row['Xray']: "";?>"/></td>
				  </tr>
				  <tr>
					<td><label>USG:</label></td>
					<td><input name="USG" type="text" value="<?php echo ($row_c > 0) ? $row['USG']: "";?>"/></td>
				  </tr>
				  <tr>
					<td><label>Echo :</label></td>
					<td><input name="echo" type="text" value="<?php echo ($row_c > 0) ? $row['echo']: "";?>"/></td>
				  </tr>
				  <tr>
					<td><label>CT/MRI :</label></td>
					<td><input name="CT" type="text" value="<?php echo ($row_c > 0) ? $row['CM']: "";?>"/></td>
				  </tr>
				  
				  <tr>
					<td><label>Diagnosis :</label></td>
					<td><input name="diagnosis" type="text" value="<?php echo ($row_c > 0) ? $row['diagnosis']: "";?>"/></td>
				  </tr>
				  
				 
				  
				  
				  <tr>
					<td colspan="2" align="center"><button type="submit" class="btn-success btn" name="MM_Examination">Submit</button>
					<a href="#" id="prev4" class="btn-info btn pull-right" style="margin-right:5px;">Previous</a>
					</td>
				  	</td>
				  </tr>
				  
				</table>
				
			
			</div>
		</div>
					</div>
     
    <script>
	    $('#examination_tabs a').click(function (e) {
    		e.preventDefault();
		    $(this).tab('show');
    	})
		$("#next").click(function(e){
			$('#examination_tabs a[href="#problems"]').tab('show');
		})
		$("#next1").click(function(e){
			$('#examination_tabs a[href="#system"]').tab('show');
		})
		$("#next3").click(function(e){
			$('#examination_tabs a[href="#other"]').tab('show');
		})
		$("#prev1").click(function(e){
			$('#examination_tabs a[href="#physical"]').tab('show');
		})
		$("#prev3").click(function(e){
			$('#examination_tabs a[href="#problems"]').tab('show');
		})
		$("#prev4").click(function(e){
			$('#examination_tabs a[href="#system"]').tab('show');
		})
    
    </script>
            </form>  
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