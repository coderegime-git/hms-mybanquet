<?php  
ob_start();

include("../config.php");
$added_on = date('Y-m-d H:i:s');
$added_by = $_SESSION['user'];

$taxdet_id = isset($_POST['taxdet_id']) ? mysql_real_escape_string($_POST['taxdet_id']) : '1';
$hall_tax = isset($_POST['hall_tax']) ? mysql_real_escape_string($_POST['hall_tax']) : '';
$food_tax = isset($_POST['food_tax']) ? mysql_real_escape_string($_POST['food_tax']) : '';
$adv_tax = isset($_POST['adv_tax']) ? mysql_real_escape_string($_POST['adv_tax']) : '';

$sqll = "UPDATE bq_taxdetail SET ";
$sqll .= "hall_tax='" . $hall_tax . "',";
$sqll .= "food_tax='" . $food_tax . "',";
$sqll .= "adv_tax='" . $adv_tax . "',";
$sqll .= "added_by='" . $added_by . "',";
$sqll .= "added_on='" . $added_on . "'";
$sqll .= " where taxdet_id='" . $taxdet_id . "'";

$resultt = mysql_query($sqll);

if ($resultt) {
    $msg = 'Data modified successfully!';
    header('location:' . $home_path . '/masters/banquet/view_tax_det.php?msg=' . $msg);
} else {
    $msg = 'Error in updation';
    header('location:' . $home_path . '/masters/banquet/view_tax_det.php?msg=' . $msg);    
}
?>