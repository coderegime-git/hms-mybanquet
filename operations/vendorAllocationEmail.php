<?php
session_start();
include("../config.php");
?>

<script>

		function winOpene(){
			alert('dd');
			/* xr=parent.$("#venId").val();
			alert(xr); */
		}
	
	
</script>
<?php
$sqlV=mysql_query("select * from vendor_allocation where company_id='".$_SESSION['companyId']."' AND vendorallot_id='".$_GET['uid']."'");
$rowV=mysql_fetch_array($sqlV);
$vendName=$rowV['vendor_name'];

$sqlVM=mysql_query("select * from vendor_master where company_id='".$_SESSION['companyId']."' AND vendor_code='".$vendName."'");
$rowVM=mysql_fetch_array($sqlVM);
$email=$rowVM['email'];
?>
<body>
<div style="width:400px;">
<form name="frm" action="<?php echo $home_path;?>/operations/xt_sendVENDORmail.php" method="post" enctype="multipart/form-data">

<table style="width:100%;" cellpadding="3" cellspacing="14" border="0" class="table">
	<tr>
    	<td><b>To</b></td>
		<td>
         <input type="text" name="pidd" id="pidd" style="display:none;" value="<?php echo $_GET['uid'] ?>" />
		<input type="text" name="to_email" id="to_email" style="width:220px;" value="<?php  echo $rowVM['email']; ?>" />
		</td>
	</tr>
    
    <tr>
    	<td><b>Cc</b></td>
		<td>
       	<input type="text" name="cc_email" id="cc_email" style="width:220px;" value="<?php //echo $row_reg['email']?>" />
		</td>
	</tr>
	<tr>
		<td><b>Subject </b></td>
		<td>
		<input type="text" name="subject" id="subject" style="width:220px;" value="" />
		</td>
	</tr>
	<tr>
		<td><b>Drawing Attach</b></td>
		<td ><input name="attachfile" id="attachfile" type="file" class="textbox"/></td>
	</tr>
	

 </table>
 
<table style="width:350px;">

    <tr>
    	<td>Message to Vendor</td>
    </tr>
    <tr>
        <td>
        	<textarea id="content" name="content" style="width:350px;height:150px;" ></textarea>
        </td>
    </tr>
         
     <tr>
     	
		<td>
        	<input type="submit" name="submit" id="submit" value="SEND" class="submitbtn"/>
		</td>
	</tr>
     
 </table>
</form>
 </div>

</body>
</html>