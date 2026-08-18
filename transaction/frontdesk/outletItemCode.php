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
    function SetName(cde,nm,qt,rt) {
		/* if (window.opener != null && !window.opener.closed) { */
			cntT=document.getElementById("cntT").value; 
		/* 	cntT=$('#cntT').val(); */
		    var txtName = window.opener.document.getElementById("item_code"+cntT); 
		    var txtDesc = window.opener.document.getElementById("item_desc"+cntT); 
		     var txtQty = window.opener.document.getElementById("item_qty"+cntT); 
		     var txtQty = window.opener.document.getElementById("item_qty"+cntT); 
		     var txtRte = window.opener.document.getElementById("item_rate"+cntT); 
			
            /* var txtName = nme;
            txtName.value = document.getElementById("outlet_name").value; */
            txtName.value = cde;
            txtDesc.value = nm;
            txtQty.value = qt;
            txtRte.value = rt;
			txtQty.focus();
       /*  } */
        window.close();
    }
</script>
<table cellpadding="0" cellspacing="0" class="table table-condensed table-hover table-striped table-bordered" border="0" style="margin:4px 0 0 0;" >
<tbody>
<input type="hidden" name="cntT" id="cntT" value="<?php echo $_GET['cnt'];?>" class="buttExaSS" style="width:55px;border:none;" readonly />
<?php $sqlRt=mysql_query("select item_code,item_name,item_rate from pos_itemmaster");?>
<?php while($rowRt=mysql_fetch_array($sqlRt)){ ?>
<tr>
	<td valign="top" style="width:200px;"><input type="text" name="item_code" id="item_code" value="<?php echo $rowRt['item_code'];?>" class="buttExaSS" style="width:55px;border:none;" readonly /></td>
	<td valign="top" style="width:200px;"><input type="text" name="item_name" id="item_name" value="<?php echo $rowRt['item_name'];?>" class="buttExaSS" style="width:55px;border:none;" readonly /></td>
	<td valign="top"><input type="button" name="openL" id="openL" value="Open" class="buttExaSS" style="width:55px;" onclick="SetName('<?php echo $rowRt['item_code'];?>','<?php echo $rowRt['item_name'];?>','<?php echo '1';?>','<?php echo $rowRt['item_rate'];?>');"/></td>
</tr>
<?php } ?>
</tbody>
</table>