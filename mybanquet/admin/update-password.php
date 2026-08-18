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
<script type="text/javascript">
$(document).ready(function(){
	jQuery("#passwordfrm").validationEngine();
	
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(5000);
});


function getDetails(){
	user_namem=$('#username').val();
	/* alert(user_namem); */
	$.ajax({
		type:'GET',
		url:'../action/getDetailsforUser.php',
		data:{
			user_namem:user_namem
		},
		success:function(data){
			/* alert(data); */
		 var val = data.split(',');
		 email=$('#email').val(val[1]);
		 mobile=$('#mobile').val(val[2]);
		}
	});
}


function checkOldPassword(){
	 opass=$('#opass').val();
	 $.ajax({
		type:'GET',
		url:'../action/checkChangePassword.php',
		data:{
			opass:opass
		},
		success:function(data){
			if(data==0){
				msg="Old password does not match";
				alert(msg);
				/* opass_err=$('#opass_err').html(msg); */
				/* $('#opass').val(''); */
			}
			
		}
	});
}

function checkPasswordUpdate() {
	newNpass=$('#npass').val(); 
	newRpass=$('#repass').val(); 
	var status = true;	
	 if(newNpass!=newRpass){
		alert('New password and confirm password does not match.');
		status = false;
     } 
		if(!status){
			return false;
		}
		else
		{
			/* $("#reg-submit").val("Processing.."); */
		}
}
</script>
<body class="bgBODY">
<div class="about">
	<div class="container">
	<?php 	
		if(isset($_GET['msg'])){
		?>
			<p style="text-align:center;margin:0 0 0 -213px;">
				<label id="msgFo" class="msgNotify"style="/* color:#2677a7;width:220px;margin:0 0 0 112px; */"><?php echo $_GET['msg']; ?></label>
			</p>
		<?php } ?>
		<div class="col-md-12"  id="addcustomer" style="width:460px;margin:0 0 0 233px;">
			<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Update Password</b></h3>
		<div>
		<form name="userfrm" id="passwordfrm" action="<?php echo $home_path; ?>/action/password-update.php" method="post" class="payForm" style="border:1px solid #ddd;">
		
		<input type="hidden" value="<?php echo $_GET['userId']; ?>" name="user_id" id="user_id" />	
<table style="text-align:center;margin:0 0 0 0px;" cellpadding="0" cellspacing="0" class="table" border="0" >
	<tbody>
		<tr>
				<td width="575" valign="top"><label>User Name<span class="Hred">*</span>:</label></td>
				<td valign="top">
				<select name="username" id="username" data-validation="required" class="input validate[required] textbox" style="" onChange="getDetails();">
	<option value="">--Select--</option>
	<?php 	
		if($_SESSION['user']=='admin'){
			$sql=mysql_query("select * from user");
		}
		else{
			$sql=mysql_query("select * from user where user_name='".$_SESSION['user']."'");	
		}
			while($row=mysql_fetch_array($sql)){
			$user_name=$row['user_name'];
	?> 
	<option value="<?php echo $user_name;?>"><?php echo $user_name;?></option>
	<?php } ?>
	</select>
				</td>
				<td class='error_msg'> </td>
				<td class='error_field' id='name_error_msg' > </td>
				
		</tr>
		<tr>
				<td width="125" valign="top"><label>Old Password<span class="Hred">*</span>:</label></td>
				<td valign="top"><input type="password" name="opass" id="opass" Onblur="checkOldPassword();" data-validation="required" class="input validate[required] textbox" />
				</td>
				<td class='error_msg'> </td>
				<td class='error_field' id='name_error_msg' > </td>
				
		</tr>
		<tr>
				<td width="125" valign="top"><label>New Password<span class="Hred">*</span>:</label></td>
				<td valign="top"><input type="password" name="npass" id="npass" data-validation="required" class="input validate[required] textbox"  />
				</td>
				<td class='error_msg'> </td>
				<td class='error_field' id='name_error_msg' > </td>
				
		</tr>
		<tr>
				<td width="125" valign="top"><label>Confirm Password<span class="Hred">*</span>:</label></td>
				<td valign="top"><input type="password" name="repass" id="repass"data-validation="required" class="input validate[required] textbox" />
				</td>
				<td class='error_msg'> </td>
				<td class='error_field' id='name_error_msg' > </td>
				
		</tr>
	<?php/*  if($_SESSION['user']=='admin') { */ ?>	
	<tr>
		<td width="145" valign="top" ><label>Status :</label></td>
		<td width="385" valign="top" class="payComDays">
		<input type="radio" id="status_active" name="status" value="1" style="width:25px;" checked />&nbsp;<span style="font-size:13px;">Active</span>&nbsp;&nbsp;<input type="radio" id="status_passive" name="status" style="width:25px;" value="0" />&nbsp;<span style="font-size:13px;">Passive</span>
		</td>
		<?php /* } */ ?>
	</tr>
</tbody>
</table>

<table style="border:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 40px;">
		<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkPasswordUpdate();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<!--<a href="view-user-master.php"><button type="button" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php /* echo $home_path; */ ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>-->
			
			<button type="reset" id="rest" class="buttExam_sngl" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:18px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	
	
	<!--<div style="margin:0px 0 0 -59px;">
			<button type="submit" class="buttExam_sngl bnkSbt" onclick="return checkPasswordUpdate();" style="font-weight: bold;"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
					
			<button type="reset" class="buttExam_sngl" style="font-weight: bold;"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
			
			<a href="<?php /* echo $home_path; */ ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style="font-weight: bold;" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button></a>
	</div>-->
</td>
	</tr>
	</table>	
	</form>
			</div>
		</div>
	</div>
	</div>
		
	

</body>
</html>