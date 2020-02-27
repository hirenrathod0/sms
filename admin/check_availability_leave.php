<?php 
session_start();
require_once("includes/config.php");
// code for empid availablity
$from='';
$to='';
if(!empty($_POST['fromdate'])) {
	$ffd=date_format(date_create($_POST['fromdate']),"Y-m-d");
	$eid=$_SESSION['eid'];
	

		$sql ="SELECT id FROM tblleaves WHERE FromDate<=:fd AND ToDate>=:fd AND Status='1' AND empid=:eid";
		$query= $dbh->prepare($sql);
		$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
		$query-> bindParam(':fd',$ffd, PDO::PARAM_STR);
		$query-> execute();
		$results = $query -> fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{
			$from="<span style='color:red'>From Date: On Leave.</span>";
			echo "<script>$('#apply').prop('disabled',true);</script>";
		}
		else
		{
			
			$from="<span style='color:green'>From Date: Date available for Leave.</span>";
			echo "<script>$('#apply').prop('disabled',false);</script>";
			if(!empty($_POST['todate'])) {
				$ftd=date_format(date_create($_POST['todate']),"Y-m-d");
				$eid=$_SESSION['eid'];
			
				$sql ="SELECT id FROM tblleaves WHERE FromDate<=:td AND ToDate>=:td AND Status='1' AND empid=:eid";
				$query= $dbh->prepare($sql);
				$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
				$query-> bindParam(':td',$ftd, PDO::PARAM_STR);
				$query-> execute();
				$results = $query -> fetchAll(PDO::FETCH_OBJ);

				$sql1 = "SELECT id,wdate from worklog where eid=:eid AND wdate>=:fd AND wdate<=:td order by wdate";
				$query1 = $dbh -> prepare($sql1);
				$query1->bindParam(':eid',$eid,PDO::PARAM_STR);
				$query1->bindParam(':fd',$ffd,PDO::PARAM_STR);                     
				$query1->bindParam(':td',$ftd,PDO::PARAM_STR);                     
				$query1->execute();
				$results1=$query1->fetchAll(PDO::FETCH_OBJ);

				if($query->rowCount() > 0)
				{
					$to="<span style='color:red'></br>To Date: On Leave.</span>";
					echo "<script>$('#apply').prop('disabled',true);</script>";
				}
				else if($query1->rowCount() > 0)
				{
					$from="<span style='color:red'></br>Work Entry Found.</span>";
					$to='';
					echo "<script>$('#apply').prop('disabled',true);</script>";
				}
				else
				{
					$sql ="SELECT id FROM tblleaves WHERE :fd<=FromDate AND :td>=ToDate AND Status='1' AND empid=:eid";
					$query= $dbh->prepare($sql);
					$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
					$query-> bindParam(':fd',$ffd, PDO::PARAM_STR);
					$query-> bindParam(':td',$ftd, PDO::PARAM_STR);
					$query-> execute();
					$results = $query -> fetchAll(PDO::FETCH_OBJ);

					if($query->rowCount() > 0)
					{
						$from="<span style='color:red'>From Date: On Leave.</span>";
						echo "<script>$('#apply').prop('disabled',true);</script>";
						$to="<span style='color:red'></br>To Date: On Leave.</span>";
						echo "<script>$('#apply').prop('disabled',true);</script>";
					}
					else
					{
						$to="<span style='color:green'></br>To Date: Date available for Leave.</span>";
						echo "<script>$('#apply').prop('disabled',false);</script>";
						if(!empty($_POST['fromdate'])&!empty($_POST['todate'])) {
							$fdate=$_POST['fromdate'];
							$tdate=$_POST['todate'];
							if(strtotime($fdate) <= strtotime($tdate)) {
								//echo "<span style='color:green'></br>perfect</span>";
								echo "<script>$('#apply').prop('disabled',false);</script>";
							}
							else{
								$from="<span style='color:red'></br>From Date is bigger than to date</span>";
								$to='';
								echo "<script>$('#apply').prop('disabled',true);</script>";
							}
						}
					} 
				}		
			}
		} 
	echo $from;
	echo $to;
}

?>
