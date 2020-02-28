<?php require_once('../Connections/cn.php'); ?>
<?php
$tt=$_GET['pid'];
	
mysql_select_db($database_cn, $cn);
$query_Recordset13 = "SELECT * FROM doc_lab_report WHERE pid='$tt'";
$Recordset13 = mysql_query($query_Recordset13, $cn) or die(mysql_error());
$row_Recordset13 = mysql_fetch_assoc($Recordset13);
$totalRows_Recordset13 = mysql_num_rows($Recordset13);

//PDF USING MULTIPLE PAGES
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE

//	exit;
require('fpdf.php');

//Connect to your database


//Create new pdf file
$pdf=new FPDF();

//Disable automatic page break
$pdf->SetAutoPageBreak(true);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 10;


//print column titles
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',12);
$pdf->SetY($y_axis_initial);
$y_axis = 20;

//get data from database
mysql_select_db($database_cn, $cn);

$report_names = explode(",",$row_Recordset13['sel_rep_name']); 

$personal_data = "SELECT * FROM patient WHERE pid=".$_GET["pid"];
$recordset1 = mysql_query($personal_data,$cn);

mysql_select_db($database_cn, $cn);
$date_info = "SELECT dc.docid,dc.created_date,user.fullname,dc.reading FROM doc_lab_report as dc JOIN user ON user.uid=dc.docid WHERE dc.pid=".$_GET['pid'];
$recordset3 = mysql_query($date_info,$cn);
$row1 = mysql_fetch_assoc($recordset3);

$doc_name = $row1["fullname"];
$advice_date = date("d/m/Y-H:m",strtotime($row1["created_date"]));

//initialize counter
//$i = 0;

//Set maximum rows per page
//$max = 25;

//Set Row Height
$row_height = 3;
while($personalData = mysql_fetch_assoc($recordset1)){
	date_default_timezone_set('Asia/Calcutta');

$age = $personalData['bdate'];
	
	
	$pdf->SetY($y_axis);
	$pdf->Cell(90,6,"PersonalData    :"."      ".$personalData["fname"]." ".$personalData["mname"][0]." ".$personalData["lname"] ,1,0,'L',1);
	$pdf->Cell(90,6,"Advice Date&Time    :"."      ".$advice_date,1,1,'L',1);
	$pdf->Cell(90,6,"Hosp No.           :      13-0000300",1,0,'L',1);	
	$pdf->Cell(90,6,"Report Date&Time    :"."      ".date("d/m/Y-H:m"),1,1,'L',1);
	$pdf->Cell(90,6,"Age/ Sex           :"."       ".$age."/".$personalData["gender"][0],1,0,'L',1);		
	$pdf->Cell(90,6,"Lab No                       :      13-LAB-11963",1,1,'L',1);	
	$pdf->Cell(90,6,"Referred By      :"."      ".$doc_name,1,0,'L',1);	
	$pdf->Cell(90,6,"IPD/ OPD No              :"."      ".$_GET["pid"],1,1,'L',1);	
	$pdf->Cell(90,6,"Performed By   :"."      ".$doc_name,1,0,'L',1);	
	$pdf->Cell(90,6,"Source                       :       OPD",1,1,'L',1);	
	
	//Go to next row
	$y_axis = $y_axis + $row_height;
	//$i = $i + 1;
}
$y_ax =0 ;
$i=0;

mysql_select_db($database_cn, $cn);
//$report_names = explode(",",$row_Recordset13['sel_rep_name']);
//foreach($report_names as $report_name) {
	//if($y_ax == 200){ $pdf->AddPage(); $y_ax=-50;}
	do{
		$report_names=$row_Recordset13['sel_rep_name'];
	
	$pdf->SetFont('Arial','',12);
	 $sel_query = "SELECT rc.price,rd.investigation,rd.units,rd.normalvalue FROM rep_cat as rc JOIN reportdata as rd ON rd.cid= rc.rid WHERE name='".$report_names."'";
	//exit;
	$Recordset2 = mysql_query($sel_query, $cn) or die(mysql_error());

	$y_axis_initial = $y_ax + 70;
	$pdf->SetY($y_axis_initial);
	$y_axis = 20;


	$pdf->Cell(90,5,$report_names,0,1,'L',0);
	$y_axis_initial = $y_ax + 80;
	$pdf->SetY($y_axis_initial);
	$y_axis = 20;
	
	$pdf->Cell(70,6,"Investigation",0,0,'L',1);
	$pdf->Cell(40,6,"Result",0,0,'L',1);
	//$pdf->Cell(40,6,"Units",0,0,'L',1);
	$pdf->Cell(30,6,"Normal Value",0,1,'L',1);
	$y_axis_initial = $y_ax + 88;
	$pdf->SetY($y_axis_initial);
	
	$result= $row_Recordset13['reading'];

	if(mysql_num_rows($Recordset2) > 0){
		while($report_data = mysql_fetch_assoc($Recordset2)){
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(70,6,$report_data["investigation"],0,0,'L',0);
			$pdf->Cell(40,6,$result,0,0,'L',0);
			//$pdf->Cell(40,6,$report_data["units"],0,0,'L',0);
			$pdf->Cell(30,6,$report_data["normalvalue"],0,1,'L',0);
			$i++;
			$y_ax = $y_ax +4;
			//$y_axis = $y_axis + $row_height;
		}
		
	} else {
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(70,6,"No Data Found",0,0,'L',0);
		$pdf->Cell(70,6,"",0,0,'L',0);
		//$pdf->Cell(70,6,"",0,0,'L',0);
		$pdf->Cell(70,6,"",0,0,'L',0);
	//	$a=$a+25;
		
	}
	
	
	$y_ax = $y_ax +50;
	
	if( $y_ax <=200){
		
	}else{
	
	$pdf->AddPage();
	$y_ax=-50;
		//$a=0;
		
	}
//}
}while($row_Recordset13 = mysql_fetch_assoc($Recordset13));
$n= $_GET["pid"]."_".date("Ymd");
$filename =  $n.".pdf";
$pdf->Output();
//Send file
//header("location:running_queue.php?msg=sreport");
?>
