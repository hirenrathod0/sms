<?php
//PDF USING MULTIPLE PAGES
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE


require('fpdf.php');
//exit;
session_start();
//Connect to your database
require_once('../Connections/cn.php');

//Create new pdf file
$pdf=new FPDF();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 25;


//print column titles
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',12);
$pdf->SetY($y_axis_initial);
$y_axis = 30;


//Select the Products you want to show in your PDF file
mysql_select_db($database_cn, $cn);

$personal_data = "SELECT * FROM patient WHERE pid=".$_GET["pid"];
$recordset1 = mysql_query($personal_data,$cn);
$personalData = mysql_fetch_assoc($recordset1);

$q1 ="SELECT fullname FROM user WHERE uid='".$_SESSION['MM_DOCTOR']."'";
$doc_data = mysql_query($q1,$cn);
$docData = mysql_fetch_assoc($doc_data);

mysql_select_db($database_cn, $cn);
	$q1 = "SELECT * FROM e_problem_data as pd JOIN e_alimentary_system as es ON es.exid=pd.exid JOIN e_cardio_system as cs ON cs.exid=es.exid JOIN e_nerves_system as ns ON ns.exid=cs.exid JOIN e_other_data as od ON od.exid=ns.exid JOIN e_physical_data as phd ON phd.exid=od.exid JOIN e_problem_data as prd ON prd.exid=phd.exid JOIN e_respiratory_system as rs ON rs.exid=prd.exid JOIN e_sensory_system as ss ON ss.exid=rs.exid JOIN cardio_ausc as ca ON ca.exid=ss.exid WHERE pd.exid=".$_GET['pid'];
	$Result2 = mysql_query($q1, $cn) or die(mysql_error());
	$row = mysql_fetch_assoc($Result2);
	


$pdf->SetY($y_axis);
$pdf->Cell(90,6,"Date   : ".date("d-m-Y"),0,1,'L',0);
$pdf->Cell(90,6,"Patient ID   : ".$personalData["pid"],0,1,'L',0);
$pdf->Cell(90,6,"Patient Name   : ".$personalData["fname"]." ".$personalData["mname"][0]." ".$personalData["lname"] ,0,1,'L',0);
$pdf->Cell(90,6,"Consultant Name   : ".$docData['fullname'] ,0,1,'L',0);
$pdf->Cell(90,6,"Blood Group  : ".$personalData['bgroup'] ,0,1,'L',0);

$pdf->SetY($y_axis + 35);
$pdf->Cell(180,6,"CURRENT MEDICAL PROBLEMS ",0,1,'C',0);
$pdf->Cell(180,9,"Chief Complaints ",0,1,'L',0);
$pdf->Cell(180,21,$row['chief_complaint'],1,1,'L',1);

$pdf->Cell(180,9,"Past Illness/Operation ",0,1,'L',0);
$pdf->Cell(180,21,$row['past_illness'],1,1,'L',1);

$pdf->Cell(180,9,"Family History ",0,1,'L',0);
$pdf->Cell(180,21,$row['family_history'],1,1,'L',1);

$pdf->Cell(180,9,"Personal Habit : (Smoking,Alcohol etc.) ",0,1,'L',0);
$pdf->Cell(180,21,$row['habit'],1,1,'L',1);

$pdf->Cell(180,9,"Obs/Gyn History ",0,1,'L',0);
$pdf->Cell(180,21,$row['OG_history'],1,1,'L',1);

$pdf->Cell(180,9,"Adverse Drug Reaction ",0,1,'L',0);
$pdf->Cell(180,21,$row['adverse_drug'],1,1,'L',1);

$pdf->Cell(180,9,"Personal Drug Reaction ",0,1,'L',0);
$pdf->Cell(180,21,$row['personal_drug'],1,1,'L',1);

//Add 2nd page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 10;


//print column titles
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',12);
$pdf->SetY($y_axis_initial);
$y_axis = 20;
$pdf->SetY($y_axis);
$pdf->Cell(180,6,"PHYSICAL EXAMINATION ",0,1,'C',0);
$pdf->Cell(180,9,"General Examination ",0,1,'L',0);

$pdf->Cell(45,8,"Vital Data : ",0,0,'L',0);
$pdf->Cell(40,8,$row['vital_data'],0,0,'L',0);
$pdf->Cell(50,8,"Skin/Hairs/Nails/Others : ",0,0,'L',0);
$pdf->Cell(45,8,$row['SHNO'],0,1,'L',0);

