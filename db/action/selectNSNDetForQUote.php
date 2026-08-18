<?php  
ob_start();
session_start();
require_once("../dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM partnumber WHERE nsnnumber like '" . $_POST["keyword"] . "%' ORDER BY partno_id LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectNSNDEt('<?php echo $country["nsnnumber"]; ?>');"><?php echo $country["nsnnumber"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>

 
