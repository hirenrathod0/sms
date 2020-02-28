<?php
//PDF USING MULTIPLE PAGES
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE

require('fpdf.php');
session_start();
$did=$_SESSION['MM_DOCTOR'];

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
$pdf->SetFont('Arial','B',9);
$y_axis = 50;

		$pid=$_GET['pid'];
        $sql="select * from p_medicine JOIN user ON user.uid=p_medicine.did where pid= '$pid' and status='0'";
		$t=mysql_query($sql);
		$res=mysql_fetch_assoc($t);
		
		$sql1="select * from patient where  pid= '$pid'";
		$t1=mysql_query($sql1);
		$data = mysql_fetch_assoc($t1);
		
		
		
$pdf->setY($y_axis + -7);
$pdf->setX(10);
$pdf->SetFont('Arial','',9);
$pdf->Cell(160,6,"___________________________________________________________________________________________________________",0,1,'L',0);

		
$pdf->setY($y_axis);
$pdf->setX(10);
$pdf->Cell(30,6,"Patient ID ",0,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(50,6,$_GET['pid'],0,0,'L',0);
$pdf->SetFont('Arial','B',9);

$pdf->Cell(50,6,"Date ",0,0,'R',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(37,6,date("j-F-Y"),0,1,'R',0);
$pdf->SetFont('Arial','B',9);



$pdf->setX(10);
$pdf->Cell(30,6,"Patient Name ",0,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,$data["fname"]." ".$data["mname"][0]." ".$data["lname"] ,0,0,'L',0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(38,6,"Counslant By ",0,0,'R',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(50,6,$res['fullname'],0,1,'L',0);

	
		$qq = "SELECT medicine.name,p_medicine.quantity,p_medicine.noofdays,p_medicine.dosage FROM p_medicine JOIN medicine ON medicine.mid=p_medicine.mid WHERE p_medicine.status='0' and  pid=".$_GET['pid'] ;
		$getmedicine=mysql_query($qq);

$pdf->setY($y_axis + 10);
$pdf->setX(10);
$pdf->SetFont('Arial','',9);
$pdf->Cell(160,6,"___________________________________________________________________________________________________________",0,1,'L',0);


$pdf->setX(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(160,6,"Rx.",0,1,'L',0);

$pdf->setY($y_axis + 20);
$pdf->setX(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Medicine",0,0,'L',0);
$pdf->Cell(30,6,"No Of Days",0,0,'L',0);
$pdf->Cell(70,6,"Dosage (M-A-E-N)",0,0,'L',0);
$pdf->Cell(20,6,"Total",0,0,'L',0);
$pdf->setY($y_axis + 25);
$i=1;
while($row_getmedicine = mysql_fetch_assoc($getmedicine))
{
	$pdf->setX(10);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(70,6,$row_getmedicine["name"],0,0,'L',0);
	$pdf->Cell(30,6,$row_getmedicine["noofdays"],0,0,'L',0);
    $pdf->Cell(70,6,$row_getmedicine["dosage"],0,0,'L',0);
	$pdf->Cell(20,6,$row_getmedicine["quantity"],0,1,'L',0);

}

$lv=45;
$av=$i+$lv;
$pdf->setY($y_axis + $av);
$pdf->setX(10);
$pdf->SetFont('Arial','B',11);

$pdf->Cell(0,4,"------------------------------",30,9,'R',0);
$pdf->Cell(0,4,$res['fullname'],30,9,'R',0);
$n= $_GET["pid"]."_".date("Ymdhms");
$filename =  $n.".pdf";



$_SERVER['DOCUMENT_ROOT']."../documents/medication/".$filename;

        $attachment=$filename;
	
		 	 $qry1="insert into p_med_attach(pid,did,path) values ('$pid',$did,'$attachment')";
			 mysql_query($qry1);
			 
			 $qry1="update p_medicine set status='1' where pid='$pid' and did='$did'";
			 mysql_query($qry1);
		

$pdf->Output();


			 