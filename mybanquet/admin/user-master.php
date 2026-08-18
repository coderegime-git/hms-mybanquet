<?php
ob_start();
include("../includes/header.php");
/* isset($_SESSION['companyId']); */
/* echo $_SESSION['companyId']; */
 ?>
<!--form validation-->	
<link rel="stylesheet" href="../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!---//-form valid---->

<script type="text/javascript">
$(document).ready(function(){
	jQuery("#userfrm").validationEngine();
});

 shortcut.add("Ctrl+S",function() { 
	 $('#userfrm').attr('action', '../action/userlogin.php');  
	 $('#userfrm').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view-user-master.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#userfrm').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../dashboard.php";
});


function selCompanyID(){
	comID=$('#company_id').val();
	$('#hid_menu').val(comID);
	}
	
function selectUserCode(){
	usercode=$('#usercode').val();
	$.ajax({
		type:'GET',
		url:'../action/checkuserCode.php',
		data:{
			usercode:usercode
		},
		success:function(data){
			/* alert(data); */
		 if(data==1){
			 alert('user code already exists!.');
			 $('#usercode').val(''); 
		 } 
		 else{
			 
		 }
		}
	});
}
	
function selectUserName(){
	username=$('#username').val();
	$.ajax({
		type:'GET',
		url:'../action/checkuserName.php',
		data:{
			username:username
		},
		success:function(data){
			/* alert(data); */
		 if(data==1){
			 alert('user name already exists!.');
			 $('#username').val(''); 
		 } 
		 else{
			 
		 }
		}
	});
}


function getDetails(){
	user_namem=$('#user_namem').val();
	$.ajax({
		type:'GET',
		url:'../action/getDetailsforUser.php',
		data:{
			user_namem:user_namem
		},
		success:function(data){
		 var val = data.split(',');
		 email=$('#email').val(val[1]);
		 mobile=$('#mobile').val(val[2]);
		}
	});
}


function checkPassword(){
password=$('#password').val();
	$.ajax({
		type:'GET',
		url:'../action/checkMasterPassword.php',
		data:{
			password:password
		},
		success:function(data){
			if(data==1){
				
			}
			else{
				$('#pass_err').html('password does not match with ');
				$('#password').val('');
			}
		}
	});
}

function checkUserMaster(){
	var ck_name = /^[A-Za-z0-9 ]{3,20}$/;
	var ck_mobile = /^\d{10}$/; 
	var status = true;	
	username = $('#username').val();		
	password = $('#password').val();		
	repass = $('#repass').val();		
	email = $('#email').val();		
	mobile = $('#mobile').val();		
		
		if(password != repass){
			alert("password and confirm password not matching.");
			status = false;
		} 	
		else {
			$('#repass_err').html("");
			}		
		
		
							
		if(!status){
		return false;
		}
		else
		{
			
		}
}



</script>
<!--<script type="text/javascript" src="jquery.js"></script>-->
<body class="bgBODY">
<div class="about">
	<div class="container">
	
<?php 	
if(isset($_GET['msg'])){
?>
	<p>
		<label id="msgFo" class="msgNotify" style="width:90%;margin-left:54px;text-align:center;padding: 0;"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>


		<div class="col-md-12 frmCentr "  id="addcustomer" style="width:496px;">
			<h3 id="Userhd"><b>User Master</b></h3>
			<div>
		<form name="userfrm" id="userfrm" action="<?php echo $home_path; ?>/action/userlogin.php" method="post" class="payForm frmBgClr divBrd">
			<table style="text-align:center;margin:0 0 0 0px;border:1px solid #ddd;" cellpadding="0" cellspacing="0" class="table " border="0" >
			<tbody>
				<tr>
					<td width="" valign="top"><label>User Code<span class="Hred">*</span>:</label></td>
					<td valign="top">
					<input name="usercode" id="usercode" type="text" data-validation="required" class="input validate[required] textbox" onblur="selectUserCode();" />
					</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>User Name<span class="Hred">*</span>:</label></td>
					<td valign="top">
					<input name="username" id="username" type="text" data-validation="required" class="input validate[required] textbox" onblur="selectUserName();"/>
					</td>
				</tr>
											
<input type="hidden" name="companyuser_id" id="companyuser_id" readonly="readonly" value=""/>
<input type="hidden" name="hid_id" id="hid_id"  />
<input type="hidden" name="hid_menu" id="hid_menu" value="" />
								
				<tr>
						<td width="" valign="top"><label>Password<span class="Hred">*</span>:</label></td>
						<td valign="top"><input type="password"  name="password" id="password" data-validation="required" class="input validate[required] textbox"/>
						</td>
						
						
				</tr>
				<tr>
						<td width="" valign="top"><label>Re-enter Password<span class="Hred">*</span>:</label></td>
						<td valign="top"><input type="password" name="repass" id="repass" data-validation="required" class="input validate[required] textbox" />
						</td>
						
						
				</tr>
				<tr>
						<td width="" valign="top"><label>E-Mail<span class="Hred">*</span>:</label></td>
						<td valign="top"><input name="email" id="email" type="text" data-validation="required" class="input validate[required,custom[email]] textbox" />
						</td>
						
						
				</tr>
				<tr>
						<td width="" valign="top"><label>Mobile:</label></td>
						<td valign="top"><input name="mobile" id="mobile" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox"  />
						</td>
						
						
				</tr>
				
			<tr>
				<td width="" valign="top" ><label>Status :</label></td>
				<td valign="top" class="">
				<input type="radio" id="status_active" name="status" value="1" style="width:25px;" checked />&nbsp;<span style="font-size:14px;">Active</span>&nbsp;&nbsp;<input type="radio" id="status_passive" name="status" style="width:25px;" value="0" />&nbsp;<span style="font-size:14px;">Passive</span>
				</td>
			</tr>
		</tbody>
	</table>
	<table style="border:1px solid #ddd;" class="table">
	<tr>
		<td>
	<div style="margin:0 0 0 1px;">
		<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkUserMaster();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-user-master.php"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="buttExam_sngl" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	
</td>
	</tr>
	</table>	
	</form>
			</div>
		</div>
	</div>
	</div>
	
	<?php include("../footer.php"); ?>
</body>
</html>