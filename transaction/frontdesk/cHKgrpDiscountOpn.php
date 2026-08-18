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
            var txtName = window.opener.document.getElementById("kot_table"); 
            /* var txtName = nme;
            txtName.value = document.getElementById("outlet_name").value; */
            txtName.value = nme;
        }
        window.close();
    }
</script>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_group_discBill.php" method="post" class="" style="">
<table cellpadding="0" cellspacing="0" class="table table-condensed table-hover table-striped table-bordered" border="0" style="margin:4px 0 0 125px;width:15%;" >
<thead>
<th style="font-size:12px;">Group</th>
<th style="font-size:12px;">Discount</th>
</thead>
<tbody>
<tr>
	<td valign="top" style="width:200px;"><input type="text" name="kot_food" id="kot_food" value="Food" class="buttExaSS" style="width:55px;border:none;" readonly /></td>
	<td valign="top"><input type="text" name="openL" id="openL" value="" class="buttExaSS" style="width:55px;" onclick="SetName('<?php echo $rowRt['table_no'];?>');"/></td>
</tr>
<tr>
	<td valign="top" style="width:200px;"><input type="text" name="kot_bev" id="kot_bev" value="Beverage" class="buttExaSS" style="width:55px;border:none;" readonly /></td>
	<td valign="top"><input type="text" name="openL" id="openL" value="" class="buttExaSS" style="width:55px;" /></td>
</tr>
<tr>
	<td valign="top" style="width:200px;"><input type="text" name="kot_smok" id="kot_smok" value="Smokes" class="buttExaSS" style="width:55px;border:none;" readonly /></td>
	<td valign="top"><input type="text" name="openL" id="openL" value="" class="buttExaSS" style="width:55px;"/></td>
</tr>
<tr>
	<td valign="top" style="width:200px;"><input type="text" name="kot_liqr" id="kot_liqr" value="Liquor" class="buttExaSS" style="width:55px;border:none;" readonly /></td>
	<td valign="top"><input type="text" name="openL" id="openL" value="" class="buttExaSS" style="width:55px;" /></td>
</tr>
<tr>
	<td valign="top" style="width:200px;"><input type="text" name="kot_other" id="kot_other" value="Others" class="buttExaSS" style="width:55px;border:none;" readonly /></td>
	<td valign="top"><input type="text" name="openL" id="openL" value="" class="buttExaSS" style="width:55px;"/></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" class="table table-condensed table-hover table-striped table-bordered" border="0" 
<tr>
	<td valign="top" style="font-size:12px;"><label>Reason</label>
	<td valign="top" style="" colspan="2"><textarea style="width:312px;height:50px;" name="kot_reas" id="kot_reas"></textarea></td>
</tr>
</tbody>
</table>
<table style="border-left:1px solid #ddd;" class="table">
	<tr>
	<td>	
<div style="margin:0px 0 0px 0px;">
	<button type="submit" id="billsbt" class="buttExaSS bnkSbt" >&nbsp;&nbsp;<span class="btnUndLine">S</span>ave</button>
	
	<button type="button" id="billsbt" class="buttExaSS bnkSbt" onclick="self.close();" ><span class="btnUndLine">E</span>xit</button>
	
</div>
</td>
</tr>
</table>
</form>















