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
		<div style="margin:10px 0 10px 0;flot:right;"><a class="submitbtnAdd" href="packingpage.php">Add Packing Page</a>
		</div>
		<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>View Packing Page Details</b></h3>
		  <table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table">
		                
		<?php 
	$sql=mysql_query("select * from packingpage");
	$x=0;
	if(mysql_num_rows($sql)>0) {
		?>
		 	<thead>
				<th>S No.</th>
				<th>Rfq no</th>
				<th>Clin no</th>
				<th>Packing date</th>
				<th>Contract no</th>
				<th>Nsn no</th>
				<th >Part no</th>
				<th >Part name</th>
				<th >Total qty</th>
				<th >Clin qty</th>
				<th >Dest code</th>
				<th >Dest address</th>
				<th >Packing req</th>
				<th style="text-align:center;">Edit</th>
			</thead>
       <?php
	while($row=mysql_fetch_array($sql)) {
		$x++;
	?>
		<tbody>
			<tr >
			<td><?php echo $x; ?></td>
			<td class="codesUPPERCase"><?php echo $row['rfq_no']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['clin_no']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['packing_date']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['contract_no']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['nsn_no']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['part_no']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['part_name']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['total_qty']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['clin_qty']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['dest_code']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['dest_address']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['packing_req']; ?></td>
			
			<td><a title="Edit Packing Page" href="update-packing-page.php?uid=<?php echo $row['packingpage_id']?>" style="color:#005580;">Edit</a></td>
			</tr>
		</tbody>
		 <?php  }  ?>
	</table>
<?php  } else { ?>

		  <div style="margin:10px 0 10px 0" class="alert alert-success">
			   You have not created any Packing Page Details...
		 </div>

		<?php  }  ?>

	</form>

		  
		  
		  
		  
		  
		  
		</div>
		</div>
		</div>