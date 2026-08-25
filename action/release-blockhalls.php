<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlB=mysql_query("select * from bq_hallbooking where venue='".$_GET['venue']."' AND session='".$_GET['session']."' AND book_date='".$_GET['book_date']."' AND confirm_status='6'");
if(mysql_num_rows($sqlB)>0){
		
		$sql="delete from bq_dashhall";
		$sql=$sql." where venue='".$_GET['venue']."' AND session='".$_GET['session']."' AND funtion_date='".$_GET['book_date']."' AND confirm_status='6'";
		$result=mysql_query($sql);
		
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');
$curdate=$rowAC['cur_date'];
$dtr = explode('-',$_POST['from_date']);
$dy = $dtr[0].'/'.$dtr[1].'/'.$dtr[2];
		
		
		$sqlBl="UPDATE bq_hallbooking SET ";
		$sqlBl=$sqlBl."confirm_status='1',";
		$sqlBl=$sqlBl."added_by='".$added_by."',";
		$sqlBl=$sqlBl."added_on='".$added_on."'";
		$sqlBl=$sqlBl." where venue='".$_GET['venue']."' AND session='".$_GET['session']."' AND book_date='".$_GET['book_date']."'";
		$UsQ=mysql_query($sqlBl);
		
		/* $sqBl="UPDATE dash_rmstats SET ";
		$sqBl=$sqBl."status='2'";
		$sqBl=$sqBl." where room_no='".$_POST['room_no']."' AND resv_no='blk' AND status='1'";
		$UsBl=mysql_query($sqBl); */
		
		if($UsQ){
			header('location:'.$home_path.'/transaction/frontdesk/view-block-hall.php?msg=Hall released Successfully!');
		}
		else{
			header('location:'.$home_path.'/transaction/frontdesk/view-block-hall.php?msg=Error in updation');
		}
		
		
}
			