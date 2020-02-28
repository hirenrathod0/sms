<?php
require('fpdf.php');
$d=date('d_m_Y');

class PDF extends FPDF
{

function Header()
{
    //Logo
	$name="Export PDF";
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
	$this->SetFont('Arial','B',9);
    //Line break
    $this->Ln(20);
}

//Page footer
function Footer()
{
   
}

//Load data
function LoadData($file)
{
	//Read file lines
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}

//Simple table
function BasicTable($header,$data)
{ 

$this->SetFillColor(0,255,0);
$this->SetDrawColor(128,0,0);
$w=array(30,15,20,10,10,10,10,10,15,15,15,15,15);

	//Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	//Data
	foreach ($data as $eachResult) 
	{ //width
		$this->Cell(30,6,$eachResult["bookstall_id"],1);
		$this->Cell(15,6,$eachResult["name"],1);
		$this->Cell(20,6,$eachResult["location"],1);
		$this->Cell(10,6,$eachResult["address"],1);
		$this->Cell(10,6,$eachResult["telephone"],1);
		$this->Ln();
		 	 	 	 	
	}
}

//Better table
}

$pdf=new PDF();
$header=array('bookstall_id','name','location','address','telephone');
//Data loading
//*** Load MySQL Data ***//
$objConnect = mysql_connect("localhost","database_username","database_password") or die("Error:Please check your database username & password");
$objDB = mysql_select_db("database_name");
$strSQL = "SELECT bookstall_id,	name,	location,	address,	telephone FROM bookstall";
$objQuery = mysql_query($strSQL);
$resultData = array();
for ($i=0;$i<mysql_num_rows($objQuery);$i++) {
	$result = mysql_fetch_array($objQuery);
	array_push($resultData,$result);
}
//************************//


function forme()

{
$d=date('d_m_Y');
echo "PDF generated successfully. To download document click on the link >> <a href=".$d.".pdf>DOWNLOAD</a>";
}


$pdf->SetFont('Arial','',6);

//*** Table 1 ***//
$pdf->AddPage();
$pdf->Ln(35);
$pdf->BasicTable($header,$resultData);
forme();
$pdf->Output("$d.pdf","F");

?>