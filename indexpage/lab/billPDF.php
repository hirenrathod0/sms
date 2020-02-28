
<?php
//PDF USING MULTIPLE PAGES
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE


require('fpdf.php');

//Connect to your database
require_once('../Connections/cn.php');

//Create new pdf file
$pdf=new FPDF("L","mm",array(200,85));

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 10;


//print column titles
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','',11);
$pdf->SetY($y_axis_initial);

$y_axis = 22;
$pdf->SetY(15);
$pdf->SetX(25);
$pdf->Cell(30,6,"Date : ".date("d-m-Y"),0,0,'L',0);
/*$pdf->Image($_SERVER['DOCUMENT_ROOT']."/vihar/lab/img/vihar logo.jpg",147,20,25,25);*/
//Select the Products you want to show in your PDF file
mysql_select_db($database_cn, $cn);
$report_names = explode(",",$_POST["repName"]); 
$i = 0;$total=0;  

//function to covert digit to words
function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'ZERO',
        1                   => 'ONE',
        2                   => 'TWO',
        3                   => 'THREE',
        4                   => 'FOUR',
        5                   => 'FIVE',
        6                   => 'SIX',
        7                   => 'SEVEN',
        8                   => 'EIGHT',
        9                   => 'NINE',
        10                  => 'TEN',
        11                  => 'ELEVEN',
        12                  => 'TWELVE',
        13                  => 'THIRTEEN',
        14                  => 'FOURTEEN',
        15                  => 'FIFTEEN',
        16                  => 'SIXTEEN',
        17                  => 'SEVENTEEN',
        18                  => 'EIGHTTEEN',
        19                  => 'NINETEEN',
        20                  => 'TWENTY',
        30                  => 'THIRTY',
        40                  => 'FOURTY',
        50                  => 'FIFTY',
        60                  => 'SIXTY',
        70                  => 'SEVENTY',
        80                  => 'EIGHTY',
        90                  => 'NINETY',
        100                 => 'HUNDRED',
        1000                => 'THOUSAND',
        1000000             => 'MILLION',
        1000000000          => 'BILLION',
        1000000000000       => 'TRILLION',
        1000000000000000    => 'QUADRILLION',
        1000000000000000000 => 'QUINTILLION'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}

//initialize counter
//$i = 0;

//Set maximum rows per page
//$max = 25;

//Set Row Height

$pdf->SetY(27);
$pdf->SetX(25);
$row_height = 6;
	foreach($report_names as $report_name){
		$y_axis = $y_axis + $row_height;		
		$pdf->SetY($y_axis);
		$pdf->SetX(25);
		$sel_query = "SELECT price FROM rep_cat WHERE name='".$report_name."'";
		$Recordset1 = mysql_query($sel_query, $cn) or die(mysql_error());  
		while($bill_data = mysql_fetch_assoc($Recordset1)){ 
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(70,8,$report_name,0,0,'L',0);
			$pdf->Cell(40,8,$bill_data["price"]." /-",0,1,'L',0);
			$total += $bill_data["price"];
		}
		$pdf->SetY($y_axis+$row_height);
		$pdf->Cell(70,0,"",0,0,"C",0);
		$pdf->Cell(40,0,"------------",0,0,"C",0);
}
$amount = ($_POST["total_dis"]!= "") ? $_POST["total_dis"]  : $total;
mysql_select_db($database_cn, $cn);
$selectQuery = "SELECT fname,lname,mname FROM patient WHERE pid=".$_POST['pid'];
$uData = mysql_query($selectQuery,$cn);
while($patientName = mysql_fetch_assoc($uData)){
		$fname = $patientName["fname"];
		$lname = $patientName["lname"];
		$mname = $patientName["mname"];

}
$pdf->SetY($y_axis + 7);
$pdf->SetX(25);	
$pdf->Cell(65,6,"",0,0,'L',0);
$pdf->Cell(80,6,"",0,0,'L',0);
$pdf->Cell(15,6,"",0,1,'L',0);
$pdf->SetX(25);
$pdf->SetFont('Arial','',10);	
$pdf->Cell(50,6,"Received with thanks from ",0,0,'L',0);
$pdf->Cell(90,6,$fname." ".$mname[0]." ".$lname,0,0,'L',0);
$pdf->Cell(20,6," ",0,1,'C',0);
$pdf->SetX(25);
$pdf->SetFont('Arial','',10);	
$pdf->Cell(50,1,"--------------------------------------------",0,0,'L',0);
$pdf->Cell(100,1,"--------------------------------------------------------------------------------",0,0,'L',0);
$pdf->Cell(20,1,"",0,1,'L',0);

$pdf->SetX(25);	
$pdf->Cell(50,6,"Rs. ".$amount ." /-      the sum of Rs.",0,0,'L',0);
$pdf->Cell(100,6,convert_number_to_words($amount),0,0,'L',0);
$pdf->Cell(10,6,"",0,1,'C',0);
$pdf->SetX(25);
$pdf->SetFont('Arial','',10);	
$pdf->Cell(50,1,"--------------------------------------------",0,0,'L',0);
$pdf->Cell(100,1,"--------------------------------------------------------------------------------",0,0,'L',0);
$pdf->Cell(20,1,"",0,1,'L',0);
$pdf->SetX(25);	
$pdf->Cell(30,6,"By Cash/Cheque",0,0,'L',0);
$pdf->Cell(90,6,"",0,0,'L',0);
$pdf->Cell(40,6,"",0,1,'C',0);
$pdf->SetX(25);	
$pdf->Cell(30,6,"",0,0,'L',0);
$pdf->Cell(70,6,"",0,0,'L',0);
$pdf->Cell(60,6," For Doct Connect",0,1,'C',0);

	
						

$discnt = ($_POST['discount']!= "") ? $_POST['discount']  : 0;
mysql_select_db($database_cn, $cn);
$insertQuery = "INSERT INTO lab_bill (pid,amount,discount) VALUES (".$_POST["pid"].",".$amount.",".$discnt.")";

$recordSet = mysql_query($insertQuery,$cn);


$n= $_POST["pid"]."_".date("Ymd");
$filename =  $n.".pdf";

//Send file
$pdf->Output(/*$_SERVER['DOCUMENT_ROOT']."/vihar/documents/reports/".$filename,"F"*/);
//header("location:running_queue.php?msg=sbill");
?>


