<?php  
ob_start();
session_start();
require_once("../dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT distinct rfq_no FROM vendor_allocation WHERE rfq_no like '" . $_POST["keyword"] . "%' ORDER BY vendorallot_id LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $countr) {
?>
<li onClick="selectVeRFQ('<?php echo $countr["rfq_no"]; ?>');"><?php echo $countr["rfq_no"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>

 
