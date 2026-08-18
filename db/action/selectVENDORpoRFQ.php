<?php  
ob_start();
session_start();
require_once("../dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT rfq_no FROM vendor_allocation WHERE rfq_no like '".$_POST["keyword"]."%'  AND status='Approved' ORDER BY vendorallot_id LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectRFQVn('<?php echo $country["rfq_no"]; ?>');"><?php echo $country["rfq_no"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>

 