$pdf->Cell(45,8,"Temp : ",0,0,'L',0);
$pdf->Cell(40,8,$row['temp'],0,0,'L',0);
$pdf->Cell(50,8,"Ear/Nose/Throat : ",0,0,'L',0);
$pdf->Cell(45,8,$row['ENT'],0,1,'L',0);

$pdf->Cell(45,8,"Pulse : ",0,0,'L',0);
$pdf->Cell(40,8,$row['pulse'],0,0,'L',0);
$pdf->Cell(50,8,"Eye/Pupils/Sclera/Others : ",0,0,'L',0);
$pdf->Cell(45,8,$row['EPSO'],0,1,'L',0);

$pdf->Cell(45,8,"Respiratory Rate : ",0,0,'L',0);
$pdf->Cell(40,8,$row['respiratory_rate'],0,0,'L',0);
$pdf->Cell(50,8,"Oral Cavity : ",0,0,'L',0);
$pdf->Cell(45,8,$row['OC'],0,1,'L',0);

$pdf->Cell(45,8,"Blood Pressure : ",0,0,'L',0);
$pdf->Cell(40,8,$row['blood_pressure'],0,0,'L',0);
$pdf->Cell(50,8,"Neck Veins/Thyroid/Others : ",0,0,'L',0);
$pdf->Cell(45,8,$row['NTO'],0,1,'L',0);

$pdf->Cell(45,8,"SpO2 : ",0,0,'L',0);
$pdf->Cell(40,8,$row['spo2'],0,0,'L',0);
$pdf->Cell(50,8,"Breast : ",0,0,'L',0);
$pdf->Cell(45,8,$row['breast'],0,1,'L',0);

$pdf->Cell(45,8,"Height : ",0,0,'L',0);
$pdf->Cell(40,8,$row['height'],0,0,'L',0);
$pdf->Cell(50,8,"Lymph Nodes : ",0,0,'L',0);
$pdf->Cell(45,8,$row['lymph_node'],0,1,'L',0);

$pdf->Cell(45,8,"Weight : ",0,0,'L',0);
$pdf->Cell(40,8,$row['weight'],0,0,'L',0);
$pdf->Cell(50,8,"Edema : ",0,0,'L',0);
$pdf->Cell(45,8,$row['edema'],0,1,'L',0);

$pdf->Cell(45,8,"BMI : ",0,0,'L',0);
$pdf->Cell(40,8,$row['BMI'],0,0,'L',0);
$pdf->Cell(50,8,"Clubbing/Cynosis : ",0,0,'L',0);
$pdf->Cell(45,8,$row['CC'],0,1,'L',0);

$pdf->Cell(45,8,"Ideal Body Weight : ",0,0,'L',0);
$pdf->Cell(40,8,$row['IBW'],0,0,'L',0);
$pdf->Cell(50,8,"Others : ",0,0,'L',0);
$pdf->Cell(45,8,$row['others'],0,1,'L',0);

$pdf->Cell(180,9,"Peripheral Pulsations : ",0,1,'L',0);
$pdf->Cell(25,8," ",1,0,'L',0);
$pdf->Cell(22,8,"Carotid",1,0,'L',0);
$pdf->Cell(22,8,"Brachial",1,0,'L',0);
$pdf->Cell(22,8,"Radial",1,0,'L',0);	
$pdf->Cell(22,8,"Femoral",1,0,'L',0);	
$pdf->Cell(22,8,"Popliteal",1,0,'L',0);	
$pdf->Cell(22,8,"PT",1,0,'L',0);	
$pdf->Cell(22,8,"DP",1,1,'L',0);	

$pdf->Cell(25,8,"Right",1,0,'L',0);
$pdf->Cell(22,8,$row['caratoid_r'],1,0,'L',0);
$pdf->Cell(22,8,$row['brachial_r'],1,0,'L',0);
$pdf->Cell(22,8,$row['radial_r'],1,0,'L',0);	
$pdf->Cell(22,8,$row['femoral_r'],1,0,'L',0);	
$pdf->Cell(22,8,$row['popliteal_r'],1,0,'L',0);	
$pdf->Cell(22,8,$row['PT_r'],1,0,'L',0);	
$pdf->Cell(22,8,$row['DP_r'],1,1,'L',0);	

$pdf->Cell(25,8,"Left",1,0,'L',0);
$pdf->Cell(22,8,$row['caratoid_l'],1,0,'L',0);
$pdf->Cell(22,8,$row['brachial_l'],1,0,'L',0);
$pdf->Cell(22,8,$row['radial_l'],1,0,'L',0);	
$pdf->Cell(22,8,$row['femoral_l'],1,0,'L',0);	
$pdf->Cell(22,8,$row['popliteal_l'],1,0,'L',0);	
$pdf->Cell(22,8,$row['PT_l'],1,0,'L',0);	
$pdf->Cell(22,8,$row['DP_l'],1,1,'L',0);	
	
