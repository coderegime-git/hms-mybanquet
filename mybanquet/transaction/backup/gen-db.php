<?php
include("../../config.php");
include('../../includes/session.php');
include('../../includes/header.php');
include('../../util.php');
include('../../pagination.class.php');

$curr_symbol=  getCurrancy();
?>
<div id="container">
        <div id="content">
          	<div id="addcustomer">
			<form action="db-backup.php" method="POST" name="thisform">
			<table style="float:left;width:98%;" cellpadding="0" cellspacing="0" border="0" class="table">	
			<tr>
				<td>
				<!--<input type="file" id="file" name="file" />-->
				<input type="text" id="path" name="path" value=""/>
				<input type="submit" name="db_save" id="db_save" class="submitbtn"  value="Save">
				</td>
				<td></td>
			</tr>
			</table>
			</form>
			</div>
		</div>
</div>