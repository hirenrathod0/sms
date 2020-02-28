<?php
    // geting file content
    ob_start();

    include ("temp_dis1.php");
//exit;
    $content = ob_get_contents();
    ob_end_clean();
	date_default_timezone_set("Asia/Calcutta");
    //store in local file
	$n= $_GET['pid']."_"."discharge_card";
    file_put_contents("../documents/certificate/".$n.".doc",$content);

    // file output:
	

	$n= $_GET['pid']."_"."discharge_card";
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$n.doc");    echo $content;
?>