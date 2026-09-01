<?php
ob_start();

include("../config.php");
$added_on = date('Y-m-d H:i:s');
$added_by = $_SESSION['user'];

$hall_tax = isset($_POST['hall_tax']) ? mysql_real_escape_string($_POST['hall_tax']) : '';
$food_tax = isset($_POST['food_tax']) ? mysql_real_escape_string($_POST['food_tax']) : '';
$adv_tax = isset($_POST['adv_tax']) ? mysql_real_escape_string($_POST['adv_tax']) : '';

$sqlTx = mysql_query("select * from bq_taxdetail");
if ($sqlTx && mysql_num_rows($sqlTx) > 0) {
    $sqll = "UPDATE bq_taxdetail SET ";
    $sqll .= "hall_tax='" . $hall_tax . "',";
    $sqll .= "food_tax='" . $food_tax . "',";
    $sqll .= "adv_tax='" . $adv_tax . "',";
    $sqll .= "added_by='" . $added_by . "',";
    $sqll .= "added_on='" . $added_on . "'";
    $sqll .= " where taxdet_id='1'";
    $UsQuery = mysql_query($sqll);
} else {
    $sql = "insert into bq_taxdetail(hall_tax,food_tax,adv_tax,added_by,added_on)";
    $sql .= " values(";
    $sql .= "'" . $hall_tax . "',";
    $sql .= "'" . $food_tax . "',";
    $sql .= "'" . $adv_tax . "',";
    $sql .= "'" . $added_by . "',";
    $sql .= "'" . $added_on . "')";
    $UsQuery = mysql_query($sql);  
}

if ($UsQuery) {
    header('location:' . $home_path . '/masters/banquet/view_tax_det.php?msg=Data saved successfully!');
} else {
    header('location:' . $home_path . '/masters/banquet/view_tax_det.php?msg=Error in insertion');
}
?>