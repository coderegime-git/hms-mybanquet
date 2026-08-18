<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../menu.php");
?>

<script>
	jQuery(document).ready(function(){
	jQuery("#roommaster").validationEngine();
	});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});

function checkPropertyCode(){
	propCode=$('#property_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatPropertyCode.php',
			data:{
			propCode:propCode
			},
			success:function(data){
				/* alert(data); */
				if(data==1){
					$('#propertycode_err').html('* Property Code already exists.');
					$('#property_code').val('');
				}
				else{
					$('#propertycode_err').html('');
				}
			}
	});
}



 </script>
 
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
</style>	


<!--<body style="background:#eaebfc url(../../images/bg-ash2.jpg) repeat scroll center top;font: 69%/160% Lucida Grande,Verdana,Helvetica,Arial,sans-serif;">-->
<body class="bgBODY">

	<div class="box propertyhead" style="" >&nbsp;
	<div class="box-header well" >	
		<h4 style="font-size:14px;margin:0px;">Company Master</h4>
	</div>
	 <br/>
	 

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
  
<div class="" style="height:500px;overflow:auto;">	
<div style="margin:0px 0 10px 750px;">
		<a href="company-master.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();"><img src="../../images/Add.png" class="sbtBtnImg"/>&nbsp;&nbsp;Add Company Master</button></a>
</div>
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
		<td colspan="21" style="text-align:center;"><b>View Company Master Details</b></td>
	</tr>
<tr>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Code</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Name</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Classification</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Contact name</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">TIN no</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">IATA no</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Company address</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Company city</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Company state</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Company country</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Company pincode</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Phone</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Email</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Billing address</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Billing city</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Billing state</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Billing country</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Billing pincode</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>
</tr>
	<?php 
	$sql=mysql_query("select * from company_master");
	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		 if($row['status']==1){
			$status='Yes';
		}else{
			$status='No';
		}  
	?>
	<tr>
		<td width="80" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['company_code']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['company_name']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['classification']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['contact_name']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['tin_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['iata_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['caddress']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['ccity']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['cstate']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['ccountry']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['cpincode']; ?></td>
		<td width="80"><?php echo $row['cphone']; ?></td>
		<td width="80"><?php echo $row['cemail']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['baddress']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['bcity']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['bstate']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['bcountry']; ?></td>
		<td width="80" ><?php echo $row['bpincode']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $status; ?></td>
		<td width="80">
		<a href="update-company-master.php?compid=<?php echo $row['companymaster_id']; ?>" style="" class="">Edit</a>&nbsp;
		<!--<a title="Delete Comments" onclick="return confirm('Do you want to delete ?')" class="findedit group1" href="delete-comments.php?uid=<?php /* echo $row['id'] */ ?>&comments_name=<?php /* echo $row['name']; */ ?>">delete</a>-->
		</td>
	</tr>
	<?php } } else{ ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any Company Master details...
    </div>
<?php } ?>
</table>
	
	</div>
	</body>