$pdf->Cell(180,9,"Systemetic Examination : ",0,1,'L',0);
$pdf->Cell(90,7,"Respiratory System : ",0,0,'L',0);
$pdf->Cell(90,7,"Cardiovascular System : ",0,1,'L',0);

$pdf->Cell(50,7,"Inspection",0,0,'L',0);
$pdf->Cell(40,7,"",0,0,'L',0);

$pdf->Cell(50,7,"Inspection",0,0,'L',0);	
$pdf->Cell(40,7,"",0,1,'L',0);


$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Shape of Chest",0,0,'L',0);	
$pdf->Cell(40,7,$row['SOC'],0,0,'L',0);
	

$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Precedium",0,0,'L',0);	
$pdf->Cell(40,7,$row['precedium'],0,1,'L',0);


$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"AB",0,0,'L',0);	
$pdf->Cell(40,7,$row['AB'],0,0,'L',0);


$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Visible Pulsation",0,0,'L',0);	
$pdf->Cell(40,7,$row['visible_pulsation'],0,1,'L',0);


$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"CD",0,0,'L',0);	
$pdf->Cell(40,7,$row['CD'],0,0,'L',0);


$pdf->Cell(50,7,"Palpation",0,0,'L',0);	
$pdf->Cell(40,7,"",0,1,'L',0);	

$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Treacha",0,0,'L',0);	
$pdf->Cell(40,7,$row['treacha'],0,0,'L',0);


$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Apex Beat",0,0,'L',0);	
$pdf->Cell(40,7,$row['apex_beat'],0,1,'L',0);

$pdf->Cell(50,7,"Palpation ",0,0,'L',0);
$pdf->Cell(40,7,"",0,0,'L',0);

$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Parasternal",0,0,'L',0);	
$pdf->Cell(40,7,$row['parasternal'],0,1,'L',0);

$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Resp.Movements",0,0,'L',0);	
$pdf->Cell(40,7,$row['movements'],0,0,'L',0);

$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Impulse",0,0,'L',0);	
$pdf->Cell(40,7,$row['impulse'],0,1,'L',0);

$pdf->Cell(50,7,"Percussaion",0,0,'L',0);
$pdf->Cell(40,7,$row['percussation'],0,0,'L',0);

$pdf->Cell(50,7,"Percussaion",0,0,'L',0);	
$pdf->Cell(40,7,"",0,1,'L',0);
	
$pdf->Cell(50,7,"Auscultation",0,0,'L',0);
$pdf->Cell(40,7,$row['auscultation'],0,0,'L',0);

$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Right Heart Border",0,0,'L',0);	
$pdf->Cell(40,7,$row['RHB'],0,1,'L',0);

$pdf->Cell(90,7,"",0,0,'L',0);

$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Left Heart Border",0,0,'L',0);	
$pdf->Cell(40,7,$row['LHB'],0,1,'L',0);

$pdf->Cell(90,7,"",0,0,'L',0);

$pdf->Cell(10,7,"",0,0,'L',0);	
$pdf->Cell(40,7,"Left 3rd ICS",0,0,'L',0);	
$pdf->Cell(40,7,$row['ICS'],0,1,'L',0);

$pdf->Cell(90,7,"",0,0,'L',0);

$pdf->Cell(50,7,"Auscultation",0,0,'L',0);	
$pdf->Cell(40,7,"",0,1,'L',0);

$pdf->Cell(180,2,"",0,1,'L',0);
$pdf->Cell(90,6,"",0,0,'L',0);
$pdf->Cell(11,6,"",1,0,'L',0);
$pdf->Cell(12,6,"S1",1,0,'L',0);
$pdf->Cell(12,6,"S2",1,0,'L',0);
$pdf->Cell(12,6,"S3",1,0,'L',0);
$pdf->Cell(12,6,"S4",1,0,'L',0);
$pdf->Cell(17,6,"Marmur",1,0,'L',0);
$pdf->Cell(14,6,"Click",1,1,'L',0);

