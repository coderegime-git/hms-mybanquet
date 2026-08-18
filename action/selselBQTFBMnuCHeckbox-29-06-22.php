<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$menu=$_GET['menu'];
$bkNo=$_GET['bkNo'];
$hdm=$_GET['hdm'];
//$val=$_GET['val'];
$output="";
$outMnu="";

	
$hid_regsp=$hdm;
$hidRrR=trim($hid_regsp, ',');
$rmNSpt=explode(',',$hidRrR);
//print_r ($rmNSpt);
$cnt=count($rmNSpt);
$sqlQ=mysql_query("select * from bq_menumaster where status='1' and menu_code='".$menu."'");
$rowQ=mysql_fetch_array($sqlQ);

for($cc=0;$cc<count($rmNSpt);$cc++) {
$sqlLk="UPDATE bq_tempfp SET ";
$sqlLk=$sqlLk."status='0'";
$sqlLk=$sqlLk." where item_code!='".$rmNSpt[$cc]."' AND bkNo='".$bkNo."'" ;
//echo $sqlLk;
$UsQLk =mysql_query($sqlLk);
	
}


for($ia=0;$ia<count($rmNSpt);$ia++) {
	
$sqlLk="UPDATE bq_tempfp SET ";
$sqlLk=$sqlLk."status='2'";
$sqlLk=$sqlLk." where item_code='".$rmNSpt[$ia]."' AND bkNo='".$bkNo."'" ;
$UsQLk =mysql_query($sqlLk);
	
}




/*$outMnu.='<table class="tree" style="font-size:10px;font-weight:bold;">
 <tbody>';
$sqlt=mysql_query("select distinct mnugrpcode from bq_tempfp where status='2' AND bkNo='".$bkNo."' and mnugrpcode!=''");
while($row=mysql_fetch_array($sqlt)){
	$outMnu.='<tr class="treegrid-1 expanded"><td>'.strtoupper($row['mnugrpcode']).'</td></tr>';
$sqll=mysql_query("select * from bq_tempfp where status='2' AND mnugrpcode='".$row['mnugrpcode']."' group by item_code");
$x=1;
while($roww=mysql_fetch_array($sqll)){
$x++;
    $outMnu.='<tr class="treegrid-2 treegrid-parent-1"><td>'.strtoupper($roww['item_name']).'</td></tr>';
}
}
  $outMnu.='</tbody>
</table>';*/

$outMnu.='<table class="tree" style="font-size:10px;font-weight:bold;">
 <tbody>';
$sqlt=mysql_query("select distinct mnugrpcode,bkNo from bq_tempfp where status='2' AND bkNo='".$bkNo."' and mnugrpcode!=''");
while($row=mysql_fetch_array($sqlt)){
	$outMnu.='<tr class="treegrid-1 expanded"><td>'.strtoupper($row['mnugrpcode']).'</td></tr>';
$sqll=mysql_query("select * from bq_tempfp where status='2' AND mnugrpcode='".$row['mnugrpcode']."' and bkNo='".$row['bkNo']."' group by item_code");
$x=1;
while($roww=mysql_fetch_array($sqll)){
$x++;
    $outMnu.='<tr class="treegrid-2 treegrid-parent-1"><td>'.strtoupper($roww['item_name']).'</td></tr>';
}
}
  $outMnu.='</tbody>
</table>';
if($cnt > $rowQ['allow_qty'] ){
	$output='Item exceeds Allow Qty';
}
 echo $outMnu.'&#'.$output; 
 
?>
