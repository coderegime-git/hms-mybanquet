<?php
include("../includes/header.php");
?>

<script type="text/javascript" src="include/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
			x=parent.$("#hid_menu").val();
			alert(x);
	});
		
function getCompanymail()
{
id=$("#company").val();
//alert(val);
$.ajax({
	type:'GET',
	url:'getCompanyDetails.php',
		data:{
		id:id,
		type:'getcompanyId'
		},
			success:function(data) {
			$("#to_email").val(data);
			}
	}); 
}
	
</script>
</head>

<body>
<div style="width:400px;">
<form name="frm" action="xt_sendGroupmail_student.php" method="post" enctype="multipart/form-data">

<table style="width:100%;" cellpadding="3" cellspacing="14" border="0" class="table">
	<tr>
    	<td><b>To</b></td>
		<td>
        <input type="hidden" name="student_id" id="student_id" style="" value="<?php echo $row_reg['student_id']?>" />
        <input type="text" name="pidd" id="pidd" style="display:none;" value="<?php echo $_GET['pidd']?>" />
		<input type="text" name="to_email" id="to_email" style="width:220px;" value="<?php echo $row_reg['email']?>" />
		</td>
	</tr>
    
    <tr >
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
	

 </table>
 
</form>
 </div>

</body>
</html>