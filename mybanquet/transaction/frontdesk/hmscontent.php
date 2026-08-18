



<script type="text/javascript" src="tree-menu/lib/jquery.ntm/js/jquery.ntm.js"></script>
        <link rel="stylesheet" href="tree-menu/css/style.css" />
         <link rel="stylesheet" href="tree-menu/lib/jquery.ntm/themes/default/css/theme.css" />
    <script type="text/javascript">
            $(document).ready(function() {
                $('.demo').ntm();
            });
  
</script>
		
<?php 
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$toDate=$adtCurDt;
$sqlAR=mysql_query("select count(distinct resv_no) AS todayRes from room_booking where arrival_date='$adtCurDt' AND resv_status='1'"); 
$rowAr=mysql_fetch_array($sqlAR);
?>
 <div class="wrapper dsWrpwth">
         <div class="tree-menu demo" id="tree-menu" style="overflow:auto;height:513px;border:1px solid #888888;">
		 <div id="dvWrp">Today's Status</div>
		<ul>
<?php 
$toDate=$adtCurDt;
$sqlAR=mysql_query("select count(pax) AS todayDep from guest_register where bill_status='1'"); 
$rowAr=mysql_fetch_array($sqlAR);
?>		
<input type="hidden" id="adtDt" value="<?php echo $adtCurDt;?>"/>
			<li><a href="#">House count<span id="dvIn">&nbsp;<?php echo $rowAr['todayDep'];?></span></a>
		<ul>
		<li id="dvli"><table class="table dsWrpTbl" >
		<tr><td id="dvTpx">Total Pax</td><td id="dvAB">Adult</td><td id="dvBCh">Child</td>
		</tr>
<?php 
	$sqlR=mysql_query("select * from guest_register where bill_status='1' group by room_no"); 
	$pax=0;$adTpax=0;$chDpax=0;
	while($rowR=mysql_fetch_array($sqlR)){
		$pax+=floatval($rowR['pax']);
		$adTpax+=floatval($rowR['adult_pax']);
		$chDpax+=floatval($rowR['child_pax']);
		
	}

	$sqlRl=mysql_query("select count(meal_plan)AS Mpln from guest_register where bill_status='1' AND meal_plan='EP' group by room_no");
$Mpln=0;	
	while($rowRl=mysql_fetch_array($sqlRl)){
		$Mpln+=floatval($rowRl['Mpln']);
	}

	$sqlRc=mysql_query("select count(meal_plan)AS cMpln from guest_register where bill_status='1' AND meal_plan='CP' group by room_no"); 
	$cMpln=0;
	while($rowRc=mysql_fetch_array($sqlRc)){
		if($rowRc['cMpln']!=''){
			$cMpln+=floatval($rowRc['cMpln']);
		}else{
			$cMpln=0;
		}
	}
	
