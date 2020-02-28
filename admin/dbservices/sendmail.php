<?php
	$_SESSION['id']=2;
	//$title=$_POST['title'];
	//$descr=$_POST['descr'];
	$query="select userEmail from users";
	$r=mysqli_query($con,$query);
	
$subject = $title;
$from = 'bhaktisanjaybhai@gmail.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">bill date</h1>'.$date;
$message .= '<p style="color:#080;font-size:18px;">due-date</p>'.$starttime;
$message .= '<p style="color:#080;font-size:18px;">due-date</p>'.$details;
$message .= '<p style="color:#080;font-size:18px;">total</p>'.$place;
$message .= '</body></html>';

$message .= '</body></html>';
 while($row=mysqli_fetch_array($r))
 {

$to = $row['userEmail'];
 
//$to = 'bhaktisanjaybhai@gmail.com';
// Sending email
mail($to, $subject, $message, $headers);
}
?>