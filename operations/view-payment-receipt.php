<?php
ob_start();
include("../includes/header.php");
 ?>
 <style>

 </style>
 
 <body class="bgBODY">
<div class="about">
	<div class="container" style="width:1000px;/* margin:0; */padding:0;">
		<div class="col-md-12" style="overflow:auto;width:1000px;height:470px;" >
		<div style="margin:10px 0 10px 0;flot:right;"><a class="submitbtnAdd" href="payment_receipt.php">Add Payment Receipt</a>
		</div>
		<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>View Payment Receipt</b></h3>
		  <table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table">
		                
		<?php 
	$sql=mysql_query("select * from invoice_payment");
	$x=0;
	if(mysql_num_rows($sql)>0) {
		?>
		 	<thead>
				<th>S No.</th>
				<th>EBSInvoice no</th>
				<th>Invoice date</th>
				<th>Invoice amount</th>
				<th>Payment amount</th>
				<th>Payment type</th>
				<th >Payment details</th>
				<th style="text-align:center;">Edit</th>
			</thead>
       <?php
	while($row=mysql_fetch_array($sql)) {
		$x++;
	?>
		<tbody>
			<tr >
			<td><?php echo $x; ?></td>
			<td class="codesUPPERCase"><?php echo $row['ebsinv_no']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['inv_date']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['inv_amount']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['payment_amount']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['payment_type']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['payment_details']; ?></td>
						
			<td><a title="Edit Packing Page" href="update-invoice-payment.php?uid=<?php echo $row['invpayment_id']?>" style="color:#005580;">Edit</a></td>
			</tr>
		</tbody>
		 <?php  }  ?>
	</table>
<?php  } else { ?>

		  <div style="margin:10px 0 10px 0" class="alert alert-success">
			   You have not created any payment receipt Details...
		 </div>

		<?php  }  ?>

	</form>

		  
		  
		  
		  
		  
		  
		</div>
		</div>
		</div>