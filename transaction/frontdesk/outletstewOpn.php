<?php
ob_start();
include("../../config.php");
?>
<link href="<?php echo $home_path; ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<style>
.buttExaSS {
    background-color: #ffffff;
    border: 1px solid #888888;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
   /*  margin-left: -3px; */
    padding: 2px 0px;
    /* padding: 5px 59px; */
	width:154px;
}
</style>
<script type="text/javascript">
    function SetName(nme) {
		if (window.opener != null && !window.opener.closed) {
            var txtName = window.opener.document.getElementById("kot_steward"); 
            /* var txtName = nme;
            txtName.value = document.getElementById("outlet_name").value; */
            txtName.value = nme;
        }
        window.close();
    }
</script>
<table cellpadding="0" cellspacing="0" class="table table-condensed table-hover table-striped table-bordered" border="0" style="margin:4px 0 0 0;" >
<tbody>
<?php $sqlRt=mysql_query("select stew_code,stew_name from pos_stewart");?>
<?php while($rowRt=mysql_fetch_array($sqlRt)){ ?>
<tr>
	<td valign="top" style="width:200px;"><input type="text" name="outlet_name" id="outlet_name" value="<?php echo $rowRt['stew_code'];?>" class="buttExaSS" style="width:55px;border:none;" readonly /></td>
	<td valign="top" style="width:200px;"><input type="text" name="outlet_name" id="outlet_name" value="<?php echo $rowRt['stew_name'];?>" class="buttExaSS" style="width:55px;border:none;" readonly /></td>
		
	<td valign="top"><input type="button" name="openL" id="openL" value="Open" class="buttExaSS" style="width:55px;" onclick="SetName('<?php echo $rowRt['stew_code'];?>');"/></td>
</tr>
<?php } ?>
</tbody>
</table>