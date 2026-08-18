<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>
 <!--<script src="//code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" type="text/css" media="screen" />-->
<script>
	$(document).ready(function() {
		/* alert('sds'); */
		 /* $('#example').DataTable(); */
		$('#searchBtn').click(function(){
		item="?val="+$('#searchTxt').val();
		document.location.href="view-company-master.php"+item;
	});
	
	
	jQuery("#roommaster").validationEngine();
	

	});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});
 shortcut.add("Ctrl+A",function() { 
 	 window.location.href = "business-source.php";
	 
	

}); 
 function printPage(){
			$('.ckPrint').hide().delay(3000).show(0);			 
			$('.Ckk').hide().delay(3000).show(0);	
			$('.dispSHw').show().delay(1000).hide(0);			
			var divContents = $("#dvContainer").html();
		    var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>Arrival for the Day</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print(); 
	}

</script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
</style>	

<body class="bgBODY">
 <form id="taxTypes" name="taxTypes" class="" style=""> 
<div class="" style="height:500px;overflow:auto;">	
<table style="float:right;margin:7px 0 12px 8px;">
<tr>

<td>
  <a href="<?php echo $home_path ?>/reports/checkout/xt_viewCOMPANYMaster-xls.php" style="margin:10px 0 0 65px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="" class="myButeXL btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Export&nbsp;</button></a>

</td>
<td>
<input type="button" value="Print" class="myButsprn" onclick="printPage();" style="margin:0 0 0 30px;font-weight: bold;padding: 5px;">
</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter comp name / city" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="" />

	<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="myButSRc btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>
</td>	
<td>
<a href="company_master.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Company master</button></a>
</td>



</tr>
</table>

<!--<div style="margin:10px 50px 10px 0px;float:right;">
		<a href="company_master.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 377px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Company master</button></a>
</div>-->
<div id="dvContainer">
<table id="example" class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="1" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;">
   <thead>
	<tr class="info">
	
		<td colspan="16" style="text-align:center;"><h3 class="viewDT" id="Userhd"><b>View Company master</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Code</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Company Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">GSTIN</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Contact name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Address</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">City</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Phone</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Email</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">PC Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">IP Address</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;" class="Ckk">Edit</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;" class="Ckk">Log</th>
	</tr>
	   </thead>
	   <tbody>
	<?php 
	$item_where="";	
if(isset($_GET['val']) && $_GET['val']!=''){
$item_where= " AND comp_name like '%".$_GET['val']."%' OR city like '%".$_GET['val']."%'";
/* echo "select * from company_master $item_where order by comp_name ASC"; */
$sql=mysql_query("SELECT *  FROM company_master WHERE added_on IN (SELECT MAX(added_on) FROM `company_master` GROUP BY comp_code) $item_where order by comp_name ASC");
}else{
	$sql=mysql_query("SELECT *  FROM company_master WHERE added_on IN (SELECT MAX(added_on) FROM `company_master` GROUP BY comp_code) order by comp_name ASC");
}
	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		if($row['status']==1){
			$status="Active";
		}else{
			$status="Deactive";
		}
				
	?>
	<tr>
		<td width="80" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['comp_code']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['comp_name']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['gst_number']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['cont_name']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['address1']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['city']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['phone']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $row['email']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $row['systemname']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $row['systemip']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $status; ?></td>
		<td width="80">
		<a href="update-company-master.php?CompID=<?php echo $row['company_id']; ?>" style="" class="Ckk">Edit</a>&nbsp;
		</td>
		<td width="80">
		<a onclick="clikval('<?php echo $row['comp_code']; ?>');" style="" class="Ckk">Log</a>&nbsp;
		</td>
	</tr>
	<?php } }  ?>	
	</tbody>
</table>
	<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <h4>Use Log</h4>
    </div>
	<img onclick="closewin();" style="width: 3%;position: absolute;top: 0;right: 0;cursor: pointer;" src="../../img/close.png" />
    <div id="loaddata" class="modal-body">
      <p>Some text in the Modal Body</p>
      <p>Some other text...</p>
    </div>
  </div>

</div>
	</div>
	</div>
	<?php include("../../footer.php"); ?>
	<script>
function clikval(obj)
{
	var source_code = obj;
	$.ajax({
		type:'GET',
		url:'../../log/companylog.php',
			data:{
			source_code:source_code
			},
			success:function(data){
				// alert(data); 
			$('#loaddata').html(data);
			$('#myModal').css('display','block');
			}
	});
	
	
}

function closewin()
{
	$('#myModal').css('display','none');
}
var modal = document.getElementById("myModal");
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
	</body>
 </form>