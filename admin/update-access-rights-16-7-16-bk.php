<?php
ob_start();
include("../includes/header.php");
/* include("config.php"); */
?>
<!--form validation-->	
<link rel="stylesheet" href="../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!---//-form valid---->
<style>
 label {/* width: 190px; */ padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;text-align:left;font-size:13px;padding: 0 0 0 239px;} 
 
 /* .accessDiv {
    background-color: #ddf4fc;
    border: 1px solid #1f4785;
    box-shadow: 4px 4px 4px #b8b8b8;
    margin: 20px 0 0 157px;
    width: 63%;
} */

</style>

<script>
$(document).ready(function(){
	 $("#msgFo").fadeOut(5000); 
jQuery("#userfrm").validationEngine();
$('#module_name').change(function(){
	$('#adminTable')[ ($("option[value='adminMenu']").is(":checked"))? "show" : "hide" ]();  
	$('#hmsperTable')[ ($("option[value='hms']").is(":checked"))? "show" : "hide" ]();  
	$('#transaTable')[ ($("option[value='mastransac']").is(":checked"))? "show" : "hide" ](); 
	$('#accountsTable')[ ($("option[value='accounts']").is(":checked"))? "show" : "hide" ]();
	$('#libraryTable')[ ($("option[value='library']").is(":checked"))? "show" : "hide" ]();
	$('#reportsTable')[ ($("option[value='reports']").is(":checked"))? "show" : "hide" ]();
});
	$(function ($) {
		$(".groupHeadCheck").on("click", function (event) {
			$(this).closest('td').nextUntil('td.groupHead').find('input[type="checkbox"]').prop('checked', this.checked)
		})
	});
});
 shortcut.add("Ctrl+S",function() { 
	 $('#userfrm').attr('action', '../action/update_access_perm.php');  
	 $('#userfrm').submit(); 
}); 

 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../dashboard.php";
});

function getUserID() {
userName=$('#user_name').val();
$.ajax({
	type:'GET',
	url:'../action/getuserIDfromuserName.php',
		data:{
		userName:userName
		},
		success:function(data){
			/* alert(data); */
		$('#user_id').val(data);
		}
	}); 
}


function setMenu()
{
	var menuStr="";
	$('.chk').each(function(i,v){
		if($(this).is(':checked'))
		{
		menuStr +=$(this).val()+',';
		}
	});
	menuStr = menuStr.slice(0,-1);
	$("#hid_menu").val(menuStr);
}


function editPermissions(name,per){
	/* alert(per); */
if(per==""){
	alert('You have not added access rights.');
}
$('.chk').each(function(i,v){
	 if($(this).is(':checked'))
	 {
	 $(this).removeAttr('checked');
	 }
}); 
	var x = per.split(',');
	for(i=0;i<x.length;i++)
	{
	 $('#'+x[i]).attr('checked','checked');
	}
 /* $('#user_name').attr('disabled','disabled');
	$('.chk').each(function(i,v){
	 $(this).attr('disabled','disabled');
	});  */
	$('#add').hide();
	$('#Update').show();
	$('#edit').hide();
	 $('#view').prop('disabled', true);
}


function frmValid(){
 $('#user_name').removeAttr("disabled");	
}


function getMenuId() {
val=$('#user_name').val();
document.location="update-access-rights.php?username="+val;
}

</script>


