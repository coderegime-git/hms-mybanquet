<?php
ob_start();
include("../includes/header.php");
include("../util.php");
$curr_symbol=  getCurrancy();
 ?>
 
<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
 <script type="text/javascript">
$(document).ready(function(){
	
	$("[rel=tooltip]").tooltip();
	$("[rel=popover]").popover({trigger:'hover',html:true});
				  
	 $(':checkbox').click(function(e){
																
                                if($("input:checked").length>0){
                                   $('#edit').show();
                                   $('#pay').show();
                                   $('#pdf').show();
                                   $('#email').show();
                                   /* $('#custpo').show(); */
                                   
								   //if(x==true){
								   //$('#challan').show();
								   //}

                                }else{
                                   $('#edit').hide();
                                   $('#pay').hide();
                                   $('#pdf').hide();
                                   $('#email').hide();
								   /* $('#custpo').hide(); */
                                }
                               
                            });			  
			  
});


					function setPrint(id,val)
						{	
							if($("#"+id).is(":checked"))
							{  
								//$('#qtyDeliver').attr('disabled','disabled');
								
								$('.ckPrint').each(function(){
									a_id=this.id.split('_');
									if($(this).attr('id') != id)
									{
										$(this).attr("disabled",true);
										$("#ed"+a_id[1]).attr("style","display:none");
									}
								});
							}
							else
							{
								$('.ckPrint').each(function(){
									a_id=this.id.split('_');
									$(this).removeAttr("disabled");
									$("#ed"+a_id[1]).attr("style","display:inline");
								});
							}
						}
						
						function popup()
						{
							id=$('.ckPrint:checkbox:checked').val();
							newwindow=window.open('<?php echo $home_path;?>/views/quote_printout.php?uid='+id,'mywin','left=120,width=1000,height=700,');
							newwindow.focus();
						}
						function popupDC()
						{
							id=$('.ckPrint:checkbox:checked').val();
							newwindow=window.open('<?php echo $home_path;?>/operations/customerpo.php?uid='+id,'_blank');
							newwindow.focus(); 
						}
</script>
<body class="bgBODY">
	<div style="margin:10px 0 10px -75px;"><a class="submitbtnAdd" href="quotation.php">Add Quotation Master</a>
	</div>				
<div class="about">
	<div class="container" style="width:1000px;/* margin:0; */padding:0;">
	
					<div style="height:33px;margin:0 0 0 22px;" id="toolbar">
                        <div class="btn-group">
                            <!--<button type="button" id="delete" style="margin-right:15px;display:none" class="submitbtndelete btnn">Delete</button>

                            <button type="button" id="pay" style="display:none" class="submitbtn btnn" >Payment</button>-->
							
							
							<!--<a title="Edit Quotation Details" href="update-quotation.php?uid=<?php /* echo $row['quote_id'] */?>" style="color:#005580;"><button type="button" id="edit" style="margin-right:15px;display:none" class="submitbtndelete btnn">Edit</button></a>-->
							
                          <button type="button" id="pdf" style="display:none" class="submitbtnprint btnn" onclick="popup()">Print</button>
						  
                                              
							<button type="button" id="custpo" style="color:#000;display:none" class="btnn submitbtnedit" onclick="popupDC()" >Customer PO </button>  
							
                         
							<!--<button type="button" id="email" style="display:none" class="btnn submitbtnedit">Email</button>-->
                          
                            

							<div >

                                    <input value="<?php echo $_POST['keyword']?>" name="keyword" type="text" class="input-medium search-query" style="float:left;margin-left:635px;margin-top:-21px;display:none"/>
									<button style="margin-top: -4.1%;height: 21px;font-size: 12px;padding-top: 1px;float: left;display:none" class="btnn">Go</button>

                            </div>
                         </div>
                    </div>
					
					
		<div class="col-md-12" style="overflow:auto;width:1000px;height:445px;" >
		
<h3 style="text-align:center;width:126.5%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>View Quotation Master</b></h3>
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" >
		                
		<?php 
	$sql=mysql_query("select * from quotation where company_id='".$_SESSION['companyId']."'");
	$x=0;
	if(mysql_num_rows($sql)>0) {
		?>
		 	<thead>
				<th>S No.</th>
				<th></th>
				<!--<th>Code</th>-->
				<th>RFQ no</th>
				<th>Date</th>
				<th>NSN No</th>
				<!--<th>Part No</th>
				<th>New Partno</th>
				<th>Part name</th>-->
				<th>Perior status</th>
				
				<th>Req. days</th>
				<th>Days possible</th>
				<th>Qty</th>
				<th>Unit issue</th>
				<th>Quote rate</th>
				<th>Quote amt</th>
				<th>Quote number</th>
				<th>Edit</th>
				<!--<th style="text-align:center;">Edit</th>-->
			</thead>
       <?php
	while($row=mysql_fetch_array($sql)) {
		$x++;
		
	?>
		<tbody>
			<tr >
			<td><?php echo $x; ?></td>
			<td><input name="chk[]"  type="checkbox" id="c_<?php echo $row['quote_id']?>" class="ckPrint group1 check_" value="<?php echo $row['quote_id']?>" onclick="setPrint(this.id,this.value);" /></td>
			
			<!--<a href="#" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">Toggle popover</a>-->
			
<td><a rel="popover" data-placement="right" data-original-title="Quote # <?php echo $row['quote_number']; ?>" data-content="<div style='padding:10px 0 0 0'><span style='padding:10px 10px 0 0'>Amount</span><?php echo $curr_symbol;?><?php echo $row['quote_amt'];?></div><div style='padding:10px 0 0 0'><span style='padding:10px 10px 0 0'>Qty</span><?php echo $row['qty'];?></div></a></td>
	 
			<td class="fstChUPPRCase"><?php  echo $row['rfq_no']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['cur_date']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['nsn_no']; ?></td>
			<!--<td class="fstChUPPRCase"><?php  /* echo $row['part_no']; */ ?></td>
			<td class="fstChUPPRCase"><?php  /* echo $row['new_partno']; */ ?></td>
			<td class="fstChUPPRCase"><?php  /* echo $row['part_name']; */ ?></td>-->
			<td class="fstChUPPRCase"><?php  echo $row['perior_status']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['req_days']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['days_possible']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['qty']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['unit_issue']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['quote_rate']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['quote_amt']; ?></td>
			<td class="fstChUPPRCase"><?php  echo $row['quote_number']; ?></td>
			<td>
				<div style="display:inline"; id="ed<?php echo $row['quote_id'];?>">
					<a title="Edit Quotation Details" href="update-quotation.php?uid=<?php echo $row['quote_id']?>" style="color:#005580;">Edit</a>
				</div>
			</td>
			
			
			
<!--<td>		
<a title="Edit Invoice" onclick="enable_cb(this)" class="findedit group1 submitbtnedit" href="edit-invoice.php?uid=<?php /* echo $row['quote_id'] */?>" style="">edit</a>	
</td>			
			<td><a title="Edit Property Details" href="update-prop-master.php?uid=<?php /* echo $row['propmaster_id'] */?>" style="color:#005580;">Edit</a></td>-->
			</tr>
		</tbody>
		 <?php  }  ?>
	</table>
<?php  } else { ?>

		  <div style="margin:10px 0 10px 0" class="alert alert-success">
			   You have not created any Quotation Master Details...
		 </div>

		<?php  }  ?>

	</form>

		  
		  
		  
		  
		  
		  
		</div>
		</div>
		</div>