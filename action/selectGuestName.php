<?php  

include("../config.php");
$room_no=$_GET['room_no'];


$sql="select * from guest_register gr, guest_trans gt where gr.room_no='".$room_no."' AND gt.room_no='".$room_no."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'";
/* $sql="select guest_name from guest_register where room_no='$room_no'"; */
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$guest_name=$row['guest_name'];
echo ucfirst($guest_name); 


?>