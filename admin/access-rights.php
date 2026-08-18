<?php
include("../includes/header.php");
/* include("config.php"); */
 ?>
<style>
 label {/* width: 190px;  padding:0 20px 0 20px;*/ display: inline-block;font-weight: bold;color: #000;text-align:left;font-size:13px;padding: 0 0 0 239px;width: 375px;} 
 #accessTBlTH{text-align:center;}
	input[type="checkbox"] {
		width:25px;
	}
</style>
<script type="text/javascript" src="jquery.js"></script>
<script>
$(document).ready(function(){
	$("#msgFo").fadeOut(5000);
	
  	$('#module_name').change(function(){
        $('#adminTable')[ ($("option[value='adminMenu']").is(":checked"))? "show" : "hide" ]();  
        $('#hmsperTable')[ ($("option[value='hmsPer']").is(":checked"))? "show" : "hide" ](); 
		$('#transaTable')[ ($("option[value='mastransac']").is(":checked"))? "show" : "hide" ](); 
		$('#reportTable')[ ($("option[value='masreport']").is(":checked"))? "show" : "hide" ]();
    });
	$(function ($) {
		$(".groupHeadCheck").on("click", function (event) {
			$(this).closest('td').nextUntil('td.groupHead').find('input[type="checkbox"]').prop('checked', this.checked)
		})
	});
});


function getUserID(){
userName=$('#user_name').val();
$.ajax({
	type:'GET',
	url:'../action/getuserIDfromuserName.php',
		data:{
		userName:userName
		},
		success:function(data){
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
 $('#user_name').attr('disabled','disabled');
	$('.chk').each(function(i,v){
	 $(this).attr('disabled','disabled');
	}); 
	$('#add').hide();
	$('#Update').hide();
	$('#edit').show();
}


function frmValid(){
	
 $('#user_name').removeAttr("disabled");	
}


/* function getMenuId() {
val=$('#user_name').val();
document.location="access-rights.php?username="+val;
} */


function editsave(){
	var menuStr="";
	if($('#edit').val()=='Edit')
	{
	$('#user_name').removeAttr('disabled');
	$('#password').removeAttr('disabled');
	$('.chk').each(function(i,v){
	$(this).removeAttr('disabled');
	});
	//$('#edit').val('Update');
	$('#edit').hide();
	$('#add').hide();

	$('#Update').show();

	$("#thisform").attr("action","../action/update_access_perm.php");
	}
	else
	{
	$('.chk').each(function(i,v){
	if($(this).is(':checked'))
	{
	menuStr +=$(this).val()+',';
	}
	});

	
menuStr = menuStr.slice(0,-1);
act=$('#edit').val();
user_name = $('#user_name').val();
password  = $('#password').val();
id = $('#hid_id').val();
	$.ajax({
	type:'POST',	
	url:'update_access_perm.php',
	data:{
	id:id,
	act:act,
	user_name:user_name,
	password:password,
	menuStr:menuStr
	},
	success:function(data) {
	/* alert(data); */
}
});
	}
}
	
	
function UpdateForm(){
		/* alert('update'); */
	$("#accessfrm").load("../action/update_access_perm.php");	
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
<div class="col-md-6 addcustomer"  style="margin:0 0 0 52px;width:90%;">
<div style="margin:6px 0 6px 640px;">
<a href="update-access-rights.php"><button type="button" name="view" id="view" class="button_example bnkSbt" onclick="return checkpass();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View Permission</button></a>
</div>
<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>User Acces Rights</b></h3>
<form name="userfrm" id="accessfrm" action="<?php echo $home_path;?>/action/access_permission.php" method="post" class="payForm">
		<input type="hidden" value="<?php echo $_GET['userId']; ?>" name="user_id" id="user_id" />
		<table style="text-align:center;margin:0 0 0 0px;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
			   <tr>
				<td width="150" valign="top"><label>User Name:</label></td>
						<td valign="top">
						<select name="user_name" id="user_name" onChange="getMenuId();" style="width:180px;">
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
						</td>
		<input type="hidden" name="user_id" id="user_id" value=""/>
		</tr>
				
		 <tr>
				<td width="150" valign="top"><label>Module Name:</label></td>
						<td valign="top">
				<select name="module_name" id="module_name" onChange="getUserID();" style="width:180px;">
				<option value="">--Select--</option>
				<option value="adminMenu">Admin</option>
				<option value="hmsPer">Masters</option>
				<option value="mastransac">Operations</option>
				<option value="masreport">Quotation</option>
			</select>
		<input type="hidden" name="user_id" id="user_id" value=""/>
		</td>
		</tr>
		</tbody>
	</table>
<style>
table,th,tr,td{
font-size:12px;}
</style>
		<!--ADMIN start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="adminTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
	<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="user_masters" class="chk" value="user_masters" onclick="setMenu()" /></td>
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
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="parameters" class="chk" value="parameters" onclick="setMenu()" /></td>
				<td>Parameters</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="parameters_all" class="chk chkparam groupHeadCheck" value="parameters_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="param_save" class="chk chkparam" value="param_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="param_modify" class="chk chkparam" value="param_modify" onclick="setMenu()" /></td>
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
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="pay_group" class="chk " value="pay_group" onclick="setMenu()" /></td>
				<td>Property Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="pay_all" class="chk chkAdmin groupHeadCheck" value="pay_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="pay_save" class="chk chkAdmin" value="pay_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="pay_modify" class="chk chkAdmin" value="pay_modify" onclick="setMenu()" /></td>
			</tr>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="unit_master" class="chk" value="unit_master" onclick="setMenu()" /></td>
				<td>Vendor Master</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="unit_all" class="chk chkAccess groupHeadCheck" value="unit_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="unit_save" class="chk chkAccess" value="unit_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="unit_modify" class="chk chkAccess" value="unit_modify" onclick="setMenu()" /></td>
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
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="leave_mainten" class="chk" value="leave_mainten" onclick="setMenu()" /></td>
				<td>Operations</td>
				<td style="text-align:center;"><input type="checkbox" name="" id="leavemaint_all" class="chk chkLevemainte groupHeadCheck" value="leavemaint_all" onclick="checkAdmin();" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="leavemaint_save" class="chk chkLevemainte" value="leavemaint_save" onclick="setMenu()" /></td>
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="leavemaint_modify" class="chk chkLevemainte" value="leavemaint_modify" onclick="setMenu()" /></td>
			</tr>
			
		</table>
	<!--End-->
	
	
	<!--REPORT start-->
		<table border="2" cellspacing="0" cellpadding="0" width="100%" id="reportTable" class="table" style="display:none;">
			<thead>
				<th id="accessTBlTH"></th>
				<th id="accessTBlTH">Screen Name</th>
				<th id="accessTBlTH">All</th>
				<th id="accessTBlTH">Save</th>
				<th id="accessTBlTH">Modify</th>
			</thead>
			
			<tr class="ui-grid groupHead">
				<td style="text-align:center;"><input type="checkbox" name="menu_id[]" id="attend_checklist" class="chk" value="attend_checklist" onclick="setMenu()" /></td>
				<td>Quotation</td>
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
		
		<div style="text-align:center;">
			<button type="submit" name="add" id="add" class="button_example updateBTN" onclick="return checkpass();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Add Permission</button>
		
			<!--<a href="update-access-rights.php"><button type="button" name="view" id="view" class="button_example bnkSbt" onclick="return checkpass();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View Permission</button></a>-->
		</div>
		
<?php /* include("../footer.php");  */?>


	</form>
</div>
</div>

</body>





