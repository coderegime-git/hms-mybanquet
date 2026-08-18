<?php
ob_start();
include("../includes/header.php");
 ?>
 <style>

 </style>
 
 <body class="bgBODY">
<div class="about">
	<div class="container" style="width:1000px;/* margin:0; */padding:0;">
		<div class="col-md-12" style="overflow:auto;width:1000px;height:450px;" >
		<div style="margin:10px 0 10px 0;flot:right;"><a class="submitbtnAdd" href="quotation.php">Add Quotation</a>
		</div>
		<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>View Quotation Details</b></h3>
		  <table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table">
		  <?php 
	$sql=mysql_query("select * from vendor_master");
	$x=0;
	if(mysql_num_rows($sql)>0) {
		?>
		 	<thead>
				<th>S No.</th>
				<th>Code</th>
				<th>Name</th>
				<th>Address1</th>
				<th>Address2</th>
				<th>City</th>
				<th >Zip</th>
				<th >State</th>
				<th >Country</th>
				<th >Telephone</th>
				<th >E-mail</th>
				<th style="text-align:center;">Edit</th>
			</thead>
                     
		<?php
	while($row=mysql_fetch_array($sql)) {
		$x++;
		/* if($row['status']==1){
			$status='Active';
		}else{
			$status='Deactive';
		} */
	?>
		<tbody>
			<tr >
			<td><?php echo $x; ?></td>
			<td class="codesUPPERCase"><?php echo $row['vendor_code']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['vendor_name']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['address1']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['address2']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['city']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['pincode']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['state']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['country']; ?></td>
			<td><?php echo $row['phone']; ?></td>
			<td><?php echo $row['email']; ?></td>
			
			<td><a title="Edit Vendor Details" href="#" style="color:#005580;" >Edit</a></td>
			</tr>
		</tbody>
		 <?php  }  ?>
	</table>
<?php  } else { ?>

		  <div style="margin:10px 0 10px 0" class="alert alert-success">
			   You have not created any quote Details...
		 </div>

		<?php  }  ?>

	</form>

		  
		  
		  
		  
		  
		  
		</div>
		</div>
		</div>