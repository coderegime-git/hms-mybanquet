<?php  
ob_start();
include("../config.php");

$menGrp = isset($_GET['menGrp']) ? mysql_real_escape_string($_GET['menGrp']) : '';

$sqlUnt = mysql_query("select * from bq_menugrp where (menu_code='$menGrp' OR menu_name='$menGrp') AND status='1'");
$menu_name = '';
if($sqlUnt && mysql_num_rows($sqlUnt) > 0) {
    $rowUnt = mysql_fetch_array($sqlUnt);
    $menu_name = $rowUnt['menu_name'];
    $menGrpCode = $rowUnt['menu_code'];
} else {
    $menGrpCode = $menGrp;
}

$sqlP = mysql_query("select distinct submenu_code,submenu_name from bq_submenugrp where subgrp_code='$menGrpCode' or subgrp_code='$menu_name' or subgrp_code='$menGrp'");
if($sqlP && mysql_num_rows($sqlP) > 0){
    $payC = '<option value="">--Select--</option>';
    while($rowP = mysql_fetch_array($sqlP)){
        $payC .= '<option value="'.$rowP['submenu_code'].'">'.$rowP['submenu_name'].'</option>';
    }
    echo $payC;
} else {
    $payC = '<option value="'.$menGrp.'">'.$menGrp.'</option>';
    echo $payC;
}
?>