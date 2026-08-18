<?php  
ob_start();

require_once("../dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM company_master WHERE comp_name like '" . $_POST["keyword"] . "%' ORDER BY company_id LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectRFQ('<?php echo $country["comp_code"]; ?>');"><?php echo $country["comp_name"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>

 
