<?php
	 //if(isset($_POST['submit']))
	 //{
         
	 	$nm=$_POST['un'];
		$pass=$_POST['pass'];
          echo "hii";
		$cn=mysqli_connect("localhost","root","","society");
         echo "hii";
		$qry=mysqli_query($cn,"select * from admin where uname='".$nm."' AND password='".$pass."'");
         //select * from admin where uname='patelpriyanshi0807@g' AND password='1234'
             //"select * from admin where uname='".$nm."' AND password='".$pass."'
		$a=mysqli_num_rows($qry);
         echo $a;
		  if($a>0)
		  {
		  	echo "login sucessful";
			//$_SESSION['user'] = $nm;
			//$_SESSION['pass'] = $pass;
			header("location:../../index3.html");
			}
		  else
		  	echo "<h3>"."try again"."</h3>";
	 //}
 ?>