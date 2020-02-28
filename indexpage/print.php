<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<table width="780" border="0" cellspacing="0" cellpadding="0">
<form method="post" action="<?php echo $PHP_SELF; ?>" name="testprint">
<?php
$a = "Test Printing this page";
echo $a; 
echo "<br><br>";
?>

<?php
function printthispage()
{
	$fhandle = fopen("print.php","rb");
	$contents = fread($fhandle, filesize("print.php"));
	$output = eval($contents);
	$handle = printer_open("Dell Laser Printer M5200");
	printer_set_option($handle,PRINTER_MODE,"raw");
	printer_write($handle,$output);
	printer_close($handle);
}
?>

<?php
function printthispage1()
{
	$filename = "print.php";
	ob_start();
	include $filename;
	$contents = ob_get_contents();
	ob_end_clean();
	$handle = printer_open("SAVIN4045ePCL6");
	printer_set_option($handle, PRINTER_MODE, "raw"); 
	printer_write($handle,$contents);
	printer_close($handle);
}
?>

<input name="print" type="submit" value="Print this page"><br>
</form>
</table>
</body>
</html>
