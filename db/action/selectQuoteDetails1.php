<?php  
ob_start();
session_start();
require_once("../dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM quotation WHERE rfq_no like '" . $_POST["keyword"] . "%' ORDER BY quote_id LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectRFQ('<?php echo $country["rfq_no"]; ?>');"><?php echo $country["rfq_no"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>

 
