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
 label {/* width: 190px; */ padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;text-align:left;font-size:13px;padding: 0 0 0 107px;} 
 
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
	$('#reservTable')[ ($("option[value='mastrreser']").is(":checked"))? "show" : "hide" ](); 
	$('#transcTable')[ ($("option[value='mastransac']").is(":checked"))? "show" : "hide" ]();
	$('#accountsTable')[ ($("option[value='accounts']").is(":checked"))? "show" : "hide" ]();
	$('#reportsTable')[ ($("option[value='reports']").is(":checked"))? "show" : "hide" ]();
	$('#databaseTable')[ ($("option[value='database']").is(":checked"))? "show" : "hide" ]();
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
<div class="col-md-6 frmCentr" style="width:61%;">
<div style="margin:6px 0 6px 640px;">
</div>
<form name="userfrm" id="userfrm" action="<?php echo $home_path;?>/action/update_access_perm.php" method="post" class="payForm" style="border:1px solid #ddd;">
		<input type="hidden" value="<?php echo $_GET['userId']; ?>" name="user_id" id="user_id" />
		<div style="margin:0 0 0 0;border:1px solid #ddd;">
		<h3 id="Userhd"><b>User Access Rights</b></h3>
		
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
				<option value="mastrreser">Reservation</option>
				<option value="mastransac">Transaction</option>
				<option value="accounts">Accounts</option>
				<option value="reports">Reports</option>
				<option value="database">Database Backup</option>
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
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="hms_para" class="chk" value="hms_para" onclick="setMenu()" /></td>
				<td>Parameters</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="hms_all" class="chk chkChgPass groupHeadCheck" value="hms_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="hms_save" class="chk chkChgPass" value="hms_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="hms_modify" class="chk chkChgPass" value="hms_modify" onclick="setMenu()" /></td>
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
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="tax_types" class="chk" value="tax_types" onclick="setMenu()" /></td>
				<td>Tax Types</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="tax_all" class="chk chkAccess groupHeadCheck" value="tax_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="tax_save" class="chk chkAccess" value="tax_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="tax_modify" class="chk chkAccess" value="tax_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="tax_struct" class="chk" value="tax_struct" onclick="setMenu()" /></td>
				<td>Tax Structures</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="taxst_all" class="chk chkAccess groupHeadCheck" value="taxst_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="taxst_save" class="chk chkAccess" value="taxst_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="taxst_modify" class="chk chkAccess" value="taxst_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="ledg_master" class="chk" value="ledg_master" onclick="setMenu()" /></td>
				<td>Ledgers</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="ledg_all" class="chk chkAccess groupHeadCheck" value="ledg_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="ledg_save" class="chk chkAccess" value="ledg_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="ledg_modify" class="chk chkAccess" value="ledg_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="curr_mast" class="chk" value="curr_mast" onclick="setMenu()" /></td>
				<td>Currency</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="curr_all" class="chk chkAccess groupHeadCheck" value="curr_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="curr_save" class="chk chkAccess" value="curr_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="curr_modify" class="chk chkAccess" value="curr_modify" onclick="setMenu()" /></td>
			</tr>
			
			
			
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="nation_master" class="chk" value="nation_master" onclick="setMenu()" /></td>
				<td>Nationality</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="nation_all" class="chk chkAccess groupHeadCheck" value="nation_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="nation_save" class="chk chkAccess" value="nation_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="nation_modify" class="chk chkAccess" value="nation_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="meal_plan" class="chk" value="meal_plan" onclick="setMenu()" /></td>
				<td>Meal Plans</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="meal_all" class="chk chkAccess groupHeadCheck" value="meal_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="meal_save" class="chk chkAccess" value="meal_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="meal_modify" class="chk chkAccess" value="meal_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="room_type" class="chk" value="room_type" onclick="setMenu()" /></td>
				<td>Room Types</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="room_all" class="chk chkAccess groupHeadCheck" value="room_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="room_save" class="chk chkAccess" value="room_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="room_modify" class="chk chkAccess" value="room_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="type_bill" class="chk" value="type_bill" onclick="setMenu()" /></td>
				<td>Type of billing</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="type_all" class="chk chkAccess groupHeadCheck" value="type_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="type_save" class="chk chkAccess" value="type_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="type_modify" class="chk chkAccess" value="type_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="room_feat" class="chk" value="room_feat" onclick="setMenu()" /></td>
				<td>Room Features</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="roomfe_all" class="chk chkAccess groupHeadCheck" value="roomfe_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roomfe_save" class="chk chkAccess" value="roomfe_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roomfe_modify" class="chk chkAccess" value="roomfe_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="rate_master" class="chk" value="rate_master" onclick="setMenu()" /></td>
				<td>Rate Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="rate_all" class="chk chkAccess groupHeadCheck" value="rate_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="rate_save" class="chk chkAccess" value="rate_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="rate_modify" class="chk chkAccess" value="rate_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="room_master" class="chk" value="room_master" onclick="setMenu()" /></td>
				<td>Room Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="roomst_all" class="chk chkAccess groupHeadCheck" value="roomst_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="rm_save" class="chk chkAccess" value="rm_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="rm_modify" class="chk chkAccess" value="rm_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="pos_visit" class="chk" value="pos_visit" onclick="setMenu()" /></td>
				<td>Purpose of visit</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="pos_all" class="chk chkAccess groupHeadCheck" value="pos_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="pos_save" class="chk chkAccess" value="pos_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="pos_modify" class="chk chkAccess" value="pos_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="busin_mast" class="chk" value="busin_mast" onclick="setMenu()" /></td>
				<td>Business of source</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="busin_all" class="chk chkAccess groupHeadCheck" value="busin_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="busin_save" class="chk chkAccess" value="busin_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="busin_modify" class="chk chkAccess" value="busin_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="comp_mast" class="chk" value="comp_mast" onclick="setMenu()" /></td>
				<td>Company Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="comp_all" class="chk chkAccess groupHeadCheck" value="comp_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="comp_save" class="chk chkAccess" value="comp_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="comp_modify" class="chk chkAccess" value="comp_modify" onclick="setMenu()" /></td>
			</tr>
			
		</table>
		<!--End-->
	
