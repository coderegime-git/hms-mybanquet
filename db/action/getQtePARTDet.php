<?php  
session_start();
include("../config.php");

$partNM=$_GET['partNM'];
/* echo $partNM; */
$i=0;
$menuStr="";
foreach($_GET['partNM'] as $menuId)
{
	$i++;
	if($i<sizeof($_GET['partNM']))
	{
		$menuStr .=$menuId.',';
	}
	else
	{
		$menuStr .=$menuId;
	}
}

/* echo $menuStr; */

/* echo "select * from partnumber where partnumber='$menuStr'"; */

$sql=mysql_query("select * from partnumber where partnumber='$menuStr'");
$nsnNumber="";
/* $nsnNumber.='<option value="">--Select--</option>'; */
	while($row=mysql_fetch_array($sql)){
		$partname=$row['partname'];
		if($menuStr==$row['partnumber']){
			$nsnNumber.='<option value="'.$row['nsnnumber'].'" selected>'.$row['nsnnumber'].'</option>'; 
		}else{
			$nsnNumber.='<option value="'.$row['nsnnumber'].'">'.$row['nsnnumber'].'</option>'; 			
		}
	}
 
 echo $nsnNumber.','.$partname; 

?>