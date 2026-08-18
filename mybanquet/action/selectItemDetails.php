<?php  
ob_start();

require_once("../dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM pos_itemmaster WHERE item_code like '%" . $_POST["keyword"] . "%'";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectItem('<?php echo $country["item_code"]; ?>');"><?php echo $country["item_code"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>

 
