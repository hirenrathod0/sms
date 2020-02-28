<?php
//PDF USING MULTIPLE PAGES
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE

session_start();
require('fpdf.php');
$pid=$_GET['pid'];
$did=$_SESSION["MM_DOCTOR"];
//Connect to your database
require_once('../Connections/cn_vihar.php');

//Create new pdf file
$pdf=new FPDF();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//print column titles
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$y_axis = 50;

//Select the Products you want to show in your PDF file
mysql_select_db($database_cn, $cn);
$personal_data = "SELECT fname,lname,mname FROM patient WHERE pid=".$_GET["pid"];
$recordset1 = mysql_query($personal_data,$cn);
$data = mysql_fetch_assoc($recordset1);

mysql_select_db($database_cn, $cn);
$personal_data1 = "SELECT fullname FROM user WHERE uid=".$_SESSION["MM_DOCTOR"];
$recordset2 = mysql_query($personal_data1,$cn);
$data1 = mysql_fetch_assoc($recordset2);

$pdf->setY($y_axis + -5);
$pdf->setX(10);
$pdf->SetFont('Arial','',9);
$pdf->Cell(30,6,"___________________________________________________________________________________________________________",0,0,'L',0);

$pdf->setY($y_axis);


$pdf->SetX(10);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,6,"Patient Name ",0,0,'L',0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(50,6,$data["fname"]." ".$data["mname"][0]." ".$data["lname"],0,0,'L',0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,6,"Date :",0,0,'R',0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(50,6,date("j-F-Y"),0,1,'L',0);
$pdf->setX(10);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,6,"Consultant     :",0,0,'L',0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(50,6,$data1["fullname"],0,0,'L',0);



//generating prescription
mysql_select_db($database_cn, $cn);
$query_getmedicine = "SELECT  medicine.mid,medicine.manufcuturer,medicine.name,patient_medicine.pmid,patient_medicine.strength, patient_medicine.dosage,patient_medicine.dosageM,patient_medicine.dosageA,patient_medicine.dosageE,patient_medicine.dosageN,patient_medicine.qty,patient_medicine.dateofpm,patient_medicine.pmid,patient_medicine.mid,medicinetype.name as mtype from medicine INNER JOIN patient_medicine ON medicine.mid=patient_medicine.mid JOIN medicinetype ON medicine.mtid= medicinetype.mtid WHERE patient_medicine.pid=".$_GET['pid']." AND date(patient_medicine.dateofpm)='".date("Y-m-d")."'";

$getmedicine = mysql_query($query_getmedicine, $cn) or die(mysql_error());



$pdf->setY($y_axis + 9);
$pdf->setX(10);
$pdf->SetFont('Arial','',9);
$pdf->Cell(30,6,"___________________________________________________________________________________________________________",0,0,'L',0);


$pdf->setY($y_axis + 15);

$pdf->setX(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(160,6,"Rx.",0,1,'L',0);

$pdf->setY($y_axis + 22);
$pdf->setX(10);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(70,6,"Medicine",0,0,'L',0);
$pdf->Cell(20,6,"Forms",0,0,'L',0);
$pdf->Cell(20,6,"Strength",0,0,'L',0);
$pdf->Cell(60,6,"Dosage(M-A-E-N)",0,0,'L',0);
$pdf->Cell(20,6,"Total",0,1,'L',0);
$pdf->setY($y_axis + 32);
$i=1;
while($row_getmedicine = mysql_fetch_assoc($getmedicine)){
	
	$pdf->setX(10);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(70,6,$row_getmedicine["name"].' ('.$row_getmedicine["manufcuturer"].")",0,0,'L',0);
	$pdf->Cell(21,6,$row_getmedicine["mtype"],0,0,'L',0);
	$pdf->Cell(20,6,$row_getmedicine["strength"],0,0,'L',0);
	$pdf->Cell(60,6,$row_getmedicine["dosageM"]."-".$row_getmedicine["dosageA"]."-".$row_getmedicine["dosageE"]."-".$row_getmedicine["dosageN"],0,0,'L',0);
	$pdf->Cell(20,6,$row_getmedicine["qty"],0,1,'L',0);
	$i++;
	
}
$lv=50;
$av=$i+$lv;
$pdf->setY($y_axis + $av);
$pdf->setX(10);
$pdf->SetFont('Arial','B',11);

$pdf->Cell(0,4,"------------------------------",30,9,'R',0);
$pdf->Cell(0,4,$data1["fullname"],30,9,'R',0);

$n= $_GET["pid"]."_".date("Ymd");
$filename =  $n.".pdf";

$_SERVER['DOCUMENT_ROOT']."../documents/prescription/".$filename;


 $attachment=$filename;
		
		 	 $qry1="insert into p_pre_attach(pid,did,path) values ('$pid',$did,'$attachment')";
			 mysql_query($qry1);
$pdf->Output();
//header("location:givepre.php?pid=".$_GET['pid']."&msg=spresc");