$pdf->Cell(90,6,"",0,0,'L',0);
$pdf->Cell(11,6,"MA",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(17,6,"",1,0,'L',0);
$pdf->Cell(14,6,"",1,1,'L',0);

$pdf->Cell(90,6,"",0,0,'L',0);
$pdf->Cell(11,6,"TA",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(17,6,"",1,0,'L',0);
$pdf->Cell(14,6,"",1,1,'L',0);

$pdf->Cell(90,6,"",0,0,'L',0);
$pdf->Cell(11,6,"AA",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(17,6,"",1,0,'L',0);
$pdf->Cell(14,6,"",1,1,'L',0);

$pdf->Cell(90,6,"",0,0,'L',0);
$pdf->Cell(11,6,"PA",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(12,6,"",1,0,'L',0);
$pdf->Cell(17,6,"",1,0,'L',0);
$pdf->Cell(14,6,"",1,1,'L',0);

//Add 3rd page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 10;


//print column titles
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',12);
$pdf->SetY($y_axis_initial);
$y_axis = 20;
$pdf->SetY($y_axis);

$pdf->Cell(90,8,"Alimentary System : ",0,0,'L',0);
$pdf->Cell(90,8,"Central Nerves System : ",0,1,'L',0);

$pdf->Cell(50,8,"Inspection",0,0,'L',0);
$pdf->Cell(40,8,$row['inspection'],0,0,'L',0);

$pdf->Cell(50,8,"Higher Functions",0,0,'L',0);	
$pdf->Cell(40,8,"",0,1,'L',0);

$pdf->Cell(50,8,"Palpation",0,0,'L',0);
$pdf->Cell(40,8,$row['palpation'],0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Apperance/Behaviour",0,0,'L',0);	
$pdf->Cell(40,8,$row['apperance'],0,1,'L',0);
	
$pdf->Cell(50,8,"Percussaion",0,0,'L',0);
$pdf->Cell(40,8,$row['a_percussation'],0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Genreal Intellictual",0,0,'L',0);	
$pdf->Cell(40,8,$row['intellictual'],0,1,'L',0);

$pdf->Cell(50,8,"Auscultation",0,0,'L',0);
$pdf->Cell(40,8,$row['a_auscultation'],0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Speech",0,0,'L',0);	
$pdf->Cell(40,8,$row['speech'],0,1,'L',0);

$pdf->Cell(50,8,"External Genetalia",0,0,'L',0);
$pdf->Cell(40,8,$row['external_genetalia'],0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Memory",0,0,'L',0);	
$pdf->Cell(40,8,$row['memory'],0,1,'L',0);

$pdf->Cell(50,8,"Rectal Examination",0,0,'L',0);
$pdf->Cell(40,8,$row['rectal_exam'],0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Other Functions",0,0,'L',0);	
$pdf->Cell(40,8,$row['other_functions'],0,1,'L',0);

$pdf->Cell(50,8,"Muscaloskeletan Examination",0,0,'L',0);
$pdf->Cell(40,8,"",0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Cranial Nerves",0,0,'L',0);	
$pdf->Cell(40,8,$row['cranial_nerves'],0,1,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Hands/Wrist",0,0,'L',0);	
$pdf->Cell(40,8,$row['musc_hands'],0,0,'L',0);

$pdf->Cell(50,8,"Motor Functions",0,0,'L',0);
$pdf->Cell(40,8,"",0,1,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Elbow",0,0,'L',0);	
$pdf->Cell(40,8,$row['musc_elbow'],0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Tone",0,0,'L',0);	
$pdf->Cell(40,8,$row['tone'],0,1,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Shoulder",0,0,'L',0);	
$pdf->Cell(40,8,$row['musc_shoulder'],0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Power",0,0,'L',0);	
$pdf->Cell(40,8,$row['power'],0,1,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Back/Spine",0,0,'L',0);	
$pdf->Cell(40,8,$row['musc_back'],0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Coordination",0,0,'L',0);	
$pdf->Cell(40,8,$row['coordination'],0,1,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Hip",0,0,'L',0);	
$pdf->Cell(40,8,$row['musc_hip'],0,0,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Involuntary Movements",0,0,'L',0);	
$pdf->Cell(40,8,$row['Imovements'],0,1,'L',0);

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Knee",0,0,'L',0);	
$pdf->Cell(40,8,$row['musc_knee'],0,0,'L',0);

$pdf->Cell(90,8,"",0,1,'L',0);	

$pdf->Cell(10,8,"",0,0,'L',0);	
$pdf->Cell(40,8,"Anklet/Foot",0,0,'L',0);	
$pdf->Cell(40,8,$row['musc_foot'],0,0,'L',0);

$pdf->Cell(90,8,"",0,1,'L',0);

$pdf->Cell(180,4," ",0,1,'L',0);	
$pdf->Cell(180,8,"Sensory System : ",0,1,'L',0);


$pdf->Cell(45,8,"Fine Touch/Pain",0,0,'L',0);
$pdf->Cell(45,8,$row['pain'],0,0,'L',0);
$pdf->Cell(45,8,"Temperature",0,0,'L',0);
$pdf->Cell(45,8,$row['temp'],0,1,'L',0);

$pdf->Cell(45,8,"Vibration/Joint Position",0,0,'L',0);
$pdf->Cell(45,8,$row['joint_position'],0,0,'L',0);
$pdf->Cell(45,8,"Cortical Sensations",0,0,'L',0);
$pdf->Cell(45,8,$row['cortical_sensation'],0,1,'L',0);

$pdf->Cell(45,8,"Cerebullium/Gait ",0,0,'L',0);
$pdf->Cell(45,8,$row['cerebillium'],0,0,'L',0);
$pdf->Cell(45,8,"Reflexes(Superficial Deep)",0,0,'L',0);
$pdf->Cell(45,8,$row['reflexes'],0,1,'L',0);

$pdf->Cell(80,8,"Signs of Menigeal Irritation",0,0,'L',0);
$pdf->Cell(100,8,$row['irritation'],0,1,'L',0);

$pdf->Cell(180,4," ",0,1,'L',0);

$pdf->Cell(20,8,"",1,0,'L',0);
$pdf->Cell(20,8,"Biceps",1,0,'L',0);	
$pdf->Cell(20,8,"A",1,0,'L',0);	
$pdf->Cell(20,8,"B",1,0,'L',0);		
$pdf->Cell(20,8,"C",1,0,'L',0);	
$pdf->Cell(20,8,"D",1,0,'L',0);	
$pdf->Cell(20,8,"E",1,0,'L',0);	
$pdf->Cell(20,8,"F",1,0,'L',0);	
$pdf->Cell(20,8,"G",1,1,'L',0);	

$pdf->Cell(20,8,"Right",1,0,'L',0);
$pdf->Cell(20,8,$row['biceps_r'],1,0,'L',0);	
$pdf->Cell(20,8,$row['a_r'],1,0,'L',0);	
$pdf->Cell(20,8,$row['b_r'],1,0,'L',0);		
$pdf->Cell(20,8,$row['c_r'],1,0,'L',0);	
$pdf->Cell(20,8,$row['d_r'],1,0,'L',0);	
$pdf->Cell(20,8,$row['e_r'],1,0,'L',0);	
$pdf->Cell(20,8,$row['f_r'],1,0,'L',0);	
$pdf->Cell(20,8,$row['g_r'],1,1,'L',0);	

$pdf->Cell(20,8,"Left",1,0,'L',0);
$pdf->Cell(20,8,$row['biceps_l'],1,0,'L',0);	
$pdf->Cell(20,8,$row['a_l'],1,0,'L',0);	
$pdf->Cell(20,8,$row['b_l'],1,0,'L',0);		
$pdf->Cell(20,8,$row['c_l'],1,0,'L',0);	
$pdf->Cell(20,8,$row['d_l'],1,0,'L',0);	
$pdf->Cell(20,8,$row['e_l'],1,0,'L',0);	
$pdf->Cell(20,8,$row['f_l'],1,0,'L',0);	
$pdf->Cell(20,8,$row['g_l'],1,1,'L',0);	

$pdf->Cell(180,4," ",0,1,'L',0);
$pdf->Cell(45,20,"ECG",0,0,'L',0);
$pdf->Cell(45,20,$row['ECG'],0,0,'L',0);
$pdf->Cell(45,20,"RBS/Urine Sugar",0,0,'L',0);
$pdf->Cell(45,20,$row['RBUS'],0,1,'L',0);

$pdf->Cell(45,20,"X-Ray Chess Screening",0,0,'L',0);
$pdf->Cell(45,20,$row['Xray'],0,0,'L',0);
$pdf->Cell(45,20,"USG",0,0,'L',0);
$pdf->Cell(45,20,$row['USG'],0,1,'L',0);

$pdf->Cell(45,20,"Echo",0,0,'L',0);
$pdf->Cell(45,20,$row['echo'],0,0,'L',0);
$pdf->Cell(45,20,"CT/MRI",0,0,'L',0);
$pdf->Cell(45,20,$row['CM'],0,1,'L',0);
$pdf->Cell(45,20,"Diagnosis",0,0,'L',0);
$pdf->Cell(45,20,$row['diagnosis'],0,1,'L',0);







//print_r($personalData);
$pdf->Output();
?>