<body class="bgBODY">
<div id="container">
<?php 	
if(isset($_GET['msg'])){
?>
	<p>
		<label id="msgFo" class="msgNotify" style="width:90%;margin-left:54px;text-align:center;padding: 0;"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<div class="col-md-6" style="margin:0 0 0 52px;width:90%;">
<div style="margin:6px 0 6px 640px;">
<!--<a href="access-rights.php"><button type="button" name="add" id="" class="button_example updateBTN" onclick="return checkpass();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Add Permission</button></a>-->
</div>
<form name="userfrm" id="userfrm" action="<?php echo $home_path;?>/action/update_access_perm.php" method="post" class="payForm" style="border:1px solid #ddd;">
		<input type="hidden" value="<?php echo $_GET['userId']; ?>" name="user_id" id="user_id" />
		<div style="margin:0 0 0 0;border:1px solid #ddd;">
		<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>User Access Rights</b></h3>
		
		<table style="text-align:center;margin:9px 0 0 0px;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
			   <tr>
				<td width="150" valign="top"><label>User Name<span class="Hred">*</span>:</label></td>
				<td width="150" valign="top" style="padding:0 0 0 0;">
		<select name="user_name" id="user_name" onChange="getMenuId();" style="width:180px;" data-validation="required" class="input validate[required] textbox">
		<option value="">--Select--</option>
		<?php 
				if($_SESSION['user']=='admin'){
					$sql=mysql_query("select * from user where user_name!='admin'");
				}
				else{
					
				$sql=mysql_query("select * from user where user_name='".$_SESSION['user']."'");	
				}
				while($row=mysql_fetch_array($sql)){
				$user_name=$row['user_name'];
				if(isset($_GET['username'])){
		?> 
		<option value="<?php echo $user_name;?>" <?php echo ($user_name==$_GET['username'])?'selected':''; ?>> <?php echo $user_name;?></option>
				<?php }else{?>
		<option value="<?php echo $user_name;?>"> <?php echo $user_name;?></option>		
<?php				
				}
				} ?>
		</select>
			
		<input type="hidden" name="user_id" id="user_id" value=""/>
		</td>
		</tr>
				
		<tr>
			<td width="150" valign="top"><label>Module Name<span class="Hred">*</span>:</label></td>
			<td width="150" valign="top">
			<select name="module_name" id="module_name" onChange="getUserID();" style="width:180px;" data-validation="required" class="input validate[required] textbox">
				<option value="">--Select--</option>
				<option value="adminMenu">Admin</option>
				<option value="hms">Masters</option>
				<option value="mastransac">Operations</option>
				<option value="accounts">Accounts</option>
				<option value="library">Library</option>
				<option value="reports">Reports</option>
			</select>
			<input type="hidden" name="user_id" id="user_id" value=""/>
		</td>
		</tr>
		</tr>
		</tbody>
	</table>
	</div>
	<style>
	table,th,tr,td {
	font-size:12px;	
		/* background-color:#ebefec;#3c5944 */
	}
	
	#accessTBlTH{text-align:center;}
	input[type="checkbox"] {
		width:25px;
	}
	</style>
<!--ADMIN start-->
	<table border="2" cellspacing="0" cellpadding="0" width="30%" id="adminTable" class="table" style="display:none;">
			<thead style="">
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="user_masters" class="chk" value="user_masters" onclick="setMenu()" style="width: 25px;" /></td>
				<td>User Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="user_all" class="chk chkAdmin groupHeadCheck" value="user_all" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="user_save" class="chk chkAdmin" value="user_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="user_modify" class="chk chkAdmin" value="user_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="access_rights" class="chk" value="access_rights" onclick="setMenu()" /></td>
				<td>Access Rights</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="access_all" class="chk chkAccess groupHeadCheck" value="access_all" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="access_save" class="chk chkAccess" value="access_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="access_modify" class="chk chkAccess" value="access_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="change_password" class="chk" value="change_password" onclick="setMenu()" /></td>
				<td>Change Password</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="change_all" class="chk chkChgPass groupHeadCheck" value="change_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="change_save" class="chk chkChgPass" value="change_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="change_modify" class="chk chkChgPass" value="change_modify" onclick="setMenu()" /></td>
			</tr>
		</table>
		<!--End-->
		
		
		<!--HMS PERSONNEL-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="hmsperTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH">&nbsp;</th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="prop_master" class="chk " value="prop_master" onclick="setMenu()" /></td>
				<td>Property Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="prop_all" class="chk chkAdmin groupHeadCheck" value="prop_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="prop_save" class="chk chkAdmin" value="prop_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="prop_modify" class="chk chkAdmin" value="prop_modify" onclick="setMenu()" /></td>
			</tr>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="vend_master" class="chk" value="vend_master" onclick="setMenu()" /></td>
				<td>Vendor Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="vend_all" class="chk chkAccess groupHeadCheck" value="vend_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="vend_save" class="chk chkAccess" value="vend_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="vend_modify" class="chk chkAccess" value="vend_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="client_master" class="chk" value="client_master" onclick="setMenu()" /></td>
				<td>Client Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="client_all" class="chk chkAccess groupHeadCheck" value="client_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="client_save" class="chk chkAccess" value="client_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="client_modify" class="chk chkAccess" value="client_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="part_master" class="chk" value="part_master" onclick="setMenu()" /></td>
				<td>Part Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="part_all" class="chk chkAccess groupHeadCheck" value="part_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="part_save" class="chk chkAccess" value="part_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="part_modify" class="chk chkAccess" value="part_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="setting_master" class="chk" value="setting_master" onclick="setMenu()" /></td>
				<td>Setting</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="setting_all" class="chk chkAccess groupHeadCheck" value="setting_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="setting_save" class="chk chkAccess" value="setting_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="setting_modify" class="chk chkAccess" value="setting_modify" onclick="setMenu()" /></td>
			</tr>
		</table>
		<!--End-->
	
<!--Transaction start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="transaTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="quote_operation" class="chk" value="quote_operation" onclick="setMenu()" /></td>
				<td>Quotation</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="quote_all" class="chk chkLevemainte groupHeadCheck" value="quote_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="quote_save" class="chk chkLevemainte" value="quote_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="quote_modify" class="chk chkLevemainte" value="quote_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="customer_po" class="chk" value="customer_po" onclick="setMenu()" /></td>
				<td>Customer PO</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="customer_all" class="chk chkLevemainte groupHeadCheck" value="customer_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="customer_save" class="chk chkLevemainte" value="customer_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="customer_modify" class="chk chkLevemainte" value="customer_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="unsucc_quote" class="chk" value="unsucc_quote" onclick="setMenu()" /></td>
				<td>Unsuccessful Quotes</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="unsucc_all" class="chk chkLevemainte groupHeadCheck" value="unsucc_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="unsucc_save" class="chk chkLevemainte" value="unsucc_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="unsucc_modify" class="chk chkLevemainte" value="unsucc_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="vendor_po" class="chk" value="vendor_po" onclick="setMenu()" /></td>
				<td>Vendor PO&JO</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="vendor_all" class="chk chkLevemainte groupHeadCheck" value="vendor_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="vendor_save" class="chk chkLevemainte" value="vendor_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="vendor_modify" class="chk chkLevemainte" value="vendor_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="vendor_inv" class="chk" value="vendor_inv" onclick="setMenu()" /></td>
				<td>Vendor Inv receipt</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="veninv_all" class="chk chkLevemainte groupHeadCheck" value="veninv_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="veninv_save" class="chk chkLevemainte" value="veninv_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="veninv_modify" class="chk chkLevemainte" value="veninv_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="packing_stand" class="chk" value="packing_stand" onclick="setMenu()" /></td>
				<td>Packing Standard</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="packing_all" class="chk chkLevemainte groupHeadCheck" value="packing_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="packing_save" class="chk chkLevemainte" value="packing_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="packing_modify" class="chk chkLevemainte" value="packing_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="label_print" class="chk" value="label_print" onclick="setMenu()" /></td>
				<td>Label Printing</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="label_all" class="chk chkLevemainte groupHeadCheck" value="label_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="label_save" class="chk chkLevemainte" value="label_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="label_modify" class="chk chkLevemainte" value="label_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="cust_inv" class="chk" value="cust_inv" onclick="setMenu()" /></td>
				<td>Customer Invoice</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="cust_all" class="chk chkLevemainte groupHeadCheck" value="cust_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="cust_save" class="chk chkLevemainte" value="cust_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="cust_modify" class="chk chkLevemainte" value="cust_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="payment_rcpt" class="chk" value="payment_rcpt" onclick="setMenu()" /></td>
				<td>Payment Receipt</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="payment_all" class="chk chkLevemainte groupHeadCheck" value="payment_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="payment_save" class="chk chkLevemainte" value="payment_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="payment_modify" class="chk chkLevemainte" value="payment_modify" onclick="setMenu()" /></td>
			</tr>
		</table>
	<!--End-->
	
	
	<!--Accounts start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="accountsTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="vendor_payment" class="chk" value="vendor_payment" onclick="setMenu()" /></td>
				<td>Vendor Payment</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="venpay_all" class="chk chkAttchlst groupHeadCheck" value="venpay_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="venpay_save" class="chk chkAttchlst" value="venpay_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="venpay_modify" class="chk chkAttchlst" value="venpay_modify" onclick="setMenu()" /></td>
			</tr>
		</table>
		<!--End-->	
		
		<!--Library start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="libraryTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="attend_checklist" class="chk" value="attend_checklist" onclick="setMenu()" /></td>
				<td>Library</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="attchlst_all" class="chk chkAttchlst groupHeadCheck" value="attchlst_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkAttchlst_save" class="chk chkAttchlst" value="chkAttchlst_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkAttchlst_modify" class="chk chkAttchlst" value="chkAttchlst_modify" onclick="setMenu()" /></td>
			</tr>
		</table>
		<!--End-->	
		<!--Reports start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="reportsTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="attend_checklist" class="chk" value="attend_checklist" onclick="setMenu()" /></td>
				<td>Reports</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="attchlst_all" class="chk chkAttchlst groupHeadCheck" value="attchlst_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkAttchlst_save" class="chk chkAttchlst" value="chkAttchlst_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkAttchlst_modify" class="chk chkAttchlst" value="chkAttchlst_modify" onclick="setMenu()" /></td>
			</tr>
		</table>
		<!--End-->	
		<?php 
			if(isset($_GET['username'])){
				$sql="select * from access_rights where user_name='".$_GET['username']."'";
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				$menu_id=$row['menu_id'];
				$user_id=$row['user_id'];
			} 
			 
		?>
		
		
<table style="" class="table" style="">
	<tr>
		<td style="">
	<div style="margin:19px 0 20px 310px">
		<button type="submit" name="Update" id="Update" class="button_example" style="" onclick="UpdateForm()"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<button type="button" name="view" id="view" class="button_example updateACCViewBTN" onclick="editPermissions('<?php echo $row['user_name']; ?>','<?php echo $row['menu_id']; ?>');" style="cursor:pointer;"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button>
			
		<button type="reset" id="rest" class="button_example" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:18px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	
</td>
</tr>
</table>	
	
	
		<!--<div style="text-align:center;/* margin:30px 0 0 260px; */">
					
			<button type="submit" name="Update" id="Update" class="button_example" style="font-weight:bold;" onclick="UpdateForm()"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Save</button>
			
			<button type="button" name="view" id="view" class="button_example updateACCViewBTN" onclick="editPermissions('<?php /* echo $row['user_name']; */ ?>','<?php/*  echo $row['menu_id']; */ ?>');" style="cursor:pointer;"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View </button>
			
			<a href="<?php /* echo $home_path; */ ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button></a>
			
			
		</div>-->
		
<?php /* include("../footer.php"); */ ?>


	</form>
</div>
</div>

</body>





