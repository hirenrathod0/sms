<?php 
$connect = mysql_connect('localhost','root','');
if (!$connect) { 
    die('Could not connect to MySQL: ' . mysql_error()); 
} 
$id = mysql_select_db('doc_connect',$connect); 
// supply your database name
 $fn=$_FILES['upd']['name'];
 $ff=$_FILES['upd']['tmp_name'];
//exit;
move_uploaded_file($ff,'csv/'.$fn);
define('CSV_PATH','csv/'); 
// path where your CSV file is located

    $csv_file = CSV_PATH . "$fn"; // Name of your CSV file
    $csvfile = fopen($csv_file, 'r');
    $theData = fgets($csvfile);
    $i = 0;             
    while (!feof($csvfile)) {
        $csv_data[] = fgets($csvfile);
        $csv_array = explode(",", $csv_data[$i]);
        $insert_csv = array();
        
        $insert_csv['mtid'] = $csv_array[0];
		$insert_csv['name'] = $csv_array[1];
		
 $query = "INSERT INTO medicinetype(mtid, name) VALUES ('".$insert_csv['mtid']."','".$insert_csv['name']."')";
 
        $n=mysql_query($query, $connect );
		$i++;
    }
    fclose($csvfile);
echo "File data successfully imported to database!!";
mysql_close($connect);
header('location:medicine_type.php');
?>