?>
<tr><td id="dvc"><?php echo $pax; ?></td><td style="width:60px;"><?php echo $adTpax; ?></td><td style="width:50px;"><?php echo $chDpax; ?></td>
</tr>
			<?php ?>
			</table></li>
			<li id="dvli"><table class="table dsWrpTbl" >
		<tr><td id="dvTpx">Plan</td><td id="dvAB">EP</td><td id="dvBCh">CP</td>
		</tr>
		
		<tr><td style="width:15px;margin:0 0 0 5px;"><?php  echo 'Meal Plan';  ?></td><td style="width:60px;"><?php echo $Mpln; ?></td><td style="width:50px;"><?php echo $cMpln; ?></td></tr>
		  <?php 
			
			$sqlAR=mysql_query("select distinct room_no from guest_register where departure_date='".$toDate."' AND bill_status='1'"); 
			while($rowAr=mysql_fetch_array($sqlAR)){
				$sqlGR=mysql_query("select * from guest_register where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowGr=mysql_fetch_array($sqlGR);
				
				$sqlT=mysql_query("select SUM(debit)+SUM(tax_val)-SUM(credit)AS blAMt from guest_trans where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowT=mysql_fetch_array($sqlT);
			?>
			<?php } ?>
			</table></li>
			</ul>
			  </li>
			</ul>
			
<?php 
$toDate=$adtCurDt;
$sqlAR=mysql_query("select count(noof_rms) AS todayRes from room_booking where arrival_date='$adtCurDt' AND resv_status='1'"); 
$rowAr=mysql_fetch_array($sqlAR);
?>			
			
            <ul style="">
                <li><a href="#" style="">Expected Arrivals&nbsp;<span id="dvIn"><?php echo $rowAr['todayRes'];?></span> </a>
				<ul>
				<li id="dvEx"><table class="table dsWrpTbl" ><tr><td id="dvExpA">Resv#</td><td id="GsNm">Gst Name</td><td id="dvBCh">Type</td><td id="dvTy">Rms</td><td id="dvTy">Pax</td></tr>
<?php
$toDate=$adtCurDt;
$atDt=explode('/',$toDate);
$expYr=$atDt[2].'/'.$atDt[1].'/'.$atDt[0];

		
$sqlR=mysql_query("select * from room_booking where str_to_date(arrival_date,'%d/%m/%Y') ='".$expYr."' AND resv_status='1' group by resv_no");
while($rowR=mysql_fetch_array($sqlR)){ 
if($rowR['single']!='0'){
	$rmVal=$rowR['single'];
}else if($rowR['doubl']!='0'){
	$rmVal=$rowR['doubl'];
}else if($rowR['tripple']!='0'){
	$rmVal=$rowR['tripple'];
}else if($rowR['quad']!='0'){
	$rmVal=$rowR['quad'];
}
if($rowR['exp']!='0'){
	$rmExVal=$rowR['exp'];
	$romVal=$rmVal+$rmExVal;
}else{
	$romVal=$rmVal;
}
$sqR=mysql_query("select sum(noof_rms)as NoRms from room_booking where resv_no='".$rowR['resv_no']."' AND resv_status='1' group by resv_no order by resv_no ASC ");
$roR=mysql_fetch_array($sqR);
?>
		<tr><td id="dvc"><?php echo $rowR['resv_no']; ?></td><td style="width:60px;text-align:left;"><?php echo ucfirst($rowR['guest_name']); ?></td><td style="width:50px;"><?php echo $rowR['room_type']; ?></td><td style="width:15px;"><?php echo $roR['NoRms']; ?></td><td style="width:15px;"><?php echo $romVal; ?></td></tr>
<?php } ?>
</table></li>
			  </ul>
			  </li>
			  
			</ul>
		 		  
			<ul>
<?php 
$sqlAR=mysql_query("select count(distinct room_no) AS todayDep from guest_register where str_to_date(departure_date,'%d/%m/%Y') <='".$expYr."' AND bill_status='1'"); 
$rowAr=mysql_fetch_array($sqlAR);
?>		
			<li><a href="#">Expected Departure <span id="dvIn"><?php echo $rowAr['todayDep'];?></span></a>
		<ul>
		<li id="dvli"><table class="table dsWrpTbl" ><tr><td id="dvEd">Room#</td><td id="GsNm">Gst Name</td><td style="width:50px;background-color:#C3C3C3;color:#000;">Plan</td><td id="dvBCh">Amount</td></tr>
		  <?php 
			
			$sqlAR=mysql_query("select distinct room_no from guest_register where departure_date='".$toDate."' AND bill_status='1'"); 
			while($rowAr=mysql_fetch_array($sqlAR)){
				$sqlGR=mysql_query("select * from guest_register where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowGr=mysql_fetch_array($sqlGR);
				
				$sqlT=mysql_query("select SUM(debit)+SUM(tax_val)-SUM(credit)AS blAMt from guest_trans where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowT=mysql_fetch_array($sqlT);
			?>
				<tr><td id="dvc"><?php echo $rowAr['room_no']; ?></td><td style="width:60px;text-align:left;"><?php echo ucfirst($rowGr['guest_name']); ?></td><td style="width:50px;"><?php echo $rowGr['meal_plan']; ?></td><td style="width:15px;"><?php echo sprintf("%01.2f",$rowT['blAMt']); ?></td></tr>
			<?php } ?>
			</table></li>
			</ul>
			  </li>
			</ul>
			
			<ul>
<?php 
$toDate=$adtCurDt;
$sqlAR=mysql_query("select count(distinct gr.guestreg_id) AS todayArri from guest_register gr,guest_trans gt where arrival_date='".$toDate."' AND gr.guestreg_id=gt.reg_num ");
$rowAr=mysql_fetch_array($sqlAR);
?>			
<li><a href="#">Today's Arrival <span id="dvIn"><?php echo $rowAr['todayArri'];?></span></a>
	<ul>
	<li id="dvli"><table class="table dsWrpTbl"><tr><td id="dvEd">Room#</td><td id="GsNm">Gst Name</td><td id="dvBCh">Pax</td><td id="dvTy">Type</td></tr>
 <?php 
			$sqlAR=mysql_query("select distinct room_no from guest_register where arrival_date='".$toDate."' AND bill_status='1'"); 
			while($rowAr=mysql_fetch_array($sqlAR)){
				$sqlGR=mysql_query("select * from guest_register where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowGr=mysql_fetch_array($sqlGR);
				
				$sqlT=mysql_query("select SUM(debit)+SUM(tax_val)-SUM(credit)AS blAMt from guest_trans where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowT=mysql_fetch_array($sqlT);
			?>
				<tr><td id="dvc"><?php echo $rowAr['room_no']; ?></td><td style="width:60px;text-align:left;"><?php echo ucfirst($rowGr['guest_name']); ?></td><td style="width:50px;"><?php echo $rowGr['pax']; ?></td><td style="width:15px;"><?php echo $rowGr['room_type']; ?></td></tr>
			<?php } ?>
			</table></li>
		</ul>
	</li>
	</ul>
<ul>
<?php 
$toDate=$adtCurDt;
$sqlDp=mysql_query("select count(distinct bh.billhead_id) AS todayDept from bill_header bh,bill_detail bd where bh.bill_date='".$toDate."' AND bh.bill_no=bd.bill_no AND bh.settleflag='2'");
$rowDp=mysql_fetch_array($sqlDp);
?>
<li><a href="#">Today's Departure <span id="dvIn"><?php echo $rowDp['todayDept'];?></span></a>
<ul>
<li id="dvli"><table class="table dsWrpTbl"><tr><td id="dvExpA">Room#</td><td id="GsNm">Gst Name</td><td id="dvBCh">Bill #</td><td id="dvTy">Amount</td></tr>
	<?php 
	$sqlbh=mysql_query("select distinct room_no,reg_num from bill_header where bill_date='".$toDate."' AND settleflag='2' "); 
	while($rowBh=mysql_fetch_array($sqlbh)){
		$sqlBd=mysql_query("select * from bill_header where room_no='".$rowBh['room_no']."' AND reg_num='".$rowBh['reg_num']."' AND settleflag='2'"); 
		$rowBd=mysql_fetch_array($sqlBd);

	?>
	<tr><td id="dvc"><?php echo $rowBd['room_no']; ?></td><td style="width:60px;text-align:left;"><?php echo ucfirst($rowBd['mainguest_name']); ?></td><td style="width:50px;"><?php echo $rowBd['bill_no']; ?></td><td style="width:15px;"><?php echo $rowBd['net_amt']; ?></td></tr>
	<?php } ?>
	</table></li>
</ul>
</li>
</ul>
</div>

        </div>
