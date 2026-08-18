<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<script type="text/javascript">
$(document).ready(function() {
$("#msgFo").fadeOut(5000);
});
function downloadLink()
{
document.location.href="db-backup.php";
}
function downloadLinkNo()
{

}
</script>
<body>
<div id="container">
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="margin:10px 0 0 499px;">
		<label id="msgFo"class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<div style="border:1px solid #1f4785;/* background-color:#ddf4fc; */width:28%;margin:10px 0 10px 486px;box-shadow: 4px 4px 4px #b8b8b8;float:left;">
<form  name="bankfrm" id="bankfrm" action="<?php echo $home_path;?>/transaction/backup/db-backup.php" method="post" class="payForm">
<!--<div class="dbHeading">Database Backup</div>	-->
 <table cellpadding="0" cellspacing="0" border="0" style="margin:18px 0 0 103px;" >
	<tr>
		<td style="color:#ac4609;font-size:14px;font-weight:bold;">Do you want to download?</td>
	</tr>
	<tr>
		<td></td>
	</tr>
	<tr>
		<td align="center"><input type="submit" value="Yes" class="submitbtn" /></td>
	</tr>
</table>
</div>
</form>	
</div>
</div>
<?php /* include("../footer.php");  */?>
</body>