<!--Reservation start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="reservTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="room_book" class="chk" value="room_book" onclick="setMenu()" /></td>
				<td>Room Booking</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="rmbk_all" class="chk chkLevemainte groupHeadCheck" value="rmbk_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="rmbk_save" class="chk chkLevemainte" value="rmbk_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="rombk_modify" class="chk chkLevemainte" value="rombk_modify" onclick="setMenu()" /></td>
			</tr>
		</table>
	<!--End-->
	
	<!--Reservation start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="transcTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="check_in" class="chk" value="check_in" onclick="setMenu()" /></td>
				<td>Check In</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="chek_all" class="chk chkLevemainte groupHeadCheck" value="chek_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chek_save" class="chk chkLevemainte" value="chek_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chek_modify" class="chk chkLevemainte" value="chek_modify" onclick="setMenu()" /></td>
			</tr>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="room_adva" class="chk" value="room_adva" onclick="setMenu()" /></td>
				<td>Room Advance</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="roadv_all" class="chk chkLevemainte groupHeadCheck" value="roadv_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roadv_save" class="chk chkLevemainte" value="roadv_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roadv_modify" class="chk chkLevemainte" value="roadv_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="link_room" class="chk" value="link_room" onclick="setMenu()" /></td>
				<td>Link Room</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="link_all" class="chk chkLevemainte groupHeadCheck" value="link_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="link_save" class="chk chkLevemainte" value="link_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="link_modify" class="chk chkLevemainte" value="link_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="refund_amt" class="chk" value="refund_amt" onclick="setMenu()" /></td>
				<td>Refund</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="refund_all" class="chk chkLevemainte groupHeadCheck" value="refund_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="refund_save" class="chk chkLevemainte" value="refund_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="refund_modify" class="chk chkLevemainte" value="refund_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="room_charg" class="chk" value="room_charg" onclick="setMenu()" /></td>
				<td>Charges</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="roomch_all" class="chk chkLevemainte groupHeadCheck" value="roomch_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roomch_save" class="chk chkLevemainte" value="roomch_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roomch_modify" class="chk chkLevemainte" value="roomch_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="room_allow" class="chk" value="room_allow" onclick="setMenu()" /></td>
				<td>Allowance</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="roomal_all" class="chk chkLevemainte groupHeadCheck" value="roomal_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roomal_save" class="chk chkLevemainte" value="roomal_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roomal_modify" class="chk chkLevemainte" value="roomal_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="check_out" class="chk" value="check_out" onclick="setMenu()" /></td>
				<td>Check Out</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="chkut_all" class="chk chkLevemainte groupHeadCheck" value="chkut_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkut_save" class="chk chkLevemainte" value="chkut_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkut_modify" class="chk chkLevemainte" value="chkut_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="night_audit" class="chk" value="night_audit" onclick="setMenu()" /></td>
				<td>Night Audit</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="ngtadt_all" class="chk chkLevemainte groupHeadCheck" value="ngtadt_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="ngtadt_save" class="chk chkLevemainte" value="ngtadt_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="ngtadt_modify" class="chk chkLevemainte" value="ngtadt_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="clear_room" class="chk" value="clear_room" onclick="setMenu()" /></td>
				<td>Clear Room</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="clearrm_all" class="chk chkLevemainte groupHeadCheck" value="clearrm_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="clearrm_save" class="chk chkLevemainte" value="clearrm_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="clearrm_modify" class="chk chkLevemainte" value="clearrm_modify" onclick="setMenu()" /></td>
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
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="accou_receiv" class="chk" value="accou_receiv" onclick="setMenu()" /></td>
				<td>Accounts Receivable</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="accou_all" class="chk chkAttchlst groupHeadCheck" value="accou_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="accou_save" class="chk chkAttchlst" value="accou_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="accou_modify" class="chk chkAttchlst" value="accou_modify" onclick="setMenu()" /></td>
			</tr>
		</table>
		<!--End-->	
		
		<!--Library start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="reportsTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkout_det" class="chk" value="chkout_det" onclick="setMenu()" /></td>
				<td>Checkout Details</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="chkout_all" class="chk chkAttchlst groupHeadCheck" value="chkout_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkout_save" class="chk chkAttchlst" value="chkout_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkout_modify" class="chk chkAttchlst" value="chkout_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roomadvrt_det" class="chk" value="roomadvrt_det" onclick="setMenu()" /></td>
				<td>Room Adv Details</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="roomadvrt_all" class="chk chkAttchlst groupHeadCheck" value="roomadvrt_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roomadvrt_save" class="chk chkAttchlst" value="roomadvrt_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="roomadvrt_modify" class="chk chkAttchlst" value="roomadvrt_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="occupy_det" class="chk" value="occupy_det" onclick="setMenu()" /></td>
				<td>Occupancy Details</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="occupy_all" class="chk chkAttchlst groupHeadCheck" value="occupy_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="occupy_save" class="chk chkAttchlst" value="occupy_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="occupy_modify" class="chk chkAttchlst" value="occupy_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="polirt_det" class="chk" value="polirt_det" onclick="setMenu()" /></td>
				<td>Police Report</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="polirt_all" class="chk chkAttchlst groupHeadCheck" value="polirt_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="polirt_save" class="chk chkAttchlst" value="polirt_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="polirt_modify" class="chk chkAttchlst" value="polirt_modify" onclick="setMenu()" /></td>
			</tr>
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkout_sumry" class="chk" value="chkout_sumry" onclick="setMenu()" /></td>
				<td>Checkout Summary</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="chkouts_all" class="chk chkAttchlst groupHeadCheck" value="chkouts_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkouts_save" class="chk chkAttchlst" value="chkouts_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="chkouts_modify" class="chk chkAttchlst" value="chkouts_modify" onclick="setMenu()" /></td>
			</tr>
		</table>
		<!--End-->	
		<!--Reports start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="databaseTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="data_backup" class="chk" value="data_backup" onclick="setMenu()" /></td>
				<td>Database Backup</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="databk_all" class="chk chkAttchlst groupHeadCheck" value="databk_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="databk_save" class="chk chkAttchlst" value="databk_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="databk_modify" class="chk chkAttchlst" value="databk_modify" onclick="setMenu()" /></td>
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
	<div style="">
		<button type="submit" name="Update" id="Update" class="buttonExaA" style="" onclick="UpdateForm()"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<button type="button" name="view" id="view" class="buttonExaA updateACCViewBTN" onclick="editPermissions('<?php echo $row['user_name']; ?>','<?php echo $row['menu_id']; ?>');" style="cursor:pointer;"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button>
			
		<button type="reset" id="rest" class="buttonExaA" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:18px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttonExaA" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
